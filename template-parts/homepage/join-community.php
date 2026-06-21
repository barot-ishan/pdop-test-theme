<?php

/**
 * Template part: Homepage – Join Community
 *
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

$heading = get_sub_field('join_community_heading');
$subtitle = get_sub_field('join_community_subtitle');
$instagram_link = get_sub_field('instagram_link');
$facebook_link = get_sub_field('facebook_link');

?>

<section class="pdop_join_community" aria-labelledby="pdop-join-community-heading">
    <h2 class="pdop_join_community_title text-center" id="pdop_join_community_title"><?php echo esc_html($heading); ?>
    </h2>
    <div class="pdop_join_community_subtitle text-center">
        <?php echo wp_kses_post($subtitle); ?>
    </div>
    <div class="pdop_join_community_cta">
        <?php if (!empty($instagram_link)): ?>
            <a href="<?php echo esc_url($instagram_link['url']); ?>" class="pdop_join_community_cta_btn"
                target="<?php echo esc_attr($instagram_link['target']); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"
                    aria-hidden="true">
                    <g clip-path="url(#clip0_40002651_11085)">
                        <path
                            d="M1.62566 1.76964C-0.417503 3.89189 0.000663467 6.14631 0.000663467 12.9951C0.000663467 18.6826 -0.99167 24.3842 4.20183 25.7265C5.82358 26.1436 20.1929 26.1436 21.8125 25.7243C23.9748 25.1664 25.7342 23.4125 25.9747 20.3542C26.0082 19.9274 26.0082 6.07048 25.9736 5.63498C25.7179 2.37739 23.7127 0.499976 21.0704 0.119726C20.4648 0.0319756 20.3435 0.00597556 17.2365 0.00055889C6.21575 0.00597556 3.79991 -0.484775 1.62566 1.76964Z"
                            fill="url(#paint0_linear_40002651_11085)" />
                        <path
                            d="M12.9983 3.39989C9.0647 3.39989 5.32937 3.04997 3.90262 6.71164C3.31328 8.22397 3.39887 10.1881 3.39887 13.0004C3.39887 15.4682 3.31978 17.7876 3.90262 19.2881C5.32612 22.9519 9.09178 22.6009 12.9961 22.6009C16.7629 22.6009 20.6466 22.9931 22.0907 19.2881C22.6811 17.7606 22.5945 15.8257 22.5945 13.0004C22.5945 9.24989 22.8014 6.82864 20.9825 5.01081C19.1408 3.16914 16.6502 3.39989 12.994 3.39989H12.9983ZM12.1381 5.12997C20.3433 5.11697 21.3876 4.20481 20.8113 16.8766C20.6065 21.3583 17.194 20.8665 12.9994 20.8665C5.35103 20.8665 5.13112 20.6476 5.13112 12.9961C5.13112 5.25564 5.73778 5.13431 12.1381 5.12781V5.12997ZM18.1225 6.72356C17.4865 6.72356 16.9709 7.23922 16.9709 7.87514C16.9709 8.51106 17.4865 9.02672 18.1225 9.02672C18.7584 9.02672 19.274 8.51106 19.274 7.87514C19.274 7.23922 18.7584 6.72356 18.1225 6.72356ZM12.9983 8.07014C10.2759 8.07014 8.06912 10.278 8.06912 13.0004C8.06912 15.7228 10.2759 17.9296 12.9983 17.9296C15.7207 17.9296 17.9264 15.7228 17.9264 13.0004C17.9264 10.278 15.7207 8.07014 12.9983 8.07014ZM12.9983 9.80022C17.2287 9.80022 17.2341 16.2006 12.9983 16.2006C8.76895 16.2006 8.76245 9.80022 12.9983 9.80022Z"
                            fill="white" />
                    </g>
                    <defs>
                        <linearGradient id="paint0_linear_40002651_11085" x1="1.67552" y1="24.3399" x2="25.8398"
                            y2="3.42603" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FFDD55" />
                            <stop offset="0.5" stop-color="#FF543E" />
                            <stop offset="1" stop-color="#C837AB" />
                        </linearGradient>
                        <clipPath id="clip0_40002651_11085">
                            <rect width="26" height="26" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <?php echo esc_html($instagram_link['title']); ?>
            </a>
        <?php endif; ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="1" height="37" viewBox="0 0 1 28" fill="none">
            <line x1="0.5" y1="2.18558e-08" x2="0.499999" y2="37" stroke="#B4B4B4" />
        </svg>
        <?php if (!empty($facebook_link)): ?>
            <a href="<?php echo esc_url($facebook_link['url']); ?>" class="pdop_join_community_cta_btn"
                target="<?php echo esc_attr($facebook_link['target']); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                    <g clip-path="url(#clip0_40002651_11038)">
                        <path
                            d="M26 13C26 19.4888 21.2459 24.8671 15.0312 25.8421V16.7578H18.0604L18.6367 13H15.0312V10.5615C15.0312 9.53316 15.535 8.53125 17.1498 8.53125H18.7891V5.33203C18.7891 5.33203 17.3012 5.07812 15.8788 5.07812C12.9096 5.07812 10.9688 6.87781 10.9688 10.1359V13H7.66797V16.7578H10.9688V25.8421C4.75414 24.8671 0 19.4888 0 13C0 5.82055 5.82055 0 13 0C20.1795 0 26 5.82055 26 13Z"
                            fill="#1877F2" />
                        <path
                            d="M18.0604 16.7578L18.6367 13H15.0312V10.5614C15.0312 9.53337 15.5349 8.53125 17.1498 8.53125H18.7891V5.33203C18.7891 5.33203 17.3014 5.07812 15.879 5.07812C12.9096 5.07812 10.9688 6.87781 10.9688 10.1359V13H7.66797V16.7578H10.9688V25.842C11.6306 25.9459 12.309 26 13 26C13.691 26 14.3694 25.9459 15.0312 25.842V16.7578H18.0604Z"
                            fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_40002651_11038">
                            <rect width="26" height="26" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <?php echo esc_html($facebook_link['title']); ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="img_marquee">
        <div class="img_marquee_inner">
            <img src="/wp-content/uploads/2026/05/community-slide_1.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_2.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_3.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_4.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_5.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <?php /* Duplicate slides Bellow */ ?>
            <!-- <img src="/wp-content/uploads/2026/05/community-slide_1.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image"> -->
            <img src="/wp-content/uploads/2026/05/community-slide_2.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_3.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_4.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
            <img src="/wp-content/uploads/2026/05/community-slide_5.svg" width="610" height="610" alt="<?php echo esc_html($heading); ?> image">
        </div>
    </div>
    <?php /* Hidden marquee for mobile devices with dummy images */ /* ?>
    <div class="img_marquee d-none">
        <div class="img_marquee_inner">
            <div class="img_marquee_item">
                <?php for ($i = 0; $i < 10; $i++): ?>
                    <img src="https://pdopdev.wpenginepowered.com/wp-content/uploads/2026/04/dummy_community.png" alt="Dummy community image">
                <?php endfor; ?>
            </div>
        </div>
    </div>
    */ ?>
</section>