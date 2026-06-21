<?php

/**
 * Template part: Homepage – Upcoming Events
 *
 * Displays a grid of upcoming events with title, date, and link.
 * Fields are powered by ACF repeater "upcoming_events".
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('upcoming_event_heading');
$subtitle = get_sub_field('upcoming_event_subtitle');
$link = get_sub_field('upcoming_events_link');

?>

<section class="pdop_upcoming_events_container pdop_container" aria-labelledby="pdop_upcoming_events_heading"
    style="background-image: url('/wp-content/uploads/2026/04/upcoming_event_bg.webp');">
    <div class="pdop_upcoming_events_inner position-relative z-1">
        <div class="pdop_upcoming_events_header d-flex align-items-start justify-content-between">
            <div>
                <h2 class="pdop_upcoming_events_heading" id="pdop_upcoming_events_heading">
                    <?php echo esc_html($heading); ?></h2>
                <div class="pdop_upcoming_events_subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            </div>
            <div class="pdop_upcoming_events_header_links">
                <a href="/event" class="pdop_upcoming_events_link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none"
                        aria-hidden="true">
                        <g clip-path="url(#clip0_40002651_11876)">
                            <path
                                d="M22.7891 1.38477H20.4794V3.46054C20.4794 3.87569 20.0944 4.15246 19.7094 4.15246C19.3245 4.15246 18.9395 3.87569 18.9395 3.46054V1.38477H6.62088V3.46054C6.62088 3.87569 6.23593 4.15246 5.85097 4.15246C5.46601 4.15246 5.08105 3.87569 5.08105 3.46054V1.38477H2.77131C1.61644 1.38477 0.769531 2.28427 0.769531 3.46054V5.95146H25.4068V3.46054C25.4068 2.28427 24.021 1.38477 22.7891 1.38477ZM0.769531 7.4045V20.0667C0.769531 21.3122 1.61644 22.1425 2.8483 22.1425H22.8661C24.098 22.1425 25.4838 21.243 25.4838 20.0667V7.4045H0.769531ZM7.62177 19.0288H5.77398C5.46601 19.0288 5.15805 18.8212 5.15805 18.4753V16.7455C5.15805 16.4687 5.38902 16.1919 5.77398 16.1919H7.69876C8.00673 16.1919 8.3147 16.3995 8.3147 16.7455V18.4753C8.23771 18.8212 8.00673 19.0288 7.62177 19.0288ZM7.62177 12.8015H5.77398C5.46601 12.8015 5.15805 12.5939 5.15805 12.248V10.5182C5.15805 10.2414 5.38902 9.96461 5.77398 9.96461H7.69876C8.00673 9.96461 8.3147 10.1722 8.3147 10.5182V12.248C8.23771 12.5939 8.00673 12.8015 7.62177 12.8015ZM13.7811 19.0288H11.8563C11.5483 19.0288 11.2404 18.8212 11.2404 18.4753V16.7455C11.2404 16.4687 11.4713 16.1919 11.8563 16.1919H13.7811C14.0891 16.1919 14.397 16.3995 14.397 16.7455V18.4753C14.397 18.8212 14.166 19.0288 13.7811 19.0288ZM13.7811 12.8015H11.8563C11.5483 12.8015 11.2404 12.5939 11.2404 12.248V10.5182C11.2404 10.2414 11.4713 9.96461 11.8563 9.96461H13.7811C14.0891 9.96461 14.397 10.1722 14.397 10.5182V12.248C14.397 12.5939 14.166 12.8015 13.7811 12.8015ZM19.9404 19.0288H18.0156C17.7077 19.0288 17.3997 18.8212 17.3997 18.4753V16.7455C17.3997 16.4687 17.6307 16.1919 18.0156 16.1919H19.9404C20.2484 16.1919 20.5563 16.3995 20.5563 16.7455V18.4753C20.5563 18.8212 20.3254 19.0288 19.9404 19.0288ZM19.9404 12.8015H18.0156C17.7077 12.8015 17.3997 12.5939 17.3997 12.248V10.5182C17.3997 10.2414 17.6307 9.96461 18.0156 9.96461H19.9404C20.2484 9.96461 20.5563 10.1722 20.5563 10.5182V12.248C20.5563 12.5939 20.3254 12.8015 19.9404 12.8015Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_40002651_11876">
                                <rect width="26.1771" height="23.5254" fill="white" />
                            </clipPath>
                        </defs>
                    </svg> See All Free Events
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="1" height="28" viewBox="0 0 1 28" fill="none"
                    aria-hidden="true">
                    <line x1="0.5" y1="2.18558e-08" x2="0.499999" y2="28" stroke="#B4B4B4" />
                </svg>
                <a href="/event" class="pdop_upcoming_events_link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 27 24" fill="none"
                        aria-hidden="true">
                        <g clip-path="url(#clip0_40002651_11876)">
                            <path
                                d="M22.7891 1.38477H20.4794V3.46054C20.4794 3.87569 20.0944 4.15246 19.7094 4.15246C19.3245 4.15246 18.9395 3.87569 18.9395 3.46054V1.38477H6.62088V3.46054C6.62088 3.87569 6.23593 4.15246 5.85097 4.15246C5.46601 4.15246 5.08105 3.87569 5.08105 3.46054V1.38477H2.77131C1.61644 1.38477 0.769531 2.28427 0.769531 3.46054V5.95146H25.4068V3.46054C25.4068 2.28427 24.021 1.38477 22.7891 1.38477ZM0.769531 7.4045V20.0667C0.769531 21.3122 1.61644 22.1425 2.8483 22.1425H22.8661C24.098 22.1425 25.4838 21.243 25.4838 20.0667V7.4045H0.769531ZM7.62177 19.0288H5.77398C5.46601 19.0288 5.15805 18.8212 5.15805 18.4753V16.7455C5.15805 16.4687 5.38902 16.1919 5.77398 16.1919H7.69876C8.00673 16.1919 8.3147 16.3995 8.3147 16.7455V18.4753C8.23771 18.8212 8.00673 19.0288 7.62177 19.0288ZM7.62177 12.8015H5.77398C5.46601 12.8015 5.15805 12.5939 5.15805 12.248V10.5182C5.15805 10.2414 5.38902 9.96461 5.77398 9.96461H7.69876C8.00673 9.96461 8.3147 10.1722 8.3147 10.5182V12.248C8.23771 12.5939 8.00673 12.8015 7.62177 12.8015ZM13.7811 19.0288H11.8563C11.5483 19.0288 11.2404 18.8212 11.2404 18.4753V16.7455C11.2404 16.4687 11.4713 16.1919 11.8563 16.1919H13.7811C14.0891 16.1919 14.397 16.3995 14.397 16.7455V18.4753C14.397 18.8212 14.166 19.0288 13.7811 19.0288ZM13.7811 12.8015H11.8563C11.5483 12.8015 11.2404 12.5939 11.2404 12.248V10.5182C11.2404 10.2414 11.4713 9.96461 11.8563 9.96461H13.7811C14.0891 9.96461 14.397 10.1722 14.397 10.5182V12.248C14.397 12.5939 14.166 12.8015 13.7811 12.8015ZM19.9404 19.0288H18.0156C17.7077 19.0288 17.3997 18.8212 17.3997 18.4753V16.7455C17.3997 16.4687 17.6307 16.1919 18.0156 16.1919H19.9404C20.2484 16.1919 20.5563 16.3995 20.5563 16.7455V18.4753C20.5563 18.8212 20.3254 19.0288 19.9404 19.0288ZM19.9404 12.8015H18.0156C17.7077 12.8015 17.3997 12.5939 17.3997 12.248V10.5182C17.3997 10.2414 17.6307 9.96461 18.0156 9.96461H19.9404C20.2484 9.96461 20.5563 10.1722 20.5563 10.5182V12.248C20.5563 12.5939 20.3254 12.8015 19.9404 12.8015Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_40002651_11876">
                                <rect width="26.1771" height="23.5254" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    See Full Calendar
                </a>
            </div>

        </div>
        <div class="pdop_upcoming_events_list pdop_upcoming_events_swiper swiper">
            <div class="swiper-wrapper">
                <?php

                if (function_exists('tribe_get_events')) {

                    $events = tribe_get_events([
                        'posts_per_page' => 10,
                        'start_date' => current_time('Y-m-d H:i:s'),
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
                        <p class="pdop_upcoming_events_empty">No upcoming events found.</p>
                        <?php
                    endif;
                } else {
                    echo '<p>Events plugin not active.</p>';
                }
                ?>
            </div>
            <div class="pdop_upcoming_events_navigation d-flex justify-content-center gap-4 align-items-center">
                <button class="pdop_upcoming_events_prev" aria-label="Previous">
                    <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true">
                        <path
                            d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                            stroke="white" stroke-width="2" />
                        <path
                            d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                            stroke="white" stroke-width="2" />
                        <path d="M22.9529 12.6875L16.0459 19.5025L22.9529 26.3145" stroke="white" stroke-width="2"
                            stroke-miterlimit="10" />
                    </svg>
                </button>
                <button class="pdop_upcoming_events_next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" fill="none"
                        aria-hidden="true">
                        <path
                            d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                            stroke="white" stroke-width="2" />
                        <path
                            d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                            stroke="white" stroke-width="2" />
                        <path d="M16.0459 12.6875L22.9529 19.5025L16.0459 26.3145" stroke="white" stroke-width="2"
                            stroke-miterlimit="10" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>