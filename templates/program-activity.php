<?php
/*
Template Name: Program Activity Template
*/

get_header();

get_template_part('template-parts/inner-header');

?>

<section class="pdop_container pdop_program_container_top">
    <?php get_template_part('template-parts/program/announcement'); ?>
    <?php //get_template_part('template-parts/program/not-sure'); ?>
</section>

<section class="pdop_container pdop_program_container_main program-activity">
    <div class="pdop_program_container_grid">
        <?php get_template_part('template-parts/program/sidebar'); ?>
        <div class="pdop_program_content">
            <?php echo do_shortcode("[smartrec_activities_by_category program_id='119997']"); ?>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/program/program-detail-modal'); ?>

<?php
get_footer();
