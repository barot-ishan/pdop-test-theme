<?php

/**
 * Template part: Homepage – Newsroom
 *
 * Displays a grid of newsroom cards that link to the most popular newsroom.
 * Each card has an icon, title, and arrow button.
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('newsroom_heading');
$subtitle = get_sub_field('newsroom_subtitle');
$link = get_sub_field('newsroom_page_link');

?>
<section class="pdop_newsroom pdop_container" aria-labelledby="pdop_newsroom_title">
    <div class="pdop_newsroom_inner">
        <h2 class="pdop_newsroom_title" id="pdop_newsroom_title"><?php echo esc_html($heading); ?></h2>
        <div class="pdop_newsroom_subtitle"><?php echo wp_kses_post($subtitle); ?></div>

        <div class="pdop_newsroom_grid swiper pdop_newsroom_grid_swiper" role="region" aria-roledescription="carousel" aria-label="Newsroom">
            <div class="swiper-wrapper">
                <?php
                $args = array(
                    'post_type' => 'news',
                    'posts_per_page' => 4,
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) {
                    $index = 1;
                    while ($query->have_posts()) {
                        $query->the_post();

                        $title = get_the_title();
                        $permalink = get_the_permalink();
                        $date = get_the_date();

                        $aria_label = sprintf(
                            'Read news: %s, published on %s',
                            $title,
                            $date
                        );
                ?>
                        <div class="swiper-slide">
                            <a class="pdop_newsroom_card pdop_services_card" href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr($aria_label); ?>">
                                <article>
                                    <div class="pdop_newsroom_card_thumb">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="pdop_newsroom_card_content">
                                        <span class="pdop_newsroom_card_date">
                                            <span class="visually-hidden">Published on </span>
                                            <?php echo get_the_date(); ?></span>
                                        <div class="pdop_newsroom_card_tags" id="card-tags-<?php echo $index; ?>">
                                            <span class="visually-hidden">Categories: </span>
                                            <?php
                                            $terms = get_the_terms(get_the_ID(), 'category');
                                            if ($terms && !is_wp_error($terms)) {
                                                foreach ($terms as $term) {
                                                    echo '<span>' . $term->name . '</span>';
                                                }
                                            }
                                            ?>
                                        </div>
                                        <h3 class="pdop_newsroom_card_title"><?php echo esc_html($title); ?></h3>
                                        <span class="pdop_services_card_arrow pdop_newsroom_card_arrow">
                                            <span>Know more</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="14" viewBox="0 0 9 14" fill="none" aria-hidden="true">
                                                <path d="M1 1L7.05085 7L1 13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </a>
                        </div>
                <?php
                        $index++;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
            <div class="pdop_newsroom_navigation d-flex d-lg-none justify-content-center gap-4 align-items-center">
                <button class="pdop_upcoming_events_prev" aria-label="Previous">
                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2" />
                        <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2" />
                        <path d="M22.9529 12.6875L16.0459 19.5025L22.9529 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </button>
                <button class="pdop_upcoming_events_next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none" aria-hidden="true">
                        <path d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z" stroke="white" stroke-width="2" />
                        <path d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z" stroke="white" stroke-width="2" />
                        <path d="M16.0459 12.6875L22.9529 19.5025L16.0459 26.3145" stroke="white" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </button>
            </div>
        </div>
        <?php if (!empty($link)) { ?>
            <div class="pdop_newsroom_footer text-center">
                <a href="<?php echo esc_url($link['url']); ?>" class="pdop_newsroom_footer_link pdop_btn" aria-label="View All News"><?php echo esc_html($link['title']); ?></a>
            </div>
        <?php } ?>
    </div>
</section>