<?php
/**
 * Template Name: Staff Directory
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

$staff_directory_shortcode = get_field('staff_directory_shortcode');
?>

<section class="pdop_container sd_page">
	<?php
echo $staff_directory_shortcode
	? do_shortcode($staff_directory_shortcode)
	: esc_html__('Please enter shortcode', 'pdop');
?>
</section>

<?php
get_footer();