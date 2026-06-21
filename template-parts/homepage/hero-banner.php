<?php

/**
 * Template part: Homepage Hero Banner Slider
 *
 * Accessible hero slider with video/image backgrounds, CTAs,
 * floating sidebar button, and quick-link card navigation.
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

if (have_rows('banners')) {
    $slide_index = 0;
    $slides_data = array();

    // Pre-collect slide data for quick links
    while (have_rows('banners')) {
        the_row();
        $slides_data[] = array(
            'hero_image'     => get_sub_field('hero_image'),
            'hero_video'     => get_sub_field('hero_video'),
            'hero_heading'   => get_sub_field('hero_heading') ?: 'WINTER REGISTRATION IS HERE!',
            'hero_subtitle'  => get_sub_field('hero_subtitle') ?: 'Browse all our programs running January-March.',
            'hero_cta_1'     => get_sub_field('hero_cta_1'),
            'hero_cta_2'     => get_sub_field('hero_cta_2'),
            'sidebar_btn_text' => get_sub_field('sidebar_btn_text') ?: 'Cancellations & Closures',
            'sidebar_btn_url'  => get_sub_field('sidebar_btn_url') ?: '#',
            'bottom_nav_image' => get_sub_field('bottom_nav_image'),
            'bottom_nav_title' => get_sub_field('bottom_nav_title'),
        );
    }

    $total_slides = count($slides_data);
?>
    <!-- Hero Banner Slider -->
    <section
        class="pdop_hero pdop_hero_slider"
        aria-roledescription="carousel"
        aria-label="Homepage Hero Banner"
        data-hero-slider>
        <!-- Live region — set to 'off' during autoplay, 'polite' on user interaction -->
        <div class="pdop_hero_slides" aria-live="off" data-slides-live>
            <?php foreach ($slides_data as $index => $slide) :
                $is_active = ($index === 0);

                // Image
                $hero_image   = $slide['hero_image'];
                $hero_heading = $slide['hero_heading'];
                $hero_img_url = '';
                $hero_img_alt = esc_attr($hero_heading);

                if (is_array($hero_image)) {
                    $hero_img_url = $hero_image['url'];
                    $hero_img_alt = $hero_image['alt'] ?: $hero_img_alt;
                } elseif (is_string($hero_image) && $hero_image) {
                    $hero_img_url = $hero_image;
                }

                if (empty($hero_img_url)) {
                    $hero_img_url = '/wp-content/uploads/2026/03/winter_banner.webp';
                }

                // Video
                $hero_video = $slide['hero_video'];
                $hero_video_url = '';
                if (is_array($hero_video) && !empty($hero_video['url'])) {
                    $hero_video_url = $hero_video['url'];
                } elseif (is_string($hero_video) && $hero_video) {
                    $hero_video_url = $hero_video;
                }

                // CTAs
                $cta_1 = $slide['hero_cta_1'];
                $cta_2 = $slide['hero_cta_2'];
                $cta_1_link = '';
                $cta_2_link = '';

                if (!empty($cta_1)) {
                    $cta_1_link = '<a href="' . esc_url($cta_1['url']) . '" class="pdop_btn pdop_btn_secondary"' . (!empty($cta_1['target']) ? ' target="' . esc_attr($cta_1['target']) . '" rel="noopener"' : '') . '>' . esc_html($cta_1['title']) . '</a>';
                }
                if (!empty($cta_2)) {
                    $cta_2_link = '<a href="' . esc_url($cta_2['url']) . '" class="pdop_btn"' . (!empty($cta_2['target']) ? ' target="' . esc_attr($cta_2['target']) . '" rel="noopener"' : '') . '>' . esc_html($cta_2['title']) . '</a>';
                }
            ?>
                <div
                    class="pdop_hero_slide<?php echo $is_active ? ' is-active' : ''; ?>"
                    id="hero-slide-<?php echo $index; ?>"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="Slide <?php echo $index + 1; ?> of <?php echo $total_slides; ?>: <?php echo esc_attr($hero_heading); ?>"
                    aria-hidden="<?php echo $is_active ? 'false' : 'true'; ?>"
                    data-slide-index="<?php echo $index; ?>">
                    <?php if (!empty($hero_video_url)) : ?>
                        <!-- Video Background -->
                        <video
                            class="pdop_hero_video"
                            <?php echo $is_active ? 'autoplay' : ''; ?>
                            muted
                            loop
                            playsinline
                            preload="<?php echo $is_active ? 'auto' : 'none'; ?>"
                            poster="<?php echo esc_url($hero_img_url); ?>"
                            aria-hidden="true">
                            <source src="<?php echo esc_url($hero_video_url); ?>" type="video/mp4" />
                        </video>
                    <?php endif; ?>

                    <!-- Fallback / Poster Image -->
                    <img
                        class="pdop_hero_img<?php echo !empty($hero_video_url) ? ' pdop_hero_img--has-video' : ''; ?>"
                        src="<?php echo esc_url($hero_img_url); ?>"
                        alt="<?php echo esc_attr($hero_img_alt); ?>"
                        loading="<?php echo $is_active ? 'eager' : 'lazy'; ?>"
                        <?php echo $is_active ? 'fetchpriority="high"' : ''; ?>
                        decoding="async" />

                    <!-- Dark Overlay -->
                    <div class="pdop_hero_overlay" aria-hidden="true"></div>

                    <!-- Slide Content -->
                    <div class="pdop_hero_content">
                        <h2 class="pdop_hero_heading">
                            <?php echo esc_html($hero_heading); ?>
                        </h2>

                        <p class="pdop_hero_subtitle">
                            <?php echo wp_kses( $slide['hero_subtitle'], array( 'span' => array( 'class' => true, 'style' => true, ), ) ); ?>
                        </p>

                        <div class="pdop_hero_actions">
                            <?php echo $cta_1_link; ?>
                            <?php echo $cta_2_link; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- /.pdop_hero_slides -->

        <!-- Quick Links / Slide Navigation -->
        <nav class="pdop_quick_links" role="tablist" aria-label="Slide Navigation">
            <?php foreach ($slides_data as $index => $slide) :
                $is_active = ($index === 0);
                $bottom_nav_image = $slide['bottom_nav_image'];
                $bottom_nav_title = $slide['bottom_nav_title'];

                if (!empty($bottom_nav_image) || !empty($bottom_nav_title)) :
            ?>
                    <button
                        class="pdop_quick_link_card<?php echo $is_active ? ' is-active' : ''; ?>"
                        role="tab"
                        data-slide-target="<?php echo $index; ?>"
                        aria-controls="hero-slide-<?php echo $index; ?>"
                        aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                        type="button">
                        <?php if (!empty($bottom_nav_image)) : ?>
                            <span class="pdop_quick_link_thumb">
                                <img
                                    src="<?php echo esc_url($bottom_nav_image['url']); ?>"
                                    alt="<?php echo esc_attr(!empty($bottom_nav_image['alt']) ? $bottom_nav_image['alt'] : $bottom_nav_title . ' Slide thumbnail'); ?>"
                                    loading="lazy"
                                    width="60"
                                    height="60" />
                            </span>
                        <?php endif; ?>
                        <span class="pdop_quick_link_label"><?php echo esc_html($bottom_nav_title); ?></span>
                    </button>
            <?php
                endif;
            endforeach; ?>
        </nav>

        <!-- Floating Sidebar Button -->
        <?php
        // Use last slide's sidebar data (or first available)
        $sidebar_text = $slides_data[0]['sidebar_btn_text'];
        $sidebar_url  = $slides_data[0]['sidebar_btn_url'];
        ?>
        <a
            href="<?php echo esc_url($sidebar_url); ?>"
            class="pdop_sidebar_btn"
            aria-label="<?php echo esc_attr($sidebar_text); ?>">
            <span class="pdop_sidebar_btn_icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="20" viewBox="0 0 17 20" fill="none">
                    <path d="M3.58784 20C3.51576 20 3.44441 19.9856 3.37797 19.9577C3.31154 19.9297 3.25137 19.8887 3.20101 19.8372C3.15064 19.7856 3.1111 19.7245 3.0847 19.6574C3.0583 19.5904 3.04559 19.5187 3.0473 19.4466V16.9527H0.540541C0.39718 16.9527 0.259692 16.8958 0.158321 16.7944C0.0569499 16.693 0 16.5555 0 16.4122V0.540541C0 0.39718 0.0569499 0.259692 0.158321 0.158321C0.259692 0.0569499 0.39718 0 0.540541 0H13.0473C13.1907 0 13.3281 0.0569499 13.4295 0.158321C13.5309 0.259692 13.5878 0.39718 13.5878 0.540541V3.0473H16.0946C16.238 3.0473 16.3754 3.10425 16.4768 3.20562C16.5782 3.30699 16.6351 3.44448 16.6351 3.58784V19.4595C16.6351 19.6028 16.5782 19.7403 16.4768 19.8417C16.3754 19.9431 16.238 20 16.0946 20H3.58784ZM7.02905 18.9189H15.5541V4.12838H13.5878V16.4C13.5905 16.5186 13.5541 16.6347 13.4843 16.7306C13.4145 16.8264 13.315 16.8966 13.2014 16.9304L7.02905 18.9189ZM4.12838 16.9527V18.7162L9.60676 16.9514L4.12838 16.9527ZM1.08108 15.8716H12.5068V1.08108H1.08108V15.8716ZM10 13.4932H3.58784C3.44448 13.4932 3.30699 13.4363 3.20562 13.3349C3.10425 13.2336 3.0473 13.0961 3.0473 12.9527C3.0473 12.8093 3.10425 12.6719 3.20562 12.5705C3.30699 12.4691 3.44448 12.4122 3.58784 12.4122H10C10.1434 12.4122 10.2808 12.4691 10.3822 12.5705C10.4836 12.6719 10.5405 12.8093 10.5405 12.9527C10.5405 13.0961 10.4836 13.2336 10.3822 13.3349C10.2808 13.4363 10.1434 13.4932 10 13.4932ZM10 11.6487H3.58784C3.44448 11.6487 3.30699 11.5917 3.20562 11.4903C3.10425 11.389 3.0473 11.2515 3.0473 11.1081C3.0473 10.9647 3.10425 10.8273 3.20562 10.7259C3.30699 10.6245 3.44448 10.5676 3.58784 10.5676H10C10.1434 10.5676 10.2808 10.6245 10.3822 10.7259C10.4836 10.8273 10.5405 10.9647 10.5405 11.1081C10.5405 11.2515 10.4836 11.389 10.3822 11.4903C10.2808 11.5917 10.1434 11.6487 10 11.6487ZM10 9.0473H3.58784C3.51685 9.0473 3.44656 9.03332 3.38098 9.00615C3.3154 8.97899 3.25581 8.93917 3.20562 8.88898C3.15542 8.83878 3.11561 8.77919 3.08844 8.71361C3.06128 8.64803 3.0473 8.57774 3.0473 8.50676V3.58784C3.0473 3.44448 3.10425 3.30699 3.20562 3.20562C3.30699 3.10425 3.44448 3.0473 3.58784 3.0473H10C10.1434 3.0473 10.2808 3.10425 10.3822 3.20562C10.4836 3.30699 10.5405 3.44448 10.5405 3.58784V8.50676C10.5405 8.65012 10.4836 8.78761 10.3822 8.88898C10.2808 8.99035 10.1434 9.0473 10 9.0473ZM4.12838 7.96622H9.45946V4.12838H4.12838V7.96622Z" fill="white" />
                </svg>
            </span>
            <span class="pdop_sidebar_btn_text"><?php echo esc_html($sidebar_text); ?></span>
        </a>

        <!-- Wave SVG -->
        <svg class="pdop_hero_wave d-none d-md-block" xmlns="http://www.w3.org/2000/svg" width="1920" height="177" viewBox="0 0 1920 177" fill="none" aria-hidden="true">
            <path d="M1920 0C1863.95 37.321 1771.51 88.7366 1650.56 107.52C1350.71 154.084 1257.16 69.8622 952.5 67.8398C658.536 65.8885 580.719 134.29 273.13 93.6627C153.942 77.9206 60.3398 34.2982 0 0C0 102.613 0 157.84 0 157.84H1920V0Z" fill="#F9AC1B" />
            <path d="M1920 5C1863.95 42.321 1771.51 93.7366 1650.56 112.52C1350.71 159.084 1257.16 74.8622 952.5 72.8398C658.536 70.8885 580.719 139.29 273.13 98.6627C153.942 82.9206 60.3398 39.2982 0 5C0 107.613 0 162.84 0 162.84H1920V5Z" fill="#009AD0" />
            <path d="M1920 19C1863.95 56.321 1771.51 107.737 1650.56 126.52C1350.71 173.084 1257.16 88.8622 952.5 86.8398C658.536 84.8885 580.719 153.29 273.13 112.663C153.942 96.9206 60.3398 53.2982 0 19C0 121.613 0 176.84 0 176.84H1920V19Z" fill="#2B3C73" />
        </svg>

        <svg class="pdop_hero_wave pdop_hero_wave_mobile d-md-none" xmlns="http://www.w3.org/2000/svg" width="375" height="42" viewBox="0 0 375 42" fill="none" aria-hidden="true">
            <path d="M375 0C364.053 7.28925 345.999 17.3314 322.375 21C263.811 30.0945 245.538 13.645 186.035 13.25C128.62 12.8688 113.422 26.2285 53.3456 18.2935C30.0668 15.2189 11.7851 6.69887 0 0C0 20.0416 0 30.8281 0 30.8281H375V0Z" fill="#F9AC1B" />
            <path d="M375 4.97656C364.053 12.2658 345.999 22.3079 322.375 25.9766C263.811 35.0711 245.538 18.6215 186.035 18.2265C128.62 17.8454 113.422 31.205 53.3456 23.2701C30.0668 20.1954 11.7851 11.6754 0 4.97656C0 25.0182 0 35.8047 0 35.8047H375V4.97656Z" fill="#009AD0" />
            <path d="M375 10.7109C364.053 18.0002 345.999 28.0423 322.375 31.7109C263.811 40.8054 245.538 24.3559 186.035 23.9609C128.62 23.5798 113.422 36.9394 53.3456 29.0044C30.0668 25.9298 11.7851 17.4098 0 10.7109C0 30.7526 0 41.5391 0 41.5391H375V10.7109Z" fill="#2B3C73" />
        </svg>
    </section>
<?php
}
