<?php

/**
 * Template Name: Homepage
 * 
 * @package PDOP
 */

get_header(); ?>

<?php

if (have_rows('homepage_content')) {
    while (have_rows('homepage_content')) {
        the_row();
        if (get_row_layout() == 'banner_layout'):
            get_template_part('template-parts/homepage/hero-banner');
        elseif (get_row_layout() == 'services_layout'):
            get_template_part('template-parts/homepage/requested-service');
        elseif (get_row_layout() == 'about_community_layout'):
            get_template_part('template-parts/homepage/about-community');
        elseif (get_row_layout() == 'current_project_layout'):
            get_template_part('template-parts/homepage/current-project');
        elseif (get_row_layout() == 'newsroom_layout'):
            get_template_part('template-parts/homepage/newsroom');
        elseif (get_row_layout() == 'get_in_touch_layout'):
            get_template_part('template-parts/homepage/get-in-touch');
        elseif (get_row_layout() == 'about_community_layout'):
            get_template_part('template-parts/homepage/about-community');
        elseif (get_row_layout() == 'upcoming_events_layout'):
            get_template_part('template-parts/homepage/upcoming-events');
        elseif (get_row_layout() == 'top_locations_layout'):
            get_template_part('template-parts/homepage/top-locations');
        elseif (get_row_layout() == 'join_community_layout'):
            get_template_part('template-parts/homepage/join-community');
        elseif (get_row_layout() == 'top_location_layout'):
            get_template_part('template-parts/homepage/top-locations');
        endif;
    }
}


?>

<?php get_footer(); ?>