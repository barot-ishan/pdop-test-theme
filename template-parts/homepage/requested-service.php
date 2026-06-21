<?php

/**
 * Template part: Homepage – Top Requested Services
 *
 * Displays a grid of service cards that link to the most popular services.
 * Each card has an icon, title, and arrow button.
 * Fields are powered by ACF repeater "services_card".
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fallback static data when ACF fields are not yet configured
$default_services = array(
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 4C18.48 4 14 8.48 14 14C14 19.52 18.48 24 24 24C29.52 24 34 19.52 34 14C34 8.48 29.52 4 24 4ZM24 20C20.69 20 18 17.31 18 14C18 10.69 20.69 8 24 8C27.31 8 30 10.69 30 14C30 17.31 27.31 20 24 20ZM38 36V34C38 29.58 29.7 27 24 27C18.3 27 10 29.58 10 34V36H38ZM14.22 32C15.82 30.72 19.58 29 24 29C28.42 29 32.18 30.72 33.78 32H14.22Z" fill="#009AD0"/><path d="M33 15L29 19L27.59 17.59L31.17 14L27.59 10.41L29 9L33 13L33 15Z" fill="#009AD0"/></svg>',
        'title' => 'New To Oak Park?',
        'url'   => '#',
    ),
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M38 10H34V8C34 6.9 33.1 6 32 6H28C26.9 6 26 6.9 26 8V10H22V8C22 6.9 21.1 6 20 6H16C14.9 6 14 6.9 14 8V10H10C7.8 10 6 11.8 6 14V38C6 40.2 7.8 42 10 42H38C40.2 42 42 40.2 42 38V14C42 11.8 40.2 10 38 10ZM28 8H32V14H28V8ZM16 8H20V14H16V8ZM38 38H10V22H38V38ZM38 18H10V14H14V16H16V14H20V16H22V14H26V16H28V14H32V16H34V14H38V18Z" fill="#009AD0"/><circle cx="17" cy="28" r="2" fill="#009AD0"/><circle cx="24" cy="28" r="2" fill="#009AD0"/><circle cx="31" cy="28" r="2" fill="#009AD0"/><circle cx="17" cy="34" r="2" fill="#009AD0"/><circle cx="24" cy="34" r="2" fill="#009AD0"/></svg>',
        'title' => 'Fitness Class Registration',
        'url'   => '#',
    ),
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M40 8H8C5.8 8 4 9.8 4 12V36C4 38.2 5.8 40 8 40H40C42.2 40 44 38.2 44 36V12C44 9.8 42.2 8 40 8ZM40 36H8V12H40V36Z" fill="#009AD0"/><path d="M16 18H12V22H16V18Z" fill="#009AD0"/><path d="M16 26H12V30H16V26Z" fill="#009AD0"/><path d="M24 18H20V22H24V18Z" fill="#009AD0"/><path d="M24 26H20V30H24V26Z" fill="#009AD0"/><path d="M36 18H28V30H36V18Z" fill="#009AD0"/></svg>',
        'title' => 'Community Recreation Center',
        'url'   => '#',
    ),
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 6L8 18V42H18V30H30V42H40V18L24 6ZM36 38H34V26H14V38H12V20L24 10.8L36 20V38Z" fill="#009AD0"/><circle cx="30" cy="20" r="3" fill="#009AD0"/><path d="M20 16L16 22H24L20 16Z" fill="#009AD0"/></svg>',
        'title' => 'Paul Hruby Ice Arena',
        'url'   => '#',
    ),
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 40C15.18 40 8 32.82 8 24C8 15.18 15.18 8 24 8C32.82 8 40 15.18 40 24C40 32.82 32.82 40 24 40Z" fill="#009AD0"/><path d="M25 14H22V26L32.2 32.2L33.8 29.6L25 24.2V14Z" fill="#009AD0"/></svg>',
        'title' => 'Pool Schedule',
        'url'   => '#',
    ),
    array(
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 4C12.96 4 4 12.96 4 24C4 35.04 12.96 44 24 44C35.04 44 44 35.04 44 24C44 12.96 35.04 4 24 4ZM24 40C15.18 40 8 32.82 8 24C8 15.18 15.18 8 24 8C32.82 8 40 15.18 40 24C40 32.82 32.82 40 24 40Z" fill="#009AD0"/><path d="M30 16H18V20H30V16Z" fill="#009AD0"/><path d="M30 24H18V28H30V24Z" fill="#009AD0"/><path d="M26 32H18V36H26V32Z" fill="#009AD0"/></svg>',
        'title' => 'Summer Hiring',
        'url'   => '#',
    ),
);

// Use ACF repeater if available, otherwise fallback to defaults
$services = array();

if (function_exists('have_rows') && have_rows('services_card')) {
    while (have_rows('services_card')) {
        the_row();
        $icon_image = get_sub_field('service_image');
        $link       = get_sub_field('service_link');
        $title      = get_sub_field('service_title');

        $icon_url = '';
        $icon_alt = '';
        if (is_array($icon_image)) {
            $icon_url = $icon_image['url'];
            $icon_alt = $icon_image['alt'] ?: esc_attr($title);
        } elseif (is_string($icon_image) && $icon_image) {
            $icon_url = $icon_image;
            $icon_alt = esc_attr($title);
        }

        $services[] = array(
            'icon_url' => $icon_url,
            'icon_alt' => $icon_alt,
            'title'    => $title,
            'url_title' => is_array($link) ? $link['title'] : ($link ?: ''),
            'url'      => is_array($link) ? $link['url'] : ($link ?: '#'),
            'target'   => is_array($link) && !empty($link['target']) ? $link['target'] : '',
        );
    }
}

$use_defaults = empty($services);
?>

<!-- Top Requested Services -->
<section class="pdop_services pdop_container" aria-labelledby="pdop-services-heading">
    <!-- Background decorative leaf SVGs -->
    <div class="pdop_services_bg_decor" aria-hidden="true">
        <img class="pdop_services_leaf pdop_services_leaf--left" src="/wp-content/uploads/2026/03/pdop_half_leaf.svg" alt="pdop half leaf decorative element">
        <img class="pdop_services_leaf pdop_services_leaf--right" src="/wp-content/uploads/2026/03/pdop_half_leaf.svg" alt="pdop half leaf decorative element">
    </div>

    <div class="pdop_services_inner">
        <h2 class="pdop_services_heading" id="pdop-services-heading">Top Requested Services</h2>
        <p class="pdop_services_subtitle">
            Find the services you use most, right when you need them.<br>
            We've made it easier to register, reserve, and get information quickly.
        </p>

        <div class="pdop_services_grid" role="list">
            <?php if ($use_defaults) :
                foreach ($default_services as $service) : ?>
                    <div role="listitem">
                        <a href="<?php echo esc_url($service['url']); ?>"
                            class="pdop_services_card">
                            <span class="pdop_services_card_icon" aria-hidden="true">
                                <?php echo $service['icon']; ?>
                            </span>
                            <p class="pdop_services_card_title"><?php echo esc_html($service['title']); ?></p>
                            <span class="pdop_services_card_arrow">
                                <span><?php echo $service['url_title']; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="14" viewBox="0 0 9 14" fill="none" aria-hidden="true">
                                    <path d="M1 1L7.05085 7L1 13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
                <?php endforeach;
            else :
                foreach ($services as $service) : ?>
                    <div class="position-relative" role="listitem">
                        <a href="<?php echo esc_url($service['url']); ?>"
                            class="pdop_services_card"
                            <?php echo !empty($service['target']) ? 'target="' . esc_attr($service['target']) . '" rel="noopener"' : ''; ?>>
                            <span class="pdop_services_card_icon" aria-hidden="true">
                                <?php if (!empty($service['icon_url'])) : ?>
                                    <img src="<?php echo esc_url($service['icon_url']); ?>"
                                        alt="<?php echo esc_attr($service['icon_alt']); ?>"
                                        width="60" height="60"
                                        loading="lazy" />
                                <?php endif; ?>
                            </span>
                            <p class="pdop_services_card_title"><?php echo esc_html($service['title']); ?></p>
                            <span class="pdop_services_card_arrow">
                                <span><?php echo $service['url_title']; ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="14" viewBox="0 0 9 14" fill="none" aria-hidden="true">
                                    <path d="M1 1L7.05085 7L1 13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>