<?php
/**
 * Reusable Filter Sidebar
 *
 * Renders the desktop sidebar and the mobile slide-up filter panel.
 * Mobile panel mirrors the Staff Directory plugin's approach:
 * sticky bottom bar → slide-up sheet → deferred apply.
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get current filters from URL.
$current_categories = isset($_GET['tribe_events_cat'])
    ? array_map('sanitize_text_field', explode(',', sanitize_text_field($_GET['tribe_events_cat'])))
    : [];

$current_time = isset($_GET['time_of_day'])
    ? array_map('sanitize_text_field', explode(',', sanitize_text_field($_GET['time_of_day'])))
    : [];

$current_location = isset($_GET['location'])
    ? array_map('sanitize_text_field', explode(',', sanitize_text_field($_GET['location'])))
    : [];

$current_instructor = isset($_GET['organizer'])
    ? array_map('sanitize_text_field', explode(',', sanitize_text_field($_GET['organizer'])))
    : [];

$has_active_filters = ! empty( $current_categories ) || ! empty( $current_time ) || ! empty( $current_location ) || ! empty( $current_instructor );
?>

<div id="fs-filter-root">

    <!-- ─── Desktop Sidebar ─────────────────────────────── -->
    <aside class="filter-sidebar" aria-labelledby="filter-heading">

        <div class="filter-sidebar__header">
            <h2 id="filter-heading">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    aria-hidden="true">
                    <path d="M22 6.5H16" stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6.5H2" stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M10 10C11.933 10 13.5 8.433 13.5 6.5C13.5 4.567 11.933 3 10 3C8.067 3 6.5 4.567 6.5 6.5C6.5 8.433 8.067 10 10 10Z"
                        stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M22 17.5H18" stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 17.5H2" stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M14 21C15.933 21 17.5 19.433 17.5 17.5C17.5 15.567 15.933 14 14 14C12.067 14 10.5 15.567 10.5 17.5C10.5 19.433 12.067 21 14 21Z"
                        stroke="#002D72" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <?php esc_html_e( 'Filters', 'pdop' ); ?>
            </h2>
            <button class="clear-filters" id="fs-clear-all" type="button">
                <?php esc_html_e( 'Clear all', 'pdop' ); ?>
            </button>
        </div>

        <div class="fs-desktop-scroll-area">

        <?php
        // 1. Determine active Featured Category
        $active_featured_cat_slug = pdop_get_default_featured_category_slug();

        if (!empty($current_categories)) {
            foreach ($current_categories as $slug) {
                $term = get_term_by('slug', $slug, 'tribe_events_cat');
                if (!$term) continue;
                // Check if it's a top-level featured category directly
                if ($term->parent === 0 && get_term_meta($term->term_id, 'featured_category', true) == '1') {
                    $active_featured_cat_slug = $slug;
                    break;
                }
                // Walk up to find the featured ancestor
                $ancestors = get_ancestors($term->term_id, 'tribe_events_cat', 'taxonomy');
                foreach ($ancestors as $ancestor_id) {
                    if (get_term_meta($ancestor_id, 'featured_category', true) == '1') {
                        $ancestor_term = get_term($ancestor_id, 'tribe_events_cat');
                        if ($ancestor_term && !is_wp_error($ancestor_term)) {
                            $active_featured_cat_slug = $ancestor_term->slug;
                        }
                        break;
                    }
                }
            }
        }

        $level_1_terms = [];
        $level_2_terms = [];

        if ($active_featured_cat_slug) {
            $featured_term = get_term_by('slug', $active_featured_cat_slug, 'tribe_events_cat');
            if ($featured_term && !is_wp_error($featured_term)) {
                $all_children = get_terms([
                    'taxonomy' => 'tribe_events_cat',
                    'child_of' => $featured_term->term_id,
                    'hide_empty' => false
                ]);

                if (!is_wp_error($all_children)) {
                    foreach ($all_children as $child) {
                        if ($child->parent == $featured_term->term_id) {
                            $level_1_terms[] = $child;
                        } else {
                            $level_2_terms[] = $child;
                        }
                    }
                }
            }
        }

        // Determine "All" state
        $level_1_slugs = wp_list_pluck($level_1_terms, 'slug');
        $level_2_slugs = wp_list_pluck($level_2_terms, 'slug');
        
        $has_level_1_checked = !empty(array_intersect($level_1_slugs, $current_categories));
        $has_level_2_checked = !empty(array_intersect($level_2_slugs, $current_categories));
        ?>

        <!-- CATEGORY (Level 1) -->
        <?php if (!empty($level_1_terms)): ?>
        <fieldset class="filter-group" id="fs-section-category" role="group" aria-labelledby="legend-category">
            <legend id="legend-category"><?php esc_html_e( 'Category', 'pdop' ); ?></legend>
            
            <div class="filter-item">
                <input type="checkbox" id="cat_all_level_1" value="all" class="filter-checkbox-category-all" <?php echo !$has_level_1_checked ? 'checked' : ''; ?>>
                <label for="cat_all_level_1"><?php esc_html_e( 'All', 'pdop' ); ?></label>
            </div>

            <?php foreach ( $level_1_terms as $cat ) :
                $checked = in_array( $cat->slug, $current_categories, true ) ? 'checked' : '';
                $id      = 'cat_' . $cat->slug;
            ?>
                <div class="filter-item">
                    <input type="checkbox" id="<?php echo esc_attr( $id ); ?>"
                        value="<?php echo esc_attr( $cat->slug ); ?>"
                        class="filter-checkbox-category" <?php echo $checked; ?>>
                    <label for="<?php echo esc_attr( $id ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endif; ?>

        <!-- SUB-CATEGORY (Level 2) -->
        <?php if (!empty($level_2_terms)): ?>
        <fieldset class="filter-group" id="fs-section-subcategory" role="group" aria-labelledby="legend-subcategory">
            <legend id="legend-subcategory"><?php esc_html_e( 'Sub-Category', 'pdop' ); ?></legend>
            
            <div class="filter-item">
                <input type="checkbox" id="subcat_all_level_2" value="all" class="filter-checkbox-subcategory-all" <?php echo !$has_level_2_checked ? 'checked' : ''; ?>>
                <label for="subcat_all_level_2"><?php esc_html_e( 'All', 'pdop' ); ?></label>
            </div>

            <?php foreach ( $level_2_terms as $cat ) :
                $checked = in_array( $cat->slug, $current_categories, true ) ? 'checked' : '';
                $id      = 'subcat_' . $cat->slug;
            ?>
                <div class="filter-item">
                    <input type="checkbox" id="<?php echo esc_attr( $id ); ?>"
                        value="<?php echo esc_attr( $cat->slug ); ?>"
                        class="filter-checkbox-category" <?php echo $checked; ?>>
                    <label for="<?php echo esc_attr( $id ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endif; ?>

        <!-- TIME OF DAY -->
        <fieldset class="filter-group" id="fs-section-time" role="group" aria-labelledby="legend-time">
            <legend id="legend-time"><?php esc_html_e( 'Time of the Day', 'pdop' ); ?></legend>

            <?php
            $times = [
                'morning'   => __( 'Morning', 'pdop' ),
                'afternoon' => __( 'Afternoon', 'pdop' ),
                'evening'   => __( 'Evening', 'pdop' ),
                'night'     => __( 'Night', 'pdop' ),
            ];

            foreach ( $times as $slug => $label ) :
                $checked = in_array( $slug, $current_time, true ) ? 'checked' : '';
                $id      = 'time_' . $slug;
                ?>

                <div class="filter-item">
                    <input type="checkbox" id="<?php echo esc_attr( $id ); ?>"
                        value="<?php echo esc_attr( $slug ); ?>"
                        class="filter-checkbox-time" <?php echo $checked; ?>>
                    <label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label>
                </div>

            <?php endforeach; ?>
        </fieldset>

        <!-- LOCATION -->
        <fieldset class="filter-group" id="fs-section-location" role="group" aria-labelledby="legend-location">
            <legend id="legend-location"><?php esc_html_e( 'Location', 'pdop' ); ?></legend>

            <?php
            $locations = tribe_get_venues();

            if ( ! empty( $locations ) ) :
                foreach ( $locations as $venue ) :
                    $checked = in_array( $venue->post_name, $current_location, true ) ? 'checked' : '';
                    $id      = 'loc_' . $venue->post_name;
                    ?>

                    <div class="filter-item">
                        <input type="checkbox" id="<?php echo esc_attr( $id ); ?>"
                            value="<?php echo esc_attr( $venue->post_name ); ?>"
                            class="filter-checkbox-location" <?php echo $checked; ?>>
                        <label for="<?php echo esc_attr( $id ); ?>">
                            <?php echo esc_html( $venue->post_title ); ?>
                        </label>
                    </div>

                <?php
                endforeach;
            endif;
            ?>
        </fieldset>

        <!-- INSTRUCTOR -->
        <fieldset class="filter-group" id="fs-section-instructor" role="group" aria-labelledby="legend-instructor">
            <legend id="legend-instructor"><?php esc_html_e( 'Instructor', 'pdop' ); ?></legend>
            <div class="filter-search-wrapper">
                <input type="search" class="filter-search" id="instructor-search"
                    placeholder="<?php esc_attr_e( 'Search instructor', 'pdop' ); ?>"
                    aria-label="<?php esc_attr_e( 'Search instructor', 'pdop' ); ?>">
                <svg class="filter-search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path
                        d="M6.54604 0.75C5.39969 0.75 4.27909 1.08993 3.32593 1.72681C2.37278 2.36368 1.62989 3.2689 1.1912 4.32799C0.752511 5.38707 0.637731 6.55246 0.861372 7.67678C1.08501 8.8011 1.63703 9.83386 2.44762 10.6444C3.25821 11.455 4.29097 12.0071 5.41529 12.2307C6.53961 12.4543 7.705 12.3396 8.76408 11.9009C9.82317 11.4622 10.7284 10.7193 11.3653 9.76614C12.0021 8.81298 12.3421 7.69238 12.3421 6.54603C12.3421 5.00883 11.7314 3.53459 10.6445 2.44762C9.55749 1.36065 8.08324 0.75 6.54604 0.75Z"
                        stroke="black" stroke-width="1.5" stroke-miterlimit="10"></path>
                    <path d="M10.7012 10.7031L14.7489 14.7509" stroke="black" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round"></path>
                </svg>
            </div>

            <div class="filter-scroll">

                <?php
                $organizers = tribe_get_organizers();

                if ( ! empty( $organizers ) ) :
                    foreach ( $organizers as $org ) :
                        $checked = in_array( $org->post_name, $current_instructor, true ) ? 'checked' : '';
                        $id      = 'org_' . $org->post_name;
                        ?>

                        <div class="filter-item instructor-item">
                            <input type="checkbox" id="<?php echo esc_attr( $id ); ?>"
                                value="<?php echo esc_attr( $org->post_name ); ?>"
                                class="filter-checkbox-organizer" <?php echo $checked; ?>>
                            <label for="<?php echo esc_attr( $id ); ?>" class="instructor-label">
                                <?php echo esc_html( $org->post_title ); ?>
                            </label>
                        </div>

                    <?php
                    endforeach;
                endif;
                ?>

            </div>

        </fieldset>

        </div> <!-- End .fs-desktop-scroll-area -->
    </aside>

    <!-- ─── Mobile Sticky Bar ────────────────────────────── -->
    <div class="fs-mobile-bar" id="fs-mobile-bar" aria-hidden="true">
        <button type="button" class="fs-mobile-bar__btn" id="fs-mobile-filter-btn"
            aria-haspopup="dialog" aria-expanded="false">
            <span class="fs-mobile-bar__icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    aria-hidden="true">
                    <path d="M22 6.5H16" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 6.5H2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M10 10C11.933 10 13.5 8.433 13.5 6.5C13.5 4.567 11.933 3 10 3C8.067 3 6.5 4.567 6.5 6.5C6.5 8.433 8.067 10 10 10Z"
                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M22 17.5H18" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8 17.5H2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M14 21C15.933 21 17.5 19.433 17.5 17.5C17.5 15.567 15.933 14 14 14C12.067 14 10.5 15.567 10.5 17.5C10.5 19.433 12.067 21 14 21Z"
                        stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
            <span class="fs-mobile-bar__text-wrap">
                <?php esc_html_e( 'Filters', 'pdop' ); ?>
                <span class="fs-mobile-bar__badge" id="fs-filter-badge"
                    <?php echo $has_active_filters ? '' : 'hidden'; ?>
                    aria-hidden="true"></span>
            </span>
        </button>
    </div>

    <!-- ─── Mobile Slide-up Panel ────────────────────────── -->
    <div class="fs-mobile-panel" id="fs-filter-panel" role="dialog" aria-modal="true"
        aria-label="<?php esc_attr_e( 'Filter options', 'pdop' ); ?>" hidden>
        <div class="fs-mobile-panel__overlay" data-fs-close-panel></div>
        <div class="fs-mobile-panel__sheet">
            <header class="fs-mobile-panel__header">
                <h2 class="fs-mobile-panel__title"><?php esc_html_e( 'Filters', 'pdop' ); ?></h2>
                <button type="button" class="fs-mobile-panel__clear-all" id="fs-mobile-clear-all">
                    <?php esc_html_e( 'Clear All', 'pdop' ); ?>
                </button>
            </header>
            <div class="fs-mobile-panel__body fs-mobile-two-column">
                <div class="fs-mobile-tabs" role="tablist"
                    aria-label="<?php esc_attr_e( 'Filter Categories', 'pdop' ); ?>">
                    <button type="button" class="fs-mobile-tab active" role="tab" aria-selected="true"
                        data-target="m-fs-category"><?php esc_html_e( 'Category', 'pdop' ); ?></button>
                    <button type="button" class="fs-mobile-tab" role="tab" aria-selected="false"
                        data-target="m-fs-time"><?php esc_html_e( 'Time of Day', 'pdop' ); ?></button>
                    <button type="button" class="fs-mobile-tab" role="tab" aria-selected="false"
                        data-target="m-fs-location"><?php esc_html_e( 'Location', 'pdop' ); ?></button>
                    <button type="button" class="fs-mobile-tab" role="tab" aria-selected="false"
                        data-target="m-fs-instructor"><?php esc_html_e( 'Instructor', 'pdop' ); ?></button>
                </div>
                <div class="fs-mobile-tab-content">
                    <div class="fs-mobile-tab-pane active" id="m-fs-category" role="tabpanel"></div>
                    <div class="fs-mobile-tab-pane" id="m-fs-time" role="tabpanel"></div>
                    <div class="fs-mobile-tab-pane" id="m-fs-location" role="tabpanel"></div>
                    <div class="fs-mobile-tab-pane" id="m-fs-instructor" role="tabpanel"></div>
                </div>
            </div>
            <footer class="fs-mobile-panel__footer">
                <button type="button" class="fs-mobile-panel__btn fs-mobile-panel__btn--outline"
                    data-fs-close-panel><?php esc_html_e( 'Close', 'pdop' ); ?></button>
                <button type="button" class="fs-mobile-panel__btn fs-mobile-panel__btn--fill"
                    id="fs-filter-apply"><?php esc_html_e( 'Apply', 'pdop' ); ?></button>
            </footer>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function handleAllToggle(allId, boxSelector) {
        const allCheckbox = document.getElementById(allId);
        const targetBoxes = document.querySelectorAll(boxSelector);
        
        if (!allCheckbox || targetBoxes.length === 0) return;

        allCheckbox.addEventListener('change', function() {
            if (this.checked) {
                targetBoxes.forEach(box => { 
                    if(box.checked) {
                        box.checked = false; 
                        box.dispatchEvent(new Event('change', { bubbles: true })); // Trigger existing JS filter logic
                    }
                });
            } else {
                // If they uncheck 'All', prevent it if no other boxes are checked, 
                // or just let the existing logic handle empty state.
                this.checked = true; // 'All' must remain checked unless a child is checked
            }
        });

        targetBoxes.forEach(box => {
            box.addEventListener('change', function() {
                if (this.checked) {
                    allCheckbox.checked = false;
                } else {
                    // Check if all are unchecked
                    const anyChecked = Array.from(targetBoxes).some(b => b.checked);
                    if (!anyChecked) {
                        allCheckbox.checked = true;
                    }
                }
            });
        });
    }

    handleAllToggle('cat_all_level_1', '#fs-section-category .filter-checkbox-category');
    handleAllToggle('subcat_all_level_2', '#fs-section-subcategory .filter-checkbox-category');
});
</script>