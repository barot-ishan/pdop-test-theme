<?php
/*
Template Name: Mission Vision Values
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

        $layout = get_row_layout();

        // Map the layout name to the template part
        if ($layout === 'text_image') {
            get_template_part('template-parts/mission-vision-page/mission-vision');
        } elseif ($layout === 'values_scroll') {
            get_template_part('template-parts/mission-vision-page/values-scroll');
        }
    }
}
?>

<?php
get_footer();