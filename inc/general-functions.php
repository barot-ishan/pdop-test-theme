<?php

/**
 * Remove unnecessary WordPress frontend libraries
 * Safe for custom themes using Bootstrap + ACF
 */

/**
 * 1. Remove Gutenberg frontend CSS
 */
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}, 100);

/**
 * 2. Remove emoji support
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

/**
 * 3. Remove oEmbed scripts & links
 */
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

/**
 * 4. Remove wp-embed.js
 */
add_action('wp_enqueue_scripts', function () {
    wp_deregister_script('wp-embed');
});

/**
 * 5. Remove jQuery migrate (keep jQuery)
 */
add_action('wp_default_scripts', function ($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-migrate']);
        }
    }
});

/**
 * 6. Remove dashicons for non-logged-in users
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_user_logged_in()) {
        wp_deregister_style('dashicons');
    }
});

/**
 * 7. Remove REST API links from head (API still works)
 */
remove_action('wp_head', 'rest_output_link_wp_head');

/**
 * 8. Remove shortlink
 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * 9. Remove generator tag
 */
remove_action('wp_head', 'wp_generator');

/**
 * 10. Remove RSD & WLW links
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Disable block support inline styles
 */
add_filter('wp_should_load_block_assets', '__return_false');

// Enqueue custom styles
function custom_style_enqueue()
{
    wp_enqueue_style('bs-style', get_stylesheet_directory_uri() . '/assets/lib/css/bootstrap.min.css', array(), time(), 'all');
    wp_enqueue_style('swiper-style', get_stylesheet_directory_uri() . '/assets/lib/css/swiper.min.css', array(), time(), 'all');
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('bs-style'), time(), 'all');
    wp_enqueue_style('custom-header', get_stylesheet_directory_uri() . '/assets/css/header.css', array(), time(), 'all');
    wp_enqueue_style('custom-footer', get_stylesheet_directory_uri() . '/assets/css/footer.css', array(), time(), 'all');
    wp_enqueue_style('pages-styles', get_stylesheet_directory_uri() . '/assets/css/pages.css', array(), time(), 'all');
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', array(), time(), 'all');
    wp_enqueue_style('custom-megamenu', get_stylesheet_directory_uri() . '/assets/css/megamenu.css', array(), time(), 'all');
    wp_enqueue_style('mission-vision-styles', get_stylesheet_directory_uri() . '/assets/css/mission-vision.css', array(), time(), 'all');
    wp_enqueue_style('awards-styles', get_stylesheet_directory_uri() . '/assets/css/awards.css', array(), time(), 'all');
    wp_enqueue_style('history-styles', get_stylesheet_directory_uri() . '/assets/css/history.css', array(), time(), 'all');
    wp_enqueue_style('boardcommission-styles', get_stylesheet_directory_uri() . '/assets/css/boardcommission.css', array(), time(), 'all');
    wp_enqueue_style('alpha-styles', get_stylesheet_directory_uri() . '/assets/css/alpha.css', array(), time(), 'all');
    wp_enqueue_style('beta-styles', get_stylesheet_directory_uri() . '/assets/css/beta.css', array(), time(), 'all');

    // Homepage-specific styles and scripts
    if (is_front_page() || is_page_template('templates/homepage.php')) {
        wp_enqueue_style('pdop-homepage', get_stylesheet_directory_uri() . '/assets/css/homepage.css', array(), time(), 'all');
    }
}
add_action('wp_enqueue_scripts', 'custom_style_enqueue');

// Enqueue custom scripts
function custom_script()
{
    wp_enqueue_script('bs-script', get_stylesheet_directory_uri() . "/assets/lib/js/bootstrap.min.js", array(), time(), true);
    wp_enqueue_script('swiper-script', get_stylesheet_directory_uri() . "/assets/lib/js/swiper.min.js", array(), time(), true);
    wp_enqueue_script('header-script', get_stylesheet_directory_uri() . "/assets/js/header.js", array(), time(), true);
    wp_enqueue_script('pages-script', get_stylesheet_directory_uri() . "/assets/js/pages-v3.js", array(), time(), true);

    wp_enqueue_script('pdop-megamenu-js', get_stylesheet_directory_uri() . '/assets/js/mega-menu.js', array(), time(), true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), time(), true);

    if (is_front_page() || is_page_template('templates/homepage.php')) {
        wp_enqueue_script('pdop-hero-slider', get_stylesheet_directory_uri() . '/assets/js/hero-slider.js', array(), time(), true);
    }
}
add_action('wp_enqueue_scripts', 'custom_script');

// Enqueue calendar pdf script
function pdop_enqueue_calendar_pdf_script()
{
    if (is_post_type_archive('tribe_events') || is_page('calendar')) {
        wp_enqueue_script('html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', [], null, true);
        wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', [], null, true);
        // wp_enqueue_script('calendar-pdf', get_template_directory_uri() . '/assets/js/calendar-pdf.js', ['html2canvas', 'jspdf'], '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'pdop_enqueue_calendar_pdf_script');


add_shortcode('facility_status', 'render_facility_status_cards');

function render_facility_status_cards()
{
    $cache_key = 'statusfy_facility_status';
    // $facilities = get_transient($cache_key);

    // if ($facilities === false) {

    $response = wp_remote_get(
        'https://statusfy.com/7087426366/list?output=json',
        [
            'timeout' => 15,
            'headers' => ['Accept' => 'application/json'],
        ]
    );

    if (is_wp_error($response)) {
        return '<p>Unable to load facility status.</p>';
    }

    $facilities = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($facilities) || !is_array($facilities)) {
        return '<p>No facility status data found.</p>';
    }

    // SORT BY status_time (newest first)
    usort($facilities, function ($a, $b) {
        return ($b['status_time'] ?? 0) <=> ($a['status_time'] ?? 0);
    });

    // Cache for 10 minutes
    // set_transient($cache_key, $facilities, 10 * MINUTE_IN_SECONDS);
    // }

    ob_start(); ?>

    <div class="facility-filters">
        <button data-filter="all" class="active">All</button>
        <button data-filter="open">Open</button>
        <button data-filter="closed">Closed</button>
        <button data-filter="go">It's a Go</button>
        <button data-filter="info">Info</button>
    </div>
    <div class="facility-grid">
        <?php foreach ($facilities as $facility):

            $status_clip_raw = $facility['status_clip'] ?? 'unknown';
            $status_clip = strtolower(trim($status_clip_raw));

            $status_class = match ($status_clip) {
                'open' => 'open',
                'closed' => 'closed',
                'canceled',
                'cancelled' => 'cancelled',
                "it's a go!" => 'go',
                'info' => 'info',
                default => 'unknown',
            };

            $status_icon = match ($status_clip) {
                'open' => '🟢',
                'closed' => '🔴',
                'canceled',
                'cancelled' => '⚫',
                "it's a go!" => '⚪',
                'info' => '🟡',
                default => '⚪',
            };
            ?>

            <div class="facility-card <?php echo esc_attr($status_class); ?>"
                data-status="<?php echo esc_attr($status_class); ?>">
                <span class="status-badge">
                    <?php echo esc_html($status_icon . ' ' . $status_clip_raw); ?>
                </span>

                <?php if (!empty($facility['name_full'])): ?>
                    <h3><?php echo esc_html($facility['name_full']); ?></h3>
                    <?php
                endif; ?>

                <?php if (!empty($facility['name_short'])): ?>
                    <p class="short-name"><?php echo esc_html($facility['name_short']); ?></p>
                    <?php
                endif; ?>

                <?php if (!empty($facility['status_detail'])): ?>
                    <p class="detail"><?php echo ($facility['status_detail']); ?></p>
                    <?php
                endif; ?>

                <!-- <?php if (!empty($facility['updated_ago'])): ?>
                    <p class="facility_updated">
                        🕒 Updated: <?php echo esc_html($facility['updated_ago']); ?>
                    </p>
                <?php
                endif; ?> -->
            </div>

            <?php
        endforeach; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.facility-filters button');
            const cards = document.querySelectorAll('.facility-card');

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const filter = button.dataset.filter;

                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    cards.forEach(card => {
                        if (filter === 'all' || card.dataset.status === filter) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>


    <?php
    return ob_get_clean();
}


// Allow SVG
function pdop_allow_svg_upload($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'pdop_allow_svg_upload');

// Add title attribute to custom logo
function add_title_to_custom_logo($html)
{
    // Get the site name to use as the title attribute
    $title = get_bloginfo('name');

    // Add the title attribute to the anchor tag in the custom logo
    $html = str_replace('<a', '<a title="' . esc_attr($title) . '" aria-label="Home - Park District of Oak Park"', $html);

    return $html;
}
add_filter('get_custom_logo', 'add_title_to_custom_logo');

// Add breadcrumbs
require_once get_template_directory() . '/inc/breadcrumbs.php';


add_filter('acf/update_value/type=wysiwyg', function ($value, $post_id, $field) {

    // Convert &nbsp; to normal space
    $value = str_replace('&nbsp;', ' ', $value);

    // Remove unicode non-breaking spaces
    $value = preg_replace('/\xC2\xA0/', ' ', $value);

    // Remove empty paragraphs (but keep real content)
    $value = preg_replace('/<p>\s*<\/p>/', '', $value);

    // Clean multiple spaces (optional but safe)
    $value = preg_replace('/[ \t]+/', ' ', $value);

    return $value;
}, 10, 3);


/**
 * =========================================================
 * TEC Schedule Page Filters
 * =========================================================
 */

/**
 * Get default featured category slug
 *
 * Returns the first featured category ordered
 * by category_card_order ASC.
 */
function pdop_get_default_featured_category_slug()
{
    $top_level_categories = get_terms(
        [
            'taxonomy' => 'tribe_events_cat',
            'parent' => 0,
            'hide_empty' => false,
        ]
    );

    $featured = [];

    if (!empty($top_level_categories) && !is_wp_error($top_level_categories)) {
        foreach ($top_level_categories as $cat) {
            $is_featured = get_term_meta($cat->term_id, 'featured_category', true);
            if ($is_featured !== '0') {
                $cat->card_order = (int) get_term_meta($cat->term_id, 'category_card_order', true);
                if (!$cat->card_order)
                    $cat->card_order = 999;
                $featured[] = $cat;
            }
        }

        if (!empty($featured)) {
            usort($featured, function ($a, $b) {
                return $a->card_order <=> $b->card_order;
            });
            return $featured[0]->slug;
        }
    }

    return '';
}

/**
 * =========================================================
 * Main Archive Query Filters
 * =========================================================
 */
add_action('pre_get_posts', function ($query) {

    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if (!is_post_type_archive('tribe_events')) {
        return;
    }

    $tax_query = [];
    $meta_query = [];

    /**
     * -----------------------------------------------------
     * Default / Active Category
     * -----------------------------------------------------
     */
    $default_category = pdop_get_default_featured_category_slug();

    $current_category = !empty($_GET['tribe_events_cat'])
        ? sanitize_text_field(wp_unslash($_GET['tribe_events_cat']))
        : $default_category;

    /**
     * -----------------------------------------------------
     * Category Filter
     * -----------------------------------------------------
     */
    if (!empty($current_category)) {

        $categories = array_map(
            'sanitize_text_field',
            explode(',', $current_category)
        );

        $tax_query[] = [
            'taxonomy' => 'tribe_events_cat',
            'field' => 'slug',
            'terms' => $categories,
        ];
    }

    if (!empty($tax_query)) {

        $tax_query['relation'] = 'AND';

        $query->set('tax_query', $tax_query);
    }

    /**
     * -----------------------------------------------------
     * Location Filter
     * -----------------------------------------------------
     */
    if (!empty($_GET['location'])) {

        $location_slugs = array_map(
            'sanitize_text_field',
            explode(',', wp_unslash($_GET['location']))
        );

        $venue_ids = [];

        foreach ($location_slugs as $slug) {

            $venue_post = get_page_by_path(
                $slug,
                OBJECT,
                'tribe_venue'
            );

            if ($venue_post) {
                $venue_ids[] = $venue_post->ID;
            }
        }

        if (!empty($venue_ids)) {

            $meta_query[] = [
                'key' => '_EventVenueID',
                'value' => $venue_ids,
                'compare' => 'IN',
            ];
        }
    }

    /**
     * -----------------------------------------------------
     * Organizer Filter
     * -----------------------------------------------------
     */
    if (!empty($_GET['organizer'])) {

        $organizer_slugs = array_map(
            'sanitize_text_field',
            explode(',', wp_unslash($_GET['organizer']))
        );

        $organizer_ids = [];

        foreach ($organizer_slugs as $slug) {

            $organizer_post = get_page_by_path(
                $slug,
                OBJECT,
                'tribe_organizer'
            );

            if ($organizer_post) {
                $organizer_ids[] = $organizer_post->ID;
            }
        }

        if (!empty($organizer_ids)) {

            $meta_query[] = [
                'key' => '_EventOrganizerID',
                'value' => $organizer_ids,
                'compare' => 'IN',
            ];
        }
    }

    /**
     * -----------------------------------------------------
     * Apply Meta Query
     * -----------------------------------------------------
     */
    if (!empty($meta_query)) {

        $meta_query['relation'] = 'AND';

        $existing_meta_query = $query->get('meta_query');

        if (
            is_array($existing_meta_query) &&
            !empty($existing_meta_query)
        ) {

            $meta_query = [
                'relation' => 'AND',
                $existing_meta_query,
                $meta_query,
            ];
        }

        $query->set('meta_query', $meta_query);
    }

});

/**
 * =========================================================
 * Time of Day SQL WHERE
 * =========================================================
 */
add_filter('posts_where', function ($where, $query) {

    if (is_admin()) {
        return $where;
    }

    $post_types = (array) $query->get('post_type');

    if (
        !is_post_type_archive('tribe_events') &&
        !in_array('tribe_events', $post_types, true)
    ) {
        return $where;
    }

    if (empty($_GET['time_of_day'])) {
        return $where;
    }

    $times = array_map(
        'sanitize_text_field',
        explode(',', wp_unslash($_GET['time_of_day']))
    );

    $time_conditions = [];

    foreach ($times as $time) {

        switch ($time) {

            case 'morning':
                $time_conditions[] = "CAST(pm_start.meta_value AS TIME) BETWEEN '05:00:00' AND '11:59:59'";
                break;

            case 'afternoon':
                $time_conditions[] = "CAST(pm_start.meta_value AS TIME) BETWEEN '12:00:00' AND '16:59:59'";
                break;

            case 'evening':
                $time_conditions[] = "CAST(pm_start.meta_value AS TIME) BETWEEN '17:00:00' AND '20:59:59'";
                break;

            case 'night':
                $time_conditions[] = "(CAST(pm_start.meta_value AS TIME) >= '21:00:00' OR CAST(pm_start.meta_value AS TIME) <= '04:59:59')";
                break;
        }
    }

    if (!empty($time_conditions)) {

        $where .= ' AND (' . implode(' OR ', $time_conditions) . ')';
    }

    return $where;

}, 10, 2);

/**
 * =========================================================
 * Time of Day SQL JOIN
 * =========================================================
 */
add_filter('posts_join', function ($join, $query) {

    if (is_admin()) {
        return $join;
    }

    $post_types = (array) $query->get('post_type');

    if (
        !is_post_type_archive('tribe_events') &&
        !in_array('tribe_events', $post_types, true)
    ) {
        return $join;
    }

    if (empty($_GET['time_of_day'])) {
        return $join;
    }

    global $wpdb;

    if (strpos($join, 'pm_start') === false) {

        $join .= " LEFT JOIN {$wpdb->postmeta} AS pm_start
            ON (
                {$wpdb->posts}.ID = pm_start.post_id
                AND pm_start.meta_key = '_EventStartDate'
            )";
    }

    return $join;

}, 10, 2);

/**
 * =========================================================
 * Inject Default Category on Page Load Only
 * =========================================================
 * On a standard (non-AJAX) page load of the schedules page,
 * if no category is in the URL, inject the first featured
 * category so TEC queries the right events by default.
 *
 * AJAX view-switches are handled in pages.js via the
 * tribe_events_views_v2_before_make_request JS event.
 */
add_action('wp', function () {

    // Only on the schedules page
    if (strpos($_SERVER['REQUEST_URI'] ?? '', '/schedules/') === false) {
        return;
    }

    // Already has a category — nothing to do
    if (!empty($_GET['tribe_events_cat'])) {
        return;
    }

    // Resolve: explicit featured_cat param > default featured category
    $category = !empty($_GET['featured_cat'])
        ? sanitize_text_field(wp_unslash($_GET['featured_cat']))
        : pdop_get_default_featured_category_slug();

    if (empty($category)) {
        return;
    }

    $_GET['tribe_events_cat'] = $category;
    $_REQUEST['tribe_events_cat'] = $category;

}, 1);

/**
 * =========================================================
 * TEC Cache Key Busting
 * =========================================================
 */
add_filter('tribe_events_views_v2_view_cache_key', function ($cache_key) {

    $hash = '';

    if (!empty($_GET['time_of_day'])) {
        $hash .= 'time=' . sanitize_text_field(wp_unslash($_GET['time_of_day']));
    }
    if (!empty($_GET['organizer'])) {
        $hash .= 'org=' . sanitize_text_field(wp_unslash($_GET['organizer']));
    }
    if (!empty($_GET['location'])) {
        $hash .= 'loc=' . sanitize_text_field(wp_unslash($_GET['location']));
    }
    if (!empty($_GET['tribe_events_cat'])) {
        $hash .= 'cat=' . sanitize_text_field(wp_unslash($_GET['tribe_events_cat']));
    }

    if (!empty($hash)) {
        $cache_key .= '_' . md5($hash);
    }

    return $cache_key;

});

/**
 * =========================================================
 * Strip /category/slug/ from TEC View Switcher URLs
 * =========================================================
 * When a user is browsing a TEC category pretty-permalink
 * (/schedules/category/slug/), TEC builds view-switcher links
 * like /schedules/category/slug/list/. We strip the category
 * path segment so the switcher always produces clean URLs
 * like /schedules/list/?tribe_events_cat=slug, which our
 * JS then augments correctly.
 */
add_filter('tribe_events_views_v2_view_url', function ($url, $view) {

    // Strip /category/slug/ from path to get the clean base URL
    $parsed = wp_parse_url($url);
    if (!empty($parsed['path'])) {
        $clean_path = preg_replace('#/category/[^/]+/#', '/', $parsed['path']);
        $url = str_replace($parsed['path'], $clean_path, $url);
    }

    // Carry any active custom filter params into the new URL
    $carry_keys = ['tribe_events_cat', 'time_of_day', 'location', 'organizer', 'tag'];
    $carry = [];
    foreach ($carry_keys as $key) {
        if (!empty($_GET[$key])) {
            $carry[$key] = sanitize_text_field(wp_unslash($_GET[$key]));
        }
    }
    if (!empty($carry)) {
        $url = add_query_arg($carry, $url);
    }

    return $url;

}, 10, 2);

/**
 * =========================================================
 * Preserve tribe_events_cat in TEC REST Response URL
 * =========================================================
 * TEC's JS uses the `url` value from the REST JSON response
 * to update the browser address bar via history.pushState.
 * If that URL lacks tribe_events_cat, the address bar loses
 * it and the next page reload falls back to the default.
 *
 * We read tribe_events_cat from the REST request (which the
 * JS injected via ajaxSend) and put it back in the response URL.
 */
add_filter('tribe_events_views_v2_rest_response', function ($response, $request, $view) {

    $cat = $request->get_param('tribe_events_cat');
    if (empty($cat)) {
        return $response;
    }
    $cat = sanitize_text_field($cat);

    if (isset($response->data['url']) && strpos($response->data['url'], 'tribe_events_cat=') === false) {
        $response->data['url'] = add_query_arg('tribe_events_cat', $cat, $response->data['url']);
    }

    return $response;

}, 10, 3);