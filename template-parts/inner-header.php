<?php
/**
 * Inner Page Header
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_front_page()) {
    return;
}

// Default fallback (normal pages)
$page_id = get_the_ID();

// Flag for events archive
$is_events_page = is_post_type_archive('tribe_events') || is_tax('tribe_events_cat');

// Fetch fields
if ($is_events_page) {
    // Get from Options Page
    $header_image = get_field('header_image', 'option');
    $page_description = get_field('page_description', 'option');
    $banner_background_color = get_field('banner_background_color', 'option');
    $page_title = get_field('page_title', 'option');
} else {
    // Normal pages
    $header_image = get_field('header_image', $page_id);
    $page_description = get_field('page_description', $page_id);
    $banner_background_color = get_field('banner_background_color', $page_id);
    $page_title = get_field('page_title', $page_id);
}

// Fallback title
if (empty($page_title)) {
    $page_title = get_the_title($page_id);
}
?>


<style>
    .inner_header_wrapper {
        background-color:
            <?php echo $banner_background_color; ?>
        ;
    }
</style>
<section class="pdop_container inner_header_wrapper py-5" role="region" aria-labelledby="page-title">
    <div class="inner_header">

        <?php get_template_part('template-parts/breadcrumbs'); ?>

        <div class="inner_header_row">

            <?php if (!empty($header_image)): ?>
                <div class="inner_header_img_wrapper">
                    <img src="<?php echo esc_url($header_image['url']); ?>" title="<?php echo esc_attr($header_image['alt'] ?: get_the_title()); ?>" alt="<?php echo esc_attr($header_image['alt'] ?: get_the_title()); ?>" class="header_img">
                </div>
                <?php
            endif; ?>

            <div class="inner_header_content_wrapper">
                <div class="page_header_content d-flex flex-column justify-content-between h-100 row-gap-5">

                    <div class="page_header_content_inner">
                        <h1 id="page-title" class="pdop_page_title assa">
                            <?php echo $page_title; ?>
                        </h1>

                        <?php if (!empty($page_description)): ?>
                            <div class="pdop_page_description">
                                <?php echo wp_kses_post($page_description); ?>
                            </div>
                            <?php
                        endif; ?>
                    </div>

                    <?php if (is_page_template('templates/program.php') || is_page_template('templates/program-activity.php')): ?>
                        <a class="pdop_btn" href="" >Book Fitness Classes</a>
                        <?php else: ?>
                            <div class="page_header_content_footer">
                                <a href="#primary-content" class="scroll-down" aria-label="Scroll to main content">
                                    <img src="/wp-content/uploads/2026/03/Down-Arrow-1-1.svg" alt="Down arrow to main content" aria-hidden="true">
                                </a>
                            </div>
                        <?php endif; ?>
                        

                </div>
            </div>

        </div>
    </div>
</section>

<div id="primary-content" tabindex="-1"></div>