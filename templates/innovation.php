<?php
/*
Template Name: Innovation Page
*/
if (!defined('ABSPATH')) {
    exit;
}

get_header();

get_template_part('template-parts/inner-header');
?>


<?php
if (have_rows('page_sections')) {
    while (have_rows('page_sections')) {
        the_row();
        if (get_row_layout() == 'text_image'):
            get_template_part('template-parts/components/text-image');
        elseif(get_row_layout() == 'innovation_statistic'):
            get_template_part('template-parts/innovation/innovation-promoted');
            get_template_part('template-parts/components/box-accordion');
        endif;
    }
}
?>


<?php get_footer(); ?>