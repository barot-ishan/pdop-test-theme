<?php
/**
 * Template part for text & image Section
 */

if (!defined('ABSPATH')) {
    exit;
}
$text = get_sub_field('text');

?>

<section class="pdop_container text_img_section" aria-labelledby="section-<?php echo esc_attr(get_row_index()); ?>">
    <div class="row g-5">

        <!-- TEXT COLUMN -->
        <div class="col-lg-6">
            <?php if (!empty($text)): ?>
                <div id="section-<?php echo esc_attr(get_row_index()); ?>" class="text_content">
                    <?php echo wp_kses_post($text); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- IMAGE SLIDER COLUMN -->
        <div class="col-lg-6">
            <?php if (have_rows('image_slider')): ?>

                <div class="swiper awardsSwiper" role="region"
                    aria-label="<?php echo esc_attr__('Awards Image Slider', 'textdomain'); ?>">

                    <div class="swiper-wrapper">

                        <?php while (have_rows('image_slider')):
                            the_row(); ?>

                            <?php
                            $image = get_sub_field('image');

                            if (!empty($image)):
                                $image_id = is_array($image) ? $image['ID'] : $image;
                                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                $alt_text = !empty($alt_text) ? $alt_text : esc_html__('Award image', 'textdomain');
                                ?>

                                <div class="swiper-slide">
                                    <?php
                                    echo wp_get_attachment_image(
                                        $image_id,
                                        'full',
                                        false,
                                        [
                                            'alt' => esc_attr($alt_text),
                                            'loading' => 'lazy',
                                        ]
                                    );
                                    ?>
                                </div>

                            <?php endif; ?>

                        <?php endwhile; ?>

                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination" aria-hidden="true"></div>

                    <!-- Navigation -->
                    <div class="swiper-button-next" aria-label="Next slide"><svg xmlns="http://www.w3.org/2000/svg"
                            width="39" height="39" viewBox="0 0 39 39" fill="none">
                            <path
                                d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                                stroke="white" stroke-width="2" />
                            <path
                                d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                                stroke="white" stroke-width="2" />
                            <path d="M16.0469 12.6875L22.9539 19.5025L16.0469 26.3145" stroke="white" stroke-width="2"
                                stroke-miterlimit="10" />
                        </svg></div>
                    <div class="swiper-button-prev" aria-label="Previous slide"><svg xmlns="http://www.w3.org/2000/svg"
                            width="39" height="39" viewBox="0 0 39 39" fill="none">
                            <path
                                d="M19.5 1.5C29.4411 1.5 37.5 9.55887 37.5 19.5C37.5 29.4411 29.4411 37.5 19.5 37.5C9.55887 37.5 1.5 29.4411 1.5 19.5C1.5 9.55887 9.55887 1.5 19.5 1.5Z"
                                stroke="white" stroke-width="2" />
                            <path
                                d="M19.5 38C29.7173 38 38 29.7173 38 19.5C38 9.28273 29.7173 1 19.5 1C9.28273 1 1 9.28273 1 19.5C1 29.7173 9.28273 38 19.5 38Z"
                                stroke="white" stroke-width="2" />
                            <path d="M22.9539 12.6875L16.0469 19.5025L22.9539 26.3145" stroke="white" stroke-width="2"
                                stroke-miterlimit="10" />
                        </svg></div>

                </div>

            <?php endif; ?>
        </div>

    </div>
</section>