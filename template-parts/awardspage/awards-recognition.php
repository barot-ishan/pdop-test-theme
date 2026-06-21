<?php
/**
 * Template part: Awards & Recognition
 *
 * Filters work client-side (show/hide) so every award is present in the DOM
 * on first load — crawlers and assistive tech see the full content.
 *
 * ACF fields used:
 *   award_title_link        – Link to the award's individual title.
 *   award_image             – Image field on the 'award' CPT
 *   award_description       – Textarea / WYSIWYG on the 'award' CPT
 *   award_supporting_assets – Repeater with sub-fields:
 *       select_year         – Year (number / select)
 *       asset_title         – Text
 *       add                 – Select: 'Link' | 'Document'
 *       award_link          – Link field
 *       award_document      – File field
 *
 * @package YourTheme
 */

if (!defined('ABSPATH')) {
    exit;
}

// ─── CONFIG ──────────────────────────────────────────────────────────────────
// Change this to your actual taxonomy slug.
$award_taxonomy = 'award-category';

// ─── DOCUMENT ICON SVG ───────────────────────────────────────────────────────
// aria-hidden="true" + focusable="false" so screen readers and IE skip it.
$document_svg = '<span class="award_icon" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none" focusable="false" aria-hidden="true">
        <path d="M3.66653 20C3.59287 20 3.51995 19.9856 3.45206 19.9577C3.38417 19.9297 3.32269 19.8887 3.27122 19.8372C3.21975 19.7856 3.17933 19.7245 3.15236 19.6574C3.12538 19.5904 3.11239 19.5187 3.11413 19.4466V16.9527H0.552397C0.405892 16.9527 0.265388 16.8958 0.161793 16.7944C0.058199 16.693 0 16.5555 0 16.4122V0.540541C0 0.39718 0.058199 0.259692 0.161793 0.158321C0.265388 0.0569499 0.405892 0 0.552397 0H13.3335C13.48 0 13.6205 0.0569499 13.7241 0.158321C13.8277 0.259692 13.8859 0.39718 13.8859 0.540541V3.0473H16.4476C16.5941 3.0473 16.7346 3.10425 16.8382 3.20562C16.9418 3.30699 17 3.44448 17 3.58784V19.4595C17 19.6028 16.9418 19.7403 16.8382 19.8417C16.7346 19.9431 16.5941 20 16.4476 20H3.66653ZM7.18322 18.9189H15.8952V4.12838H13.8859V16.4C13.8886 16.5186 13.8514 16.6347 13.7801 16.7306C13.7087 16.8264 13.6071 16.8966 13.4909 16.9304L7.18322 18.9189ZM4.21893 16.9527V18.7162L9.81746 16.9514L4.21893 16.9527ZM1.10479 15.8716H12.7811V1.08108H1.10479V15.8716ZM10.2193 13.4932H3.66653C3.52003 13.4932 3.37952 13.4363 3.27593 13.3349C3.17233 13.2336 3.11413 13.0961 3.11413 12.9527C3.11413 12.8093 3.17233 12.6719 3.27593 12.5705C3.37952 12.4691 3.52003 12.4122 3.66653 12.4122H10.2193C10.3658 12.4122 10.5063 12.4691 10.6099 12.5705C10.7135 12.6719 10.7717 12.8093 10.7717 12.9527C10.7717 13.0961 10.7135 13.2336 10.6099 13.3349C10.5063 13.4363 10.3658 13.4932 10.2193 13.4932ZM10.2193 11.6487H3.66653C3.52003 11.6487 3.37952 11.5917 3.27593 11.4903C3.17233 11.389 3.11413 11.2515 3.11413 11.1081C3.11413 10.9647 3.17233 10.8273 3.27593 10.7259C3.37952 10.6245 3.52003 10.5676 3.66653 10.5676H10.2193C10.3658 10.5676 10.5063 10.6245 10.6099 10.7259C10.7135 10.8273 10.7717 10.9647 10.7717 11.1081C10.7717 11.2515 10.7135 11.389 10.6099 11.4903C10.5063 11.5917 10.3658 11.6487 10.2193 11.6487ZM10.2193 9.0473H3.66653C3.59399 9.0473 3.52216 9.03332 3.45514 9.00615C3.38812 8.97899 3.32722 8.93917 3.27593 8.88898C3.22463 8.83878 3.18394 8.77919 3.15618 8.71361C3.12842 8.64803 3.11413 8.57774 3.11413 8.50676V3.58784C3.11413 3.44448 3.17233 3.30699 3.27593 3.20562C3.37952 3.10425 3.52003 3.0473 3.66653 3.0473H10.2193C10.3658 3.0473 10.5063 3.10425 10.6099 3.20562C10.7135 3.30699 10.7717 3.44448 10.7717 3.58784V8.50676C10.7717 8.65012 10.7135 8.78761 10.6099 8.88898C10.5063 8.99035 10.3658 9.0473 10.2193 9.0473ZM4.21893 7.96622H9.66694V4.12838H4.21893V7.96622Z" fill="white"/>
    </svg>
