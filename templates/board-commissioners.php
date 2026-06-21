<?php
/*
Template Name: Board of commissioners
*/

get_header();

get_template_part('template-parts/inner-header');
?>

<?php
if (have_rows('boards_details')) {
    while (have_rows('boards_details')) {
        the_row();
        if (get_row_layout() == 'announcement'): ?>
            <section class="pad-bt">
                <div class="pdop_container">
                    <?php
                    get_template_part('template-parts/program/announcement');
                    ?>
                </div>
            </section>
        <?php
        elseif (get_row_layout() == 'service_layout'):
            get_template_part('template-parts/components/icon-box-card');
        elseif (get_row_layout() == 'meet_the_board'):
            get_template_part('template-parts/components/meet-the-board');
        endif;
    }
}
?>

<?php get_footer(); ?>