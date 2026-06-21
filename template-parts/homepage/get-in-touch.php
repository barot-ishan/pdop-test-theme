<?php

/**
 * Template part: Homepage – Get in Touch
 *
 * Displays a grid of get in touch cards that link to contact page.
 * Fields are powered by ACF repeater "get_in_touch".
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('get_in_touch_heading');
$subtitle = get_sub_field('get_in_touch_subtitle');
$link = get_sub_field('contact_page_link');

?>

<section class="pdop_get_in_touch_container pdop_current_projects pdop_container" aria-labelledby="pdop_get_in_touch_heading">
    <div class="pdop_current_projects_inner pdop_get_in_touch_inner">
        <div class="pdop_current_projects_header">
            <h2 class="pdop_current_projects_heading" id="pdop_get_in_touch_heading"><?php echo esc_html($heading); ?></h2>
            <div class="pdop_current_projects_subtitle"><?php echo wp_kses_post($subtitle); ?></div>
            <?php if (!empty($link)) { ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="pdop_current_projects_link pdop_btn">
                    <span aria-hidden="true"><?php echo esc_html($link['title']); ?></span>
                    <span class="visually-hidden">View all Contacts</span>
                </a>
            <?php } ?>
        </div>
        <div class="pdop_get_in_touch_grid">
            <?php

            if (have_rows('walk_in_service')) {
                while (have_rows('walk_in_service')) {
                    the_row();

                    $label = get_sub_field('label');
                    $service_name = get_sub_field('service_name');
                    $address = get_sub_field('address');
                    $phone = get_sub_field('phone');
                    $fax = get_sub_field('fax');
                    $map_view = get_sub_field('map_view');
                    $map_url = get_sub_field('map_link');
            ?>
                    <article class="pdop_get_in_touch_card_large" aria-labelledby="pdop_get_in_touch_card_large_title-<?php echo get_row_index(); ?>">
                        <h3 id="pdop_get_in_touch_card_large_title-<?php echo get_row_index(); ?>" class="pdop_get_in_touch_card_title"><?php echo esc_html($label); ?></h3>
                        <div class="pdop_get_in_touch_card_content d-flex align-items-center justify-content-between flex-column flex-sm-row">
                            <div class="pdop_get_in_touch_card_content_left">
                                <h4><?php echo esc_html($service_name); ?></h4>
                                <div>
                                    <?php if (!empty($address)) { ?>
                                        <div class="d-flex mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                <mask id="mask0_40000315_44200" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                                    <rect width="18" height="18" fill="#D9D9D9" />
                                                </mask>
                                                <g mask="url(#mask0_40000315_44200)">
                                                    <path d="M9.06421 9.14667C9.4779 9.14667 9.83205 8.99937 10.1266 8.70477C10.4212 8.41017 10.5685 8.05603 10.5685 7.64233C10.5685 7.22864 10.4212 6.8745 10.1266 6.5799C9.83205 6.2853 9.4779 6.138 9.06421 6.138C8.65052 6.138 8.29637 6.2853 8.00177 6.5799C7.70717 6.8745 7.55988 7.22864 7.55988 7.64233C7.55988 8.05603 7.70717 8.41017 8.00177 8.70477C8.29637 8.99937 8.65052 9.14667 9.06421 9.14667ZM9.06421 16.6683C7.04589 14.9509 5.53843 13.3557 4.54181 11.8827C3.54519 10.4097 3.04688 9.04638 3.04688 7.79277C3.04688 5.91235 3.65174 4.41428 4.86148 3.29857C6.07121 2.18286 7.47212 1.625 9.06421 1.625C10.6563 1.625 12.0572 2.18286 13.2669 3.29857C14.4767 4.41428 15.0815 5.91235 15.0815 7.79277C15.0815 9.04638 14.5832 10.4097 13.5866 11.8827C12.59 13.3557 11.0825 14.9509 9.06421 16.6683Z" fill="#009AD0" />
                                                </g>
                                            </svg><a href="<?php echo esc_url($address['url']); ?>" target="<?php echo esc_attr($address['target']); ?>" rel="noopener noreferrer" aria-label="View location of <?php echo esc_attr($service_name); ?> on map"><?php echo esc_html($address['title']); ?></a>
                                        </div>
                                    <?php } ?>
                                    <?php if (!empty($phone) || !empty($fax)) { ?>
                                        <div class="d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                                                <mask id="mask0_40000315_44205" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                                                    <rect width="18" height="18" fill="#D9D9D9" />
                                                </mask>
                                                <g mask="url(#mask0_40000315_44205)">
                                                    <path d="M15.0905 11.5375C14.1799 11.5392 13.2748 11.3953 12.4095 11.1115C12.2062 11.0456 11.9892 11.0341 11.7801 11.0781C11.5709 11.122 11.3769 11.2199 11.2174 11.3621L9.52974 12.6386C7.70986 11.7331 6.23505 10.2586 5.3291 8.43899L6.5639 6.79156C6.72212 6.6338 6.8337 6.43542 6.88633 6.21828C6.93896 6.00114 6.93059 5.77368 6.86215 5.56099C6.57721 4.69394 6.43253 3.78697 6.43357 2.8743C6.43313 2.55464 6.306 2.24819 6.08003 2.02208C5.85407 1.79597 5.54769 1.66863 5.22801 1.66797H2.46601C2.14605 1.66819 1.83924 1.79533 1.61292 2.02149C1.38659 2.24765 1.25923 2.55436 1.25879 2.8743C1.26299 6.54125 2.7216 10.0568 5.31464 12.6497C7.90768 15.2427 11.4234 16.7012 15.0905 16.7054C15.4103 16.705 15.7169 16.5777 15.9431 16.3516C16.1692 16.1254 16.2964 15.8189 16.2969 15.4991V12.7422C16.2958 12.4228 16.1683 12.1167 15.9422 11.891C15.7162 11.6653 15.41 11.5382 15.0905 11.5375Z" fill="#009AD0" />
                                                </g>
                                            </svg>
                                            <?php if (!empty($phone)) { ?>
                                                <a href="tel:<?php echo esc_attr($phone); ?>" aria-label="Call <?php echo esc_attr($service_name); ?> at <?php echo esc_attr($phone); ?>">P: <?php echo esc_html($phone); ?></a>
                                            <?php } ?>
                                            <?php if (!empty($fax)) { ?>
                                                <a href="tel:<?php echo esc_attr($fax); ?>" aria-label="Call <?php echo esc_attr($service_name); ?> at <?php echo esc_attr($fax); ?>">F: <?php echo esc_html($fax); ?></a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php

                                if (have_rows('timings')) {
                                ?>
                                    <hr>
                                    <div class="pdop_get_in_touch_card_content_timing">
                                        <?php
                                        while (have_rows('timings')) {
                                            the_row();
                                            $day = get_sub_field('days');
                                            $time = get_sub_field('time');
                                        ?>
                                            <div class="d-flex justify-content-between align-items-center"><span><?php echo esc_html($day); ?></span><span><?php echo esc_html($time); ?></span></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                }

                                ?>
                            </div>
                            <?php if (!empty($address)) {
                                $iframe_button_text = get_sub_field('iframe_button_text') ?: 'Get Directions';
                            ?>
                                <div class="pdop_get_in_touch_card_content_right">
                                    <iframe src="https://www.google.com/maps?q=<?php echo esc_attr($address['title']); ?>&output=embed" width="253" height="207" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" title="Map showing location of <?php echo esc_attr($service_name); ?>" aria-label="Map showing location of <?php echo esc_attr($service_name); ?>"></iframe>
                                    <a href="<?php echo esc_url($address['url']); ?>" target="<?php echo esc_attr($address['target']); ?>" rel="noopener noreferrer" class="pdop_btn" aria-label="Get directions to <?php echo esc_attr($service_name); ?>"><?php echo esc_html($iframe_button_text); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </article>
                <?php

                }
            }


            if (have_rows('contact_us')) {
                while (have_rows('contact_us')) {
                    the_row();

                    $label = get_sub_field('label');
                ?>
                    <article class="pdop_get_in_touch_card_small d-flex flex-column" aria-labelledby="pdop_get_in_touch_card_small_title-<?php echo get_row_index(); ?>">
                        <h3 id="pdop_get_in_touch_card_small_title-<?php echo get_row_index(); ?>" class="pdop_get_in_touch_card_title"><?php echo esc_html($label); ?></h3>
                        <?php
                        $phone_title = get_sub_field('phone_title');
                        $phone = get_sub_field('phone');
                        $email_title = get_sub_field('email_title');
                        $email = get_sub_field('email');
                        ?>
                        <div class="pdop_get_in_touch_card_content flex-grow-1 d-flex d-md-block align-items-center justify-content-between">
                            <div>

                                <h4><?php echo esc_html($phone_title); ?></h4>
                                <?php if (!empty($phone)) { ?>
                                    <a href="tel:<?php echo esc_attr($phone); ?>" class="d-flex align-items-center gap-1 gap-md-3" rel="noopener noreferrer" title="<?php echo esc_attr($phone); ?>" aria-label="Call <?php echo esc_attr($phone_title); ?> at <?php echo esc_attr($phone); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none" aria-hidden="true">
                                            <mask id="mask0_40000319_44307" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="23" height="22">
                                                <rect width="22.018" height="22" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40000319_44307)">
                                                <path d="M18.9685 13.5056C17.8566 13.5076 16.7515 13.3322 15.695 12.9859C15.4468 12.9055 15.1818 12.8914 14.9265 12.9451C14.6711 12.9987 14.4342 13.1182 14.2394 13.2916L12.1788 14.8489C9.95678 13.7442 8.15605 11.9454 7.04989 9.72544L8.55757 7.71558C8.75076 7.52313 8.887 7.28109 8.95126 7.01619C9.01552 6.75128 9.0053 6.47378 8.92173 6.2143C8.57382 5.15651 8.39717 4.05001 8.39843 2.93656C8.3979 2.54658 8.24267 2.17271 7.96677 1.89686C7.69087 1.621 7.31678 1.46565 6.92646 1.46484H3.55409C3.16342 1.46511 2.78881 1.62022 2.51246 1.89614C2.23612 2.17205 2.08062 2.54623 2.08008 2.93656C2.08521 7.41021 3.86616 11.6992 7.03224 14.8625C10.1983 18.0259 14.491 19.8053 18.9685 19.8104C19.359 19.8099 19.7333 19.6546 20.0094 19.3787C20.2856 19.1029 20.4409 18.7288 20.4415 18.3387V14.9753C20.4401 14.5856 20.2844 14.2123 20.0084 13.9369C19.7324 13.6615 19.3585 13.5064 18.9685 13.5056Z" fill="#009AD0" />
                                            </g>
                                        </svg>
                                        <?php echo esc_html($phone); ?></a>
                                <?php } ?>

                            </div>
                            <hr>
                            <div>
                                <?php if (!empty($email)) { ?>
                                    <h4><?php echo esc_html($email_title); ?></h4>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="d-flex align-items-center gap-1 gap-md-3" rel="noopener noreferrer" title="<?php echo esc_attr($email); ?>" aria-label="Send email to <?php echo esc_attr($email); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                                            <mask id="mask0_40000319_44316" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="22" height="22">
                                                <rect width="22" height="22" fill="#D9D9D9" />
                                            </mask>
                                            <g mask="url(#mask0_40000319_44316)">
                                                <path d="M3.66927 18.3307C3.1651 18.3307 2.73351 18.1512 2.37448 17.7922C2.01545 17.4332 1.83594 17.0016 1.83594 16.4974V5.4974C1.83594 4.99323 2.01545 4.56163 2.37448 4.2026C2.73351 3.84358 3.1651 3.66406 3.66927 3.66406H18.3359C18.8401 3.66406 19.2717 3.84358 19.6307 4.2026C19.9898 4.56163 20.1693 4.99323 20.1693 5.4974V16.4974C20.1693 17.0016 19.9898 17.4332 19.6307 17.7922C19.2717 18.1512 18.8401 18.3307 18.3359 18.3307H3.66927ZM11.0026 11.9141L18.3359 7.33073V5.4974L11.0026 10.0807L3.66927 5.4974V7.33073L11.0026 11.9141Z" fill="#009AD0" />
                                            </g>
                                        </svg>
                                        <?php echo esc_html($email); ?></a>
                                <?php } ?>
                            </div>
                        </div>

                    </article>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>