</span>';

// ─── QUERY ALL AWARDS ─────────────────────────────────────────────────────────
// Single query used for year aggregation; category groups re-query below.
$awards_args = [
    'post_type' => 'award',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'no_found_rows' => true,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'update_post_meta_cache' => true,
    'update_post_term_cache' => true,
];
$awards_query = new WP_Query($awards_args);

// ─── BUILD YEAR OPTIONS from ACF repeater rows ────────────────────────────────
$all_years = [];
if ($awards_query->have_posts()) {
    foreach ($awards_query->posts as $post_obj) {
        $rows = get_field('award_supporting_assets', $post_obj->ID);
        if (!empty($rows) && is_array($rows)) {
            foreach ($rows as $row) {
                if (!empty($row['select_year'])) {
                    $y = (int) $row['select_year'];
                    if ($y > 0) {
                        $all_years[$y] = true;
                    }
                }
            }
        }
    }
    krsort($all_years); // newest first
    $all_years = array_keys($all_years);
}

// ─── BUILD CATEGORY OPTIONS from taxonomy ────────────────────────────────────
$award_terms = [];
if (taxonomy_exists($award_taxonomy)) {
    $terms = get_terms([
        'taxonomy' => $award_taxonomy,
        'hide_empty' => true,
        'orderby' => 'name',
        'order' => 'ASC',
        'update_term_meta_cache' => false,
    ]);
    if (!is_wp_error($terms)) {
        $award_terms = $terms;
    }
}

// ─── Unique ID prefix for this instance ──────────────────────────────────────
// Prevents duplicate IDs if the template is included more than once per page.
$uid = 'awards-' . wp_unique_id();
?>

