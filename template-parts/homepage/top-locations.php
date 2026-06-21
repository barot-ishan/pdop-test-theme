<?php

/**
 * Template part: Homepage – PDOP's Top Locations
 *
 * Displays a tabbed section with search/filter controls
 * and a grid of popular park/facility cards.
 * Fields are powered by ACF; static fallback data provided.
 *
 * @package PDOP
 */

if (!defined('ABSPATH')) {
    exit;
}

// Section-level ACF fields (with defaults)
$section_title    = get_sub_field('top_location_heading') ?: "";
$section_subtitle = get_sub_field('top_location_subtitle') ?: '';
$bg_image         = get_sub_field('top_locations_bg_image');
$bg_url           = is_array($bg_image) ? $bg_image['url'] : ($bg_image ?: '/wp-content/uploads/2026/04/top_locations_bg.webp');
$parks_cta_link      = get_sub_field('top_locations_parks_cta_link');
$parks_cta_url       = is_array($parks_cta_link) ? $parks_cta_link['url'] : '#';
$parks_cta_text      = is_array($parks_cta_link) ? $parks_cta_link['title'] : 'View all Parks - Explore Park Maps';

$facilities_cta_link = get_sub_field('top_locations_facilities_cta_link');
$facilities_cta_url  = is_array($facilities_cta_link) ? $facilities_cta_link['url'] : '#';
$facilities_cta_text = is_array($facilities_cta_link) ? $facilities_cta_link['title'] : 'View all Facilities - Explore Facility Maps';

// Fallback static data for park cards
$default_parks = array(
    array(
        'name'    => 'Austin Gardens',
        'address' => '167 Forest Avenue, Oak Park, Illinois 60302',
        'image'   => '/wp-content/uploads/2026/04/park.webp',
    ),
    array(
        'name'    => 'Barrie Park',
        'address' => '1011 South Lombard Avenue, Oak Park, Il 60304',
        'image'   => '/wp-content/uploads/2026/04/park.webp',
    ),
    array(
        'name'    => 'Cheney Mansion',
        'address' => '1011 South Lombard Avenue, Oak Park, Il 60304',
        'image'   => '/wp-content/uploads/2026/04/park.webp',
    ),
    array(
        'name'    => 'Fox Park',
        'address' => '1011 South Lombard Avenue, Oak Park, Il 60304',
        'image'   => '/wp-content/uploads/2026/04/park.webp',
    ),
);

// Use ACF repeater if available, otherwise fallback
$parks = array();
if (function_exists('have_rows') && have_rows('top_locations_parks')) {
    while (have_rows('top_locations_parks')) {
        the_row();
        $card_image = get_sub_field('park_image');
        $parks[] = array(
            'name'    => get_sub_field('park_name'),
            'address' => get_sub_field('park_address'),
            'image'   => is_array($card_image) ? $card_image['url'] : ($card_image ?: ''),
        );
    }
}

$use_defaults = empty($parks);
$parks_data   = $use_defaults ? $default_parks : $parks;

// Fallback facilities data
$default_facilities = array(
    array(
        'name'    => 'Rehm Pool',
        'address' => '515 Garfield Street, Oak Park, IL 60304',
        'image'   => '/wp-content/uploads/2026/04/facility.webp',
    ),
    array(
        'name'    => 'Ridgeland Common',
        'address' => '415 Lake Street, Oak Park, IL 60302',
        'image'   => '/wp-content/uploads/2026/04/facility.webp',
    ),
    array(
        'name'    => 'Gymnastics & Recreation Center',
        'address' => '218 Madison Street, Oak Park, IL 60302',
        'image'   => '/wp-content/uploads/2026/04/facility.webp',
    ),
    array(
        'name'    => 'Conservatory',
        'address' => '615 Garfield Street, Oak Park, IL 60304',
        'image'   => '/wp-content/uploads/2026/04/facility.webp',
    ),
);

$facilities = array();
if (function_exists('have_rows') && have_rows('top_locations_facilities')) {
    while (have_rows('top_locations_facilities')) {
        the_row();
        $card_image = get_sub_field('facility_image');
        $facilities[] = array(
            'name'    => get_sub_field('facility_name'),
            'address' => get_sub_field('facility_address'),
            'image'   => is_array($card_image) ? $card_image['url'] : ($card_image ?: ''),
        );
    }
}

