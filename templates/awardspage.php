<?php
/*
Template Name: Awardspage
*/

get_header();

get_template_part('template-parts/inner-header');

?>

<?php
if (have_rows('page_sections')) {
    while (have_rows('page_sections')) {
        the_row();
        if (get_row_layout() == 'text_image'):
            get_template_part('template-parts/components/text-image');
        elseif (get_row_layout() == 'section_title'):
            get_template_part('template-parts/awardspage/awards-recognition');
        endif;
    }
}
?>

<?php
get_footer();