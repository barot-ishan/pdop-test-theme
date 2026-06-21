<?php

/**
 * Template part: Schedulepage - Don't Miss These
 *
 * Displays a grid of upcoming events with title, date, and link.
 * Fields are powered by ACF.
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_field('dont_miss_these_heading', 'option');
$subtitle = get_field('dont_miss_these_subtitle', 'option');

?>

<section class="pdop_dontmiss_container pdop_container" aria-labelledby="pdop_dontmiss_heading">
    <div class="pdop_dontmiss_inner position-relative z-1">
        <div class="pdop_dontmiss_header d-flex align-items-start justify-content-between">
            <div>
                <h2 class="pdop_dontmiss_heading" id="pdop_dontmiss_heading"><?php echo esc_html($heading); ?></h2>
                <div class="pdop_dontmiss_subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            </div>

            <div class="pdop_dontmiss_events_navigation d-flex justify-content-center gap-4 align-self-end">
                <button class="pdop_dontmiss_events_prev" aria-label="Previous">
                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path
                            d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                            stroke="#2B3C73" stroke-width="2" />
                        <path
                            d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                            stroke="#2B3C73" stroke-width="2" />
                        <path d="M22.9529 12.6875L16.0459 19.5025L22.9529 26.3145" stroke="#2B3C73" stroke-width="2"
                            stroke-miterlimit="10" />
                    </svg>
                </button>
                <button class="pdop_dontmiss_events_next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none"
                        aria-hidden="true">
                        <path
                            d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                            stroke="#2B3C73" stroke-width="2" />
                        <path
                            d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                            stroke="#2B3C73" stroke-width="2" />
                        <path d="M16.0459 12.6875L22.9529 19.5025L16.0459 26.3145" stroke="#2B3C73" stroke-width="2"
                            stroke-miterlimit="10" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="pdop_dontmiss_events pdop_dontmiss_events_swiper swiper">
            <div class="swiper-wrapper">
                <?php

                if (function_exists('tribe_get_events')) {

                    $events = tribe_get_events([
                        'posts_per_page' => 10,
                        'start_date' => current_time('Y-m-d H:i:s'),
                        's' => '', // Ignore any active TEC search keyword
                        'tribe_suppress_query_filters' => true,
                        'tax_query' => [
                            [
                                'taxonomy' => 'post_tag',
                                'field' => 'slug',
                                'terms' => ['upcoming-events', 'general-schedule'],
                            ],
                        ],
                    ]);

                    if (!empty($events)):
                        foreach ($events as $event):
                            echo event_card($event);
                        endforeach;
                    else:
                        ?>
                        <p class="pdop_dontmiss_events_empty">No events found.</p>
                        <?php
                    endif;
                } else {
                    echo '<p>Events plugin not active.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>