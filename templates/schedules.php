<?php
/**
 * Template Name: Schedules
 */

get_header();
get_template_part('template-parts/inner-header');

// Get current category from URL
$current_cat = isset($_GET['tribe_events_cat']) ? sanitize_text_field($_GET['tribe_events_cat']) : '';
?>

<section class="pdop_container sd_page">

	<!-- CATEGORY CARDS -->
	<div class="schedule_cat_tabs_wrapper d-flex gap-3">

		<?php
		$terms = get_terms([
			'taxonomy' => 'tribe_events_cat',
			'hide_empty' => false,
		]);

		if (!empty($terms) && !is_wp_error($terms)):
			foreach ($terms as $term):

				$active = ($current_cat === $term->slug) ? 'active' : '';
				?>
				<div class="category-card <?= $active; ?>" data-slug="<?= esc_attr($term->slug); ?>">

					<?php
					// Optional: ACF image
					$image = function_exists('get_field') ? get_field('category_image', $term) : '';
					if (!empty($image)): ?>
						<img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($term->name); ?>">
					<?php endif; ?>

					<div>
						<?= esc_html($term->name); ?>
					</div>
				</div>
				<?php
			endforeach;
		endif;
		?>

	</div>

	<!-- LAYOUT -->
	<div class="row mt-4">

		<!-- SIDEBAR -->
		<aside class="col-md-3">
			<div class="filters">
				<h5>Filters</h5>

				<!-- Placeholder (we’ll wire this next step) -->
				<label>
					<input type="checkbox"> Strength Training
				</label>

				<label>
					<input type="checkbox"> Cardio
				</label>
				<?php echo 'test';
				echo $_GET['tribe_events_cat']; ?>

			</div>
		</aside>

		<!-- CALENDAR -->
		<div class="col-md-9">


			<?php
			if (class_exists('Tribe__Events__Main')) {
				echo tribe_get_template_part('events/v2/default-template');
			}
			?>

		</div>

	</div>

</section>

<?php get_footer(); ?>