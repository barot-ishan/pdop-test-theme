<?php
if (!defined('ABSPATH')) {
    exit;
}
$main_heading = get_sub_field('services_heading');
?>
<section class="icon-box-layout">
    <div class="pdop_container">
        <?php if ($main_heading): ?>
            <h4><?= wp_kses_post($main_heading); ?></h4>
        <?php endif; ?>
        <?php if (have_rows('services_card')): ?>
            <div class="row justify-content-center gy-4" role="list">
                <?php while (have_rows('services_card')):
                    the_row(); ?>
                    <?php
                    $icon = get_sub_field('service_image');
                    $card_title = get_sub_field('service_title');
                    $service_link = get_sub_field('service_link');
                    $learn_more_text = $service_link['title'];
                    $learn_more_url = $service_link['url'];
                    ?>
                    <div class="position-relative col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-2" role="listitem">
                        <a href="<?= esc_url($learn_more_url); ?>" class="pdop_services_card">
                            <span class="pdop_services_card_icon" aria-hidden="true">
                                <img src="<?= esc_url($icon['url']); ?>" alt="<?php echo esc_attr($card_title); ?>" width="60"
                                    height="60" loading="lazy">
                            </span>
                            <p class="pdop_services_card_title"><?= wp_kses_post($card_title); ?></p>
                            <span class="pdop_services_card_arrow">
                                <span><?= wp_kses_post($learn_more_text); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="14" viewBox="0 0 9 14" fill="none"
                                    aria-hidden="true">
                                    <path d="M1 1L7.05085 7L1 13" stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