$facilities_data = empty($facilities) ? $default_facilities : $facilities;
?>

<!-- PDOP's Top Locations -->
<section class="pdop_top_locations" aria-labelledby="pdop-top-locations-heading" style="background-image: url('<?php echo esc_url($bg_url); ?>');">

    <!-- Banner -->
    <div class="pdop_top_locations_banner">
        <div class="pdop_top_locations_banner_content">
            <h2 class="pdop_top_locations_heading" id="pdop-top-locations-heading">
                <?php echo wp_kses_post($section_title); ?>
            </h2>
            <div class="pdop_top_locations_subtitle">
                <?php echo wp_kses_post($section_subtitle); ?>
            </div>
        </div>
    </div>

    <!-- Blue content box -->
    <div class="pdop_top_locations_content pdop_container">
        <div class="pdop_top_locations_inner">

            <!-- Tabs -->
            <ul class="nav nav-pills pdop_top_locations_tabs" id="pdop-top-locations-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link pdop_top_locations_tab active"
                        id="pdop-tab-parks"
                        data-bs-toggle="pill"
                        data-bs-target="#pdop-panel-parks"
                        type="button"
                        role="tab"
                        aria-controls="pdop-panel-parks"
                        aria-selected="true">Popular Parks</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link pdop_top_locations_tab"
                        id="pdop-tab-facilities"
                        data-bs-toggle="pill"
                        data-bs-target="#pdop-panel-facilities"
                        type="button"
                        role="tab"
                        aria-controls="pdop-panel-facilities"
                        aria-selected="false">Popular Facilities</button>
                </li>
            </ul>


            <div class="tab-content" id="pdop-top-locations-content">

                <!-- Parks Panel -->
                <div class="tab-pane fade show active pdop_top_locations_panel"
                    id="pdop-panel-parks"
                    role="tabpanel"
                    aria-labelledby="pdop-tab-parks">

                    <!-- Parks Search & Filters -->
                    <div class="pdop_top_locations_filters">
                        <div class="pdop_top_locations_search">
                            <input type="text"
                                class="pdop_top_locations_search_input"
                                placeholder="Search by park name or keyword"
                                aria-label="Search parks" />
                            <button class="pdop_top_locations_search_btn" aria-label="Search parks">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                            </button>
                        </div>
                        <div class="pdop_top_locations_select_wrap">
                            <select class="pdop_top_locations_select" aria-label="Choose amenities">
                                <option value="">Choose Amenities</option>
                                <option value="playground">Playground</option>
                                <option value="pool">Pool</option>
                                <option value="tennis">Tennis Courts</option>
                                <option value="basketball">Basketball Courts</option>
                                <option value="picnic">Picnic Areas</option>
                            </select>
                        </div>
                        <div class="pdop_top_locations_select_wrap">
                            <select class="pdop_top_locations_select" aria-label="Choose programs">
                                <option value="">Choose Programs</option>
                                <option value="fitness">Fitness</option>
                                <option value="youth">Youth Programs</option>
                                <option value="camps">Camps</option>
                                <option value="arts">Arts &amp; Culture</option>
                                <option value="seniors">Senior Programs</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="pdop_top_locations_section_title">Popular Parks</h3>
                    <div class="pdop_top_locations_grid">
                        <?php foreach ($parks_data as $park) : ?>
                            <a href="#" class="pdop_top_locations_card">
                                <div class="pdop_top_locations_card_image">
                                    <img src="<?php echo esc_url($park['image']); ?>"
                                        alt="<?php echo esc_attr($park['name']); ?>"
                                        loading="lazy" />
                                </div>
                                <div class="pdop_top_locations_card_info">
                                    <h4 class="pdop_top_locations_card_name"><?php echo esc_html($park['name']); ?></h4>
                                    <p class="pdop_top_locations_card_address">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                            <path d="M9.88325 1.42612C9.27016 0.905605 8.55868 0.513658 7.79111 0.273576C7.02353 0.0334934 6.21552 -0.0498233 5.4151 0.0285775C4.61468 0.106978 3.8382 0.345497 3.13179 0.729955C2.42539 1.11441 1.80349 1.63697 1.30305 2.26655C0.802612 2.89614 0.433856 3.61991 0.218698 4.39484C0.00353977 5.16977 -0.0536281 5.98005 0.0505918 6.77752C0.154812 7.57499 0.418292 8.34336 0.825373 9.03698C1.23245 9.73059 1.77482 10.3353 2.42025 10.8151C3.46217 11.5776 4.34931 12.5316 5.03425 13.6261L5.50125 14.4021C5.56056 14.5007 5.64436 14.5822 5.7445 14.6388C5.84464 14.6955 5.95772 14.7252 6.07275 14.7252C6.18778 14.7252 6.30086 14.6955 6.401 14.6388C6.50114 14.5822 6.58494 14.5007 6.64425 14.4021L7.09125 13.6571C7.68753 12.6086 8.50062 11.6994 9.47625 10.9901C10.2414 10.4638 10.8737 9.76683 11.3234 8.95426C11.773 8.14169 12.0277 7.23575 12.0672 6.30791C12.1068 5.38007 11.9302 4.45573 11.5513 3.60783C11.1725 2.75994 10.6018 2.01168 9.88425 1.42212L9.88325 1.42612ZM6.07125 8.72612C5.54373 8.72612 5.02805 8.56968 4.58944 8.27658C4.15083 7.98348 3.809 7.5669 3.60717 7.07951C3.40534 6.59212 3.35258 6.05582 3.45557 5.53845C3.55856 5.02107 3.81266 4.54586 4.18575 4.17291C4.55884 3.79997 5.03414 3.54604 5.55156 3.44325C6.06897 3.34045 6.60525 3.39341 7.09256 3.59542C7.57987 3.79743 7.99633 4.13943 8.28927 4.57814C8.5822 5.01686 8.73845 5.5326 8.73825 6.06012C8.73798 6.76728 8.45688 7.44539 7.95675 7.94533C7.45662 8.44527 6.77841 8.72612 6.07125 8.72612Z" fill="#1EC94E" />
                                        </svg>
                                        <span>
                                            <?php echo esc_html($park['address']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_40002879_12841)">
                                                    <path d="M15.76 7.44L8.56 0.24C8.24003 -0.08 7.76 -0.08 7.44 0.24L0.24 7.44C-0.08 7.76 -0.08 8.24003 0.24 8.56L7.44 15.76C7.76 16.08 8.24003 16.08 8.56 15.76L15.76 8.56C16.08 8.24003 16.08 7.76003 15.76 7.44ZM9.6 10V8.00003H6.4V10.4H4.8V7.20003C4.8 6.72003 5.12 6.40003 5.6 6.40003H9.6V4.40003L12.4 7.20003L9.6 10Z" fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_40002879_12841">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Parks CTA -->
                    <div class="pdop_top_locations_cta">
                        <a href="<?php echo esc_url($parks_cta_url); ?>" class="pdop_top_locations_cta_btn pdop_btn">
                            <?php echo esc_html($parks_cta_text); ?>
                        </a>
                    </div>
                </div>

                <!-- Facilities Panel -->
                <div class="tab-pane fade pdop_top_locations_panel"
                    id="pdop-panel-facilities"
                    role="tabpanel"
                    aria-labelledby="pdop-tab-facilities">

                    <!-- Facilities Search & Filters -->
                    <div class="pdop_top_locations_filters">
                        <div class="pdop_top_locations_search">
                            <input type="text"
                                class="pdop_top_locations_search_input"
                                placeholder="Search by facility name or keyword"
                                aria-label="Search facilities" />
                            <button class="pdop_top_locations_search_btn" aria-label="Search facilities">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                            </button>
                        </div>
                        <div class="pdop_top_locations_select_wrap">
                            <select class="pdop_top_locations_select" aria-label="Choose facility type">
                                <option value="">Choose Facility Type</option>
                                <option value="recreation">Recreation Center</option>
                                <option value="pool">Pool</option>
                                <option value="gym">Gymnasium</option>
                                <option value="arena">Ice Arena</option>
                                <option value="conservatory">Conservatory</option>
                            </select>
                        </div>
                        <div class="pdop_top_locations_select_wrap">
                            <select class="pdop_top_locations_select" aria-label="Choose activities">
                                <option value="">Choose Activities</option>
                                <option value="swimming">Swimming</option>
                                <option value="skating">Ice Skating</option>
                                <option value="gymnastics">Gymnastics</option>
                                <option value="fitness">Fitness</option>
                                <option value="classes">Classes</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="pdop_top_locations_section_title">Popular Facilities</h3>
                    <div class="pdop_top_locations_grid">
                        <?php foreach ($facilities_data as $facility) : ?>
                            <a href="#" class="pdop_top_locations_card">
                                <div class="pdop_top_locations_card_image">
                                    <img src="<?php echo esc_url($facility['image']); ?>"
                                        alt="<?php echo esc_attr($facility['name']); ?>"
                                        loading="lazy" />
                                </div>
                                <div class="pdop_top_locations_card_info">
                                    <h4 class="pdop_top_locations_card_name"><?php echo esc_html($facility['name']); ?></h4>
                                    <p class="pdop_top_locations_card_address">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="15" viewBox="0 0 13 15" fill="none">
                                            <path d="M9.88325 1.42612C9.27016 0.905605 8.55868 0.513658 7.79111 0.273576C7.02353 0.0334934 6.21552 -0.0498233 5.4151 0.0285775C4.61468 0.106978 3.8382 0.345497 3.13179 0.729955C2.42539 1.11441 1.80349 1.63697 1.30305 2.26655C0.802612 2.89614 0.433856 3.61991 0.218698 4.39484C0.00353977 5.16977 -0.0536281 5.98005 0.0505918 6.77752C0.154812 7.57499 0.418292 8.34336 0.825373 9.03698C1.23245 9.73059 1.77482 10.3353 2.42025 10.8151C3.46217 11.5776 4.34931 12.5316 5.03425 13.6261L5.50125 14.4021C5.56056 14.5007 5.64436 14.5822 5.7445 14.6388C5.84464 14.6955 5.95772 14.7252 6.07275 14.7252C6.18778 14.7252 6.30086 14.6955 6.401 14.6388C6.50114 14.5822 6.58494 14.5007 6.64425 14.4021L7.09125 13.6571C7.68753 12.6086 8.50062 11.6994 9.47625 10.9901C10.2414 10.4638 10.8737 9.76683 11.3234 8.95426C11.773 8.14169 12.0277 7.23575 12.0672 6.30791C12.1068 5.38007 11.9302 4.45573 11.5513 3.60783C11.1725 2.75994 10.6018 2.01168 9.88425 1.42212L9.88325 1.42612ZM6.07125 8.72612C5.54373 8.72612 5.02805 8.56968 4.58944 8.27658C4.15083 7.98348 3.809 7.5669 3.60717 7.07951C3.40534 6.59212 3.35258 6.05582 3.45557 5.53845C3.55856 5.02107 3.81266 4.54586 4.18575 4.17291C4.55884 3.79997 5.03414 3.54604 5.55156 3.44325C6.06897 3.34045 6.60525 3.39341 7.09256 3.59542C7.57987 3.79743 7.99633 4.13943 8.28927 4.57814C8.5822 5.01686 8.73845 5.5326 8.73825 6.06012C8.73798 6.76728 8.45688 7.44539 7.95675 7.94533C7.45662 8.44527 6.77841 8.72612 6.07125 8.72612Z" fill="#1EC94E" />
                                        </svg>
                                        <span>
                                            <?php echo esc_html($facility['address']); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                                <g clip-path="url(#clip0_40002879_12841)">
                                                    <path d="M15.76 7.44L8.56 0.24C8.24003 -0.08 7.76 -0.08 7.44 0.24L0.24 7.44C-0.08 7.76 -0.08 8.24003 0.24 8.56L7.44 15.76C7.76 16.08 8.24003 16.08 8.56 15.76L15.76 8.56C16.08 8.24003 16.08 7.76003 15.76 7.44ZM9.6 10V8.00003H6.4V10.4H4.8V7.20003C4.8 6.72003 5.12 6.40003 5.6 6.40003H9.6V4.40003L12.4 7.20003L9.6 10Z" fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_40002879_12841">
                                                        <rect width="16" height="16" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <!-- Facilities CTA -->
                    <div class="pdop_top_locations_cta">
                        <a href="<?php echo esc_url($facilities_cta_url); ?>" class="pdop_top_locations_cta_btn pdop_btn">
                            <?php echo esc_html($facilities_cta_text); ?>
                        </a>
                    </div>
                </div>

            </div><!-- .tab-content -->

        </div>
    </div>
</section>