<section class="pdop_container awars_recognition_section" id="<?php echo esc_attr($uid); ?>-section"
    aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
    <div class="row awards_recognition_row">

        <!-- ════════════════════════════════════════════════════════
             LEFT COL — heading + filters
        ════════════════════════════════════════════════════════ -->
        <div class="col-xl-5">
            <div class="award_left_col">

                <?php

                $title = get_sub_field('title');

                if (!empty($title)): ?>
                    <h2 id="<?php echo esc_attr($uid); ?>-heading" class="awards-main-heading">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <!--
                    ADA FIX #1 — role="group" + aria-labelledby instead of role="search".
                    role="search" is a landmark reserved for actual search inputs.
                    A filtering widget is a group of controls, not a search.
                -->
                <div class="awards_filters" role="group" aria-labelledby="<?php echo esc_attr($uid); ?>-filters-label">
                    <!-- Visually hidden group label read by screen readers -->
                    <span id="<?php echo esc_attr($uid); ?>-filters-label" class="sr-only">
                        <?php esc_html_e('Filter awards', 'textdomain'); ?>
                    </span>

                    <!-- Year filter -->
                    <?php if (!empty($all_years)): ?>
                        <div class="filter_group">
                            <!--
                                ADA: <label for="..."> MUST match the <select id="...">.
                                The label text is the accessible name — no aria-label needed on the select.
                            -->
                            <label class="filter_label" for="<?php echo esc_attr($uid); ?>-filter-year">
                                <?php esc_html_e('Select Year', 'textdomain'); ?>
                            </label>
                            <div class="filter_select_wrap">
                                <select id="<?php echo esc_attr($uid); ?>-filter-year"
                                    class="filter_select js-award-filter-year" name="award_year"
                                    aria-controls="<?php echo esc_attr($uid); ?>-list-region">
                                    <option value="">
                                        <?php esc_html_e('All Years', 'textdomain'); ?>
                                    </option>
                                    <?php foreach ($all_years as $year): ?>
                                        <option value="<?php echo esc_attr($year); ?>">
                                            <?php echo esc_html($year); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <!--
                                    ADA FIX #2 — each chevron SVG has a unique mask ID.
                                    Duplicate IDs in SVG cause rendering failures and
                                    fail the HTML uniqueness requirement (WCAG 4.1.1).
                                -->
                                <span class="filter_chevron" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" focusable="false" aria-hidden="true">
                                        <mask id="<?php echo esc_attr($uid); ?>-chevron-year" style="mask-type:alpha"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#<?php echo esc_attr($uid); ?>-chevron-year)">
                                            <path
                                                d="M11.9995 15.0552L6.3457 9.40141L7.39945 8.34766L11.9995 12.9477L16.5995 8.34766L17.6532 9.40141L11.9995 15.0552Z"
                                                fill="#1C1B1F" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Category filter -->
                    <?php if (!empty($award_terms)): ?>
                        <div class="filter_group">
                            <label class="filter_label" for="<?php echo esc_attr($uid); ?>-filter-category">
                                <?php esc_html_e('Select Category', 'textdomain'); ?>
                            </label>
                            <div class="filter_select_wrap">
                                <select id="<?php echo esc_attr($uid); ?>-filter-category"
                                    class="filter_select js-award-filter-category" name="award_category"
                                    aria-controls="<?php echo esc_attr($uid); ?>-list-region">
                                    <option value="">
                                        <?php esc_html_e('All Categories', 'textdomain'); ?>
                                    </option>
                                    <?php foreach ($award_terms as $term): ?>
                                        <option value="<?php echo esc_attr($term->slug); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <!--
                                    ADA FIX #2 cont. — unique mask ID for category chevron.
                                -->
                                <span class="filter_chevron" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" focusable="false" aria-hidden="true">
                                        <mask id="<?php echo esc_attr($uid); ?>-chevron-cat" style="mask-type:alpha"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" fill="#D9D9D9" />
                                        </mask>
                                        <g mask="url(#<?php echo esc_attr($uid); ?>-chevron-cat)">
                                            <path
                                                d="M11.9995 15.0552L6.3457 9.40141L7.39945 8.34766L11.9995 12.9477L16.5995 8.34766L17.6532 9.40141L11.9995 15.0552Z"
                                                fill="#1C1B1F" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>

                </div><!-- .awards_filters -->

            </div><!-- .award_left_col -->
        </div><!-- .col-xl-5 -->

        <!-- ════════════════════════════════════════════════════════
             RIGHT COL — awards list
        ════════════════════════════════════════════════════════ -->
        <div class="col-xl-7" id="<?php echo esc_attr($uid); ?>-list-region">
            <!--
                ADA FIX #3 — aria-live ONLY on the status paragraph, not the container.
                Having aria-live on a large container causes screen readers to re-read
                its entire contents on every DOM change. The status <p> is a small,
                controlled announcement region.
            -->
            <p id="<?php echo esc_attr($uid); ?>-filter-status" class="sr-only" aria-live="polite" aria-atomic="true">
            </p>

            <?php if (!empty($award_terms)): ?>

                <?php foreach ($award_terms as $term):

                    // ACF image attached to the taxonomy term itself
                    $term_image = get_field('category_image', $term);

                    // Query awards in this category
                    $term_query = new WP_Query([
                        'post_type' => 'award',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                        'no_found_rows' => true,
                        'tax_query' => [
                            [
                                'taxonomy' => $award_taxonomy,
                                'field' => 'term_id',
                                'terms' => $term->term_id,
                            ]
                        ],
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ]);

                    if (!$term_query->have_posts())
                        continue;

                    // Collect every year across all posts in this category
                    // so the JS can hide the group when no year matches.
                    $category_years = [];
                    foreach ($term_query->posts as $p) {
                        $rows_tmp = get_field('award_supporting_assets', $p->ID);
                        if (!empty($rows_tmp)) {
                            foreach ($rows_tmp as $r) {
                                if (!empty($r['select_year'])) {
                                    $category_years[] = (int) $r['select_year'];
                                }
                            }
                        }
                    }
                    $category_years = array_unique($category_years);
                    $data_years_attr = implode(' ', $category_years);
                    ?>

                    <!--
                        ADA FIX #4 — data-category (singular) matches what the JS reads.
                        Previous code set data-category in HTML but JS checked
                        dataset.categories (plural) — the filter was silently broken.

                        data-years lists every year present in this group so the JS
                        can decide to hide the whole group when a year filter produces
                        zero visible items.
                    -->
                    <div class="award_category_group" data-category="<?php echo esc_attr($term->slug); ?>"
                        data-years="<?php echo esc_attr($data_years_attr); ?>">
                        <div class="row award_container g-4">

                            <!-- Category image -->
                            <div class="col-9 col-sm-4">
                                <div class="award_img">
                                    <?php if (!empty($term_image['url'])): ?>
                                        <img src="/wp-content/uploads/2026/04/Feather-1.svg" class="award_img_bg" alt=""
                                            aria-hidden="true" focusable="false">
                                        <img src="<?php echo esc_url($term_image['url']); ?>"
                                            alt="<?php echo esc_attr($term_image['alt']); ?>" class="award_img_main" width="172"
                                            height="172" loading="lazy" decoding="async">
                                        <img src="/wp-content/uploads/2026/04/feather-2.svg" class="award_img_bg" alt=""
                                            aria-hidden="true" focusable="false">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Award posts in this category -->
                            <!-- Award posts in this category -->
                            <div class="col-md-8 award_content">

                                <?php while ($term_query->have_posts()):
                                    $term_query->the_post();

                                    $post_id = get_the_ID();
                                    $award_title_link = get_field('award_title_link');
                                    $description = get_field('award_description');
                                    $rows = get_field('award_supporting_assets');

                                    // Sort rows newest year first
                                    if (!empty($rows) && is_array($rows)) {
                                        usort($rows, function ($a, $b) {
                                            return (int) ($b['select_year'] ?? 0)
                                                - (int) ($a['select_year'] ?? 0);
                                        });
                                    }
                                    ?>

                                    <!--
            Each award post gets its own card.
            data-post-id lets CSS/JS target individual posts if needed.
            role="article" gives AT users a navigable landmark per post.
        -->
                                    <article class="award_post_card" data-post-id="<?php echo esc_attr($post_id); ?>"
                                        aria-labelledby="<?php echo esc_attr($uid); ?>-post-<?php echo esc_attr($post_id); ?>-title">

                                        <h3 class="award_title"
                                            id="<?php echo esc_attr($uid); ?>-post-<?php echo esc_attr($post_id); ?>-title">
                                            <?php if (!empty($award_title_link['url'])): ?>
                                                <a href="<?php echo esc_url($award_title_link['url']); ?>"
                                                    target="<?php echo esc_attr($award_title_link['target']); ?>"><?php the_title(); ?></a>
                                            <?php else: ?>
                                                <?php the_title(); ?>
                                            <?php endif; ?>
                                        </h3>

                                        <?php if (!empty($rows) && is_array($rows)): ?>
                                            <ul class="award_list" role="list" aria-label="<?php
                                            printf(
                                                esc_attr__('%s awards', 'textdomain'),
                                                esc_attr(get_the_title())
                                            );
                                            ?>">
                                                <?php foreach ($rows as $row):
                                                    $label = sanitize_text_field($row['asset_title'] ?? '');
                                                    $year = !empty($row['select_year']) ? (int) $row['select_year'] : 0;
                                                    $type = sanitize_text_field($row['add'] ?? '');

                                                    $url = '';
                                                    $target = $row['award_link']["target"] ?? '_self';
                                                    // var_dump($row['award_link']["target"]);
                                                    if ('Link' === $type && !empty($row['award_link']['url'])) {
                                                        $url = esc_url($row['award_link']['url']);
                                                        // $target = !empty($row['award_link']['target'])
                                                        //     ? esc_attr($row['award_link']['target'])
                                                        //     : '_self';
                                                    } elseif (!empty($row['award_document']['url'])) {
                                                        $url = esc_url($row['award_document']['url']);
                                                        // $target = '_blank';
                                                    }

                                                    $accessible_label = $year
                                                        ? sprintf(
                                                            /* translators: 1: award label, 2: year */
                                                            __('%1$s (%2$s)', 'textdomain'),
                                                            $label,
                                                            $year
                                                        )
                                                        : $label;
                                                    ?>
                                                    <li class="award_item" data-year="<?php echo esc_attr($year ?: ''); ?>">
                                                        <?php if ($url): ?>

                                                            <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" rel="noopener noreferrer"
                                                                class="award_item_content d-flex align-items-center" aria-label="
                                                            <?php echo esc_attr($accessible_label); ?>">
                                                            <?php else: ?>
                                                                <span class="award_item_content d-flex align-items-center"
                                                                    aria-label="<?php echo esc_attr($accessible_label); ?>">
                                                                <?php endif; ?>

                                                                <?php echo $document_svg; ?>
                                                                <span class="award_text" aria-hidden="true">
                                                                    <?php echo esc_html($label); ?>
                                                                </span>

                                                                <?php if ($url): ?>
                                                            </a>
                                                        <?php else: ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </li>

                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>

                                        <?php if (!empty($description)): ?>
                                            <div class="award_description">
                                                <?php echo wp_kses_post($description); ?>
                                            </div>
                                        <?php endif; ?>

                                    </article><!-- .award_post_card -->

                                <?php endwhile;
                                wp_reset_postdata(); ?>

                            </div><!-- .award_content -->
                        </div><!-- .award_container -->
                    </div><!-- .award_category_group -->

                <?php endforeach; ?>

            <?php endif; ?>

            <!--
                ADA FIX #8 — typo c    lass= fixed to class=.
                The typo meant this element was never found by the JS,
                so "no results" was never announced.
            -->
            <p class="awards-no-filter-results" id="<?php echo esc_attr($uid); ?>-no-filter-results" hidden
                aria-live="polite" aria-atomic="true">
                <?php esc_html_e('No awards match the selected filters. Please try a different combination.', 'textdomain'); ?>
            </p>

        </div><!-- .col-xl-7 -->

    </div><!-- .awards_recognition_row -->
</section>

<?php
/*
 * ── Inline JS ────────────────────────────────────────────────────────────────
 * Pure show/hide — no AJAX. All markup is in the DOM on first load so
 * crawlers and assistive tech index every award without needing JavaScript.
 *
 * To move to an enqueued file, replace the inline <script> block with:
 *   wp_enqueue_script( 'awards-filter', get_template_directory_uri() . '/assets/js/awards-filter.js', [], null, ['strategy'=>'defer','in_footer'=>true] );
 * and pass $uid via wp_localize_script or a data- attribute on the section.
 */
?>
<script>
    (function () {
        'use strict';

        // ── Scope to this template instance via the unique ID ─────────────────
        var uid = <?php echo wp_json_encode($uid); ?>;
        var section = document.getElementById(uid + '-section');
        if (!section) return;

        var selYear = section.querySelector('.js-award-filter-year');
        var selCat = section.querySelector('.js-award-filter-category');
        var statusEl = document.getElementById(uid + '-filter-status');
        var noResults = document.getElementById(uid + '-no-filter-results');

        // Each .award_category_group = one filterable block
        var groups = Array.prototype.slice.call(
            section.querySelectorAll('.award_category_group')
        );
        if (!groups.length) return;

        // ── Core filter ───────────────────────────────────────────────────────
        function filterAwards() {
            var chosenYear = selYear ? selYear.value.trim() : '';
            var chosenCat = selCat ? selCat.value.trim() : '';
            var visible = 0;

            groups.forEach(function (group) {

                // ── Step 1: Category gate (hide whole group) ──────────────────
                // ADA FIX #4 — reading data-category (singular) to match PHP output.
                var groupCat = group.dataset.category || '';
                var catMatch = !chosenCat || groupCat === chosenCat;

                if (!catMatch) {
                    hideEl(group);
                    return; // skip year check for hidden groups
                }

                // ── Step 2: Year gate (individual list items) ─────────────────
                var items = Array.prototype.slice.call(
                    group.querySelectorAll('.award_item')
                );
                var visibleItems = 0;

                items.forEach(function (item) {
                    var itemYear = (item.dataset.year || '').trim();
                    var yearMatch = !chosenYear || itemYear === chosenYear;
                    if (yearMatch) {
                        showEl(item);
                        visibleItems++;
                    } else {
                        hideEl(item);
                    }
                });

                // Hide the whole group when year filter leaves it empty
                if (chosenYear && visibleItems === 0) {
                    hideEl(group);
                } else {
                    showEl(group);
                    visible++;
                }
            });

            // ── Step 3: No-results feedback ───────────────────────────────────
            if (noResults) {
                if (visible === 0) {
                    noResults.removeAttribute('hidden');
                } else {
                    noResults.setAttribute('hidden', '');
                }
            }

            // ── Step 4: Screen-reader announcement ────────────────────────────
            // Polite live region — announced after the user finishes interacting.
            if (statusEl) {
                statusEl.textContent = visible === 1
                    ? '1 <?php echo esc_js(__('award category is now visible.', 'textdomain')); ?>'
                    : visible + ' <?php echo esc_js(__('award categories are now visible.', 'textdomain')); ?>';
            }
        }

        // ── Helpers ───────────────────────────────────────────────────────────

        /** Removes element from visual flow AND accessibility tree. */
        function hideEl(el) {
            el.setAttribute('hidden', '');        // display:none (CSS honours this)
            el.setAttribute('aria-hidden', 'true'); // removes from AT tree
        }

        /** Restores a previously hidden element. */
        function showEl(el) {
            el.removeAttribute('hidden');
            el.removeAttribute('aria-hidden');
        }

        // ── Bind ──────────────────────────────────────────────────────────────
        if (selYear) selYear.addEventListener('change', filterAwards);
        if (selCat) selCat.addEventListener('change', filterAwards);

    })();
</script>