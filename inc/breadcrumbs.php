<?php
if (!defined('ABSPATH'))
    exit;

function pdop_get_breadcrumbs()
{
    $breadcrumbs = [];

    // Home
    $breadcrumbs[] = [
        'label' => 'Home',
        'url' => home_url('/')
    ];

    // ======================
    // PAGE
    // ======================
    if (is_page()) {
        global $post;

        if ($post->post_parent) {
            $parents = array_reverse(get_post_ancestors($post->ID));

            foreach ($parents as $parent_id) {
                $breadcrumbs[] = [
                    'label' => get_the_title($parent_id),
                    'url' => get_permalink($parent_id)
                ];
            }
        }

        $breadcrumbs[] = [
            'label' => get_the_title(),
            'url' => ''
        ];
    }

    // ======================
    // STAFF SINGLE
    // ======================
    elseif (is_singular('staff')) {

        // Staff Directory page
        $staff_page = get_page_by_path('staff-directory');

        if ($staff_page) {
            $breadcrumbs[] = [
                'label' => get_the_title($staff_page),
                'url' => get_permalink($staff_page)
            ];
        }

        // Department taxonomy (if exists)
        $terms = get_the_terms(get_the_ID(), 'department');

        if (!empty($terms) && !is_wp_error($terms)) {
            $term = $terms[0]; // later we can improve sorting

            $breadcrumbs[] = [
                'label' => $term->name,
                'url' => get_term_link($term)
            ];
        }

        // Current staff
        $breadcrumbs[] = [
            'label' => get_the_title(),
            'url' => ''
        ];
    }

    // ======================
    // DEPARTMENT ARCHIVE
    // ======================
    elseif (is_tax('department')) {

        $staff_page = get_page_by_path('staff-directory');

        if ($staff_page) {
            $breadcrumbs[] = [
                'label' => get_the_title($staff_page),
                'url' => get_permalink($staff_page)
            ];
        }

        $term = get_queried_object();

        $breadcrumbs[] = [
            'label' => $term->name,
            'url' => ''
        ];
    }

    // ======================
    // BLOG POSTS (optional)
    // ======================
    elseif (is_single()) {

        $categories = get_the_category();

        if (!empty($categories)) {
            $cat = $categories[0];

            $breadcrumbs[] = [
                'label' => $cat->name,
                'url' => get_category_link($cat)
            ];
        }

        $breadcrumbs[] = [
            'label' => get_the_title(),
            'url' => ''
        ];
    }

    // ======================
    // ARCHIVES
    // ======================
    elseif (is_archive()) {

        // Events archive override
        if (is_post_type_archive('tribe_events') || is_tax('tribe_events_cat')) {

            $breadcrumbs[] = [
                'label' => get_field('page_title', 'option') ?: post_type_archive_title('', false),
                'url' => ''
            ];

        } else {
            $breadcrumbs[] = [
                'label' => post_type_archive_title('', false),
                'url' => ''
            ];
        }
    }

    return $breadcrumbs;
}

function pdop_breadcrumbs_schema($breadcrumbs)
{
    if (empty($breadcrumbs))
        return;

    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => []
    ];

    foreach ($breadcrumbs as $index => $crumb) {
        $schema['itemListElement'][] = [
            "@type" => "ListItem",
            "position" => $index + 1,
            "name" => $crumb['label'],
            "item" => !empty($crumb['url']) ? $crumb['url'] : ''
        ];
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}