<?php
/**
 * Override TEC Default Template
 */

defined('ABSPATH') || exit;

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header();

get_template_part('template-parts/inner-header');

/**
 * ----------------------------------------
 * FEATURED EVENT CATEGORIES
 * ----------------------------------------
 */
$all_top_level = get_terms([
    'taxonomy' => 'tribe_events_cat',
    'parent' => 0,
    'hide_empty' => false,
]);

$featured_categories = [];
if (!is_wp_error($all_top_level)) {
    foreach ($all_top_level as $cat) {
        $is_featured = get_term_meta($cat->term_id, 'featured_category', true);
        if ($is_featured !== '0') {
            $cat->card_order = (int) get_term_meta($cat->term_id, 'category_card_order', true);
            if (!$cat->card_order)
                $cat->card_order = 999;
            $featured_categories[] = $cat;
        }
    }

    usort($featured_categories, function ($a, $b) {
        return $a->card_order <=> $b->card_order;
    });
}

/**
 * ----------------------------------------
 * DEFAULT CATEGORY
 * First featured category becomes default
 * ----------------------------------------
 */
$default_category = '';

if (!empty($featured_categories) && !is_wp_error($featured_categories)) {
    $default_category = $featured_categories[0]->slug;
}

/**
 * ----------------------------------------
 * ACTIVE CATEGORY RESOLUTION
 * ----------------------------------------
 * Priority: tribe_events_cat param (walking to top ancestor)
 * > WP pretty-permalink query var > first featured category.
 */
$active_featured_cat_slug = $default_category;

if (!empty($_GET['tribe_events_cat'])) {
    // Resolve each slug to its top-level parent category
    $slugs = array_map('sanitize_text_field', explode(',', sanitize_text_field(wp_unslash($_GET['tribe_events_cat']))));
    foreach ($slugs as $slug) {
        $term = get_term_by('slug', $slug, 'tribe_events_cat');
        if (!$term) continue;
        if ($term->parent === 0) {
            $active_featured_cat_slug = $term->slug;
            break;
        }
        $ancestors = get_ancestors($term->term_id, 'tribe_events_cat', 'taxonomy');
        if (!empty($ancestors)) {
            $top = get_term(end($ancestors), 'tribe_events_cat');
            if ($top && !is_wp_error($top)) {
                $active_featured_cat_slug = $top->slug;
                break;
            }
        }
    }
} elseif ($qv_cat = get_query_var('tribe_events_cat')) {
    // Pretty-permalink e.g. /schedules/category/arts-and-crafts/
    $active_featured_cat_slug = sanitize_text_field($qv_cat);
}
?>

<section id="schedule-calendar" class="pdop_container sd_page pdop_schedule">

    <!-- CATEGORY CARDS -->
    <?php if (!empty($featured_categories) && !is_wp_error($featured_categories)): ?>

        <h2 class="schedule_cat_tabs_container_title">
            <?php esc_html_e('Select Event Categories', 'pdop'); ?>
        </h2>

        <div class="schedule_cat_tabs_container">

            <div class="schedule_cat_tabs_wrapper d-flex">

                <?php foreach ($featured_categories as $category):

                    $thumbnail = get_field('event_category_thumbnail', $category);

                    $image_url = '';

                    if (!empty($thumbnail)) {
                        if (is_array($thumbnail)) {
                            $image_url = $thumbnail['sizes']['medium_large'] ?? $thumbnail['url'];
                        } elseif (is_numeric($thumbnail)) {
                            $image_url = wp_get_attachment_image_url($thumbnail, 'medium_large');
                        }
                    }

                    if (empty($image_url)) {
                        $image_url = '/wp-content/uploads/2026/04/Place-holder-image.png';
                    }

                    $is_active = ($active_featured_cat_slug === $category->slug);

                    $url = add_query_arg(
                        ['tribe_events_cat' => $category->slug],
                        get_post_type_archive_link('tribe_events')
                    );
                    ?>

                    <a href="<?php echo esc_url($url); ?>" class="sc_category_card <?php echo $is_active ? 'active' : ''; ?>"
                        <?php echo $is_active ? 'aria-current="true"' : ''; ?>
                        aria-label="<?php echo esc_attr($category->name); ?>">

                        <?php if (!empty($image_url)): ?>

                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>"
                                loading="lazy" width="400" height="300">

                        <?php endif; ?>

                        <div>
                            <?php echo esc_html($category->name); ?>
                        </div>

                    </a>

                <?php endforeach; ?>

            </div>

        </div>

    <?php endif; ?>

    <!-- MAIN LAYOUT -->
    <div class="schedule_main_layout">

        <!-- SIDEBAR -->
        <?php get_template_part('template-parts/components/filter-sidebar'); ?>

        <!-- CALENDAR -->
        <div class="schedule_calendar">
            <?php echo tribe(Template_Bootstrap::class)->get_view_html(); ?>
        </div>

    </div>

</section>

<?php get_template_part('template-parts/schedulepage/dont-miss-these'); ?>

<?php get_footer(); ?>