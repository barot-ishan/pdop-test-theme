<?php

if (!defined('ABSPATH')) {
    exit;
}

$title = get_sub_field('title');
$title_id = strtolower(str_replace(' ', '_', $title));

?>

<div class="pdop_program_content_main pdop_program_content_card" <?php echo !empty($title) ? 'id="' . $title_id . '"' : ''; ?>>
    <?php

    if (have_rows('program_page_card_content')) {
        while (have_rows('program_page_card_content')) {
            the_row();
            if (get_row_layout() == 'program_heading_section') {
                get_template_part('template-parts/program/heading');
            } else if (get_row_layout() == 'program_highlight_section') {
                get_template_part('template-parts/program/highlight');
            } else if (get_row_layout() == 'program_note_section') {
                get_template_part('template-parts/program/note');
            } else if (get_row_layout() == 'program_faqs_section') {
                get_template_part('template-parts/program/faqs');
            } else if (get_row_layout() == 'program_single_button_section') {
                get_template_part('template-parts/program/button');
            } else if (get_row_layout() == 'program_single_description_section') {
                get_template_part('template-parts/program/description');
            } else if (get_row_layout() == 'program_category_shortcode') {
                get_template_part('template-parts/program/category-shortcode');
            } else if (get_row_layout() == 'program_cta_section') {
                get_template_part('template-parts/program/cta');
            } else if (get_row_layout() == 'program_this_week_shortcode') {
                get_template_part('template-parts/program/this-week-shortcode');
            } else if (get_row_layout() == 'program_location_section') {
                get_template_part('template-parts/program/location');
            } else if (get_row_layout() == 'program_instructors_section') {
                get_template_part('template-parts/program/instructor');
            }
        }
    }

    ?>
</div>