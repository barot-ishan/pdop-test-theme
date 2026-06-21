<?php
/**
 * Template Name: Agenda & Minutes
 *
 * 
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();

get_template_part('template-parts/inner-header');

while (have_posts()):
	the_post();
endwhile;

$agenda_minutes_shortcode = get_field('agenda_minutes_shortcode');
?>

<section class="pdop_container sd_page">
	<?php
echo $agenda_minutes_shortcode
	? do_shortcode($agenda_minutes_shortcode)
	: esc_html__('Please enter shortcode', 'pdop');
?>
</section>

<?php
get_footer();