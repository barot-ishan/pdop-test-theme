<?php

/**
 * The template for displaying the footer
 *
 * @package PDOP
 */
?>


<?php

echo '</main>';

$footer_fields = get_fields('option') ?: [];

// Extract fields safely
$footer_logo = $footer_fields['footer_logo'] ?? null;
$newsletter = $footer_fields['newsletter'] ?? null;
$address_group = $footer_fields['address'] ?? null;
$email_group = $footer_fields['email'] ?? null;
$phone_group = $footer_fields['phone'] ?? null;
$hours_group = $footer_fields['hours'] ?? null;
$copyright_text = $footer_fields['copyright_text'] ?? '';
?>


<footer id="colophon" class="site-footer pdop_container" role="contentinfo" aria-label="Site Footer">

	<!-- ================= Newsletter ================= -->
	<?php if (!empty($newsletter)): ?>
		<?php
		$heading = $newsletter['heading'] ?? '';
		$description = $newsletter['description'] ?? '';
		$form_shortcode = $newsletter['form_shortcode'] ?? '';
		?>
		<section class="footer_top" aria-labelledby="footer-newsletter-heading">
			<div class="newsletter_container">

				<?php if (!empty($heading)): ?>
					<h2 id="footer-newsletter-heading" class="newsltr_title text-center">
						<?= esc_html($heading); ?>
					</h2>
					<?php
				endif; ?>

				<?php if (!empty($description)): ?>
					<p class="newsltr_desc text-center">
						<?= wp_kses_post($description); ?>
					</p>
					<?php
				endif; ?>

				<?php if (!empty($form_shortcode)): ?>
					<?= do_shortcode(wp_kses_post($form_shortcode)); ?>
					<?php
				endif; ?>

			</div>
		</section>
		<?php
	endif; ?>

	<!-- ================= Main Footer ================= -->
	<div class="footer_main">

		<!-- ===== Logo ===== -->
		<?php if (!empty($footer_logo['url'])): ?>
			<div class="ftr_logo align-content-center">
				<a href="<?= esc_url(home_url('/')); ?>" aria-label="Go to homepage">
					<img src="<?= esc_url($footer_logo['url']); ?>"
						alt="<?= esc_attr($footer_logo['alt'] ?? get_bloginfo('name')); ?>" width="229" height="300"
						title="Home - Park District of Oak Park">
				</a>
			</div>
			<?php
		endif; ?>

		<!-- ===== Navigation Columns ===== -->
		<div class="ftr_nav_wrapper">

			<!-- Quick Links -->
			<?php if (has_nav_menu('quick-links')): ?>
				<nav class="ftr_nav" aria-label="<?= esc_attr($footer_fields['footer_menu_title_1'] ?? 'Quick Links'); ?>">
					<h3 class="ftr_col_head">
						<?= esc_html($footer_fields['footer_menu_title_1'] ?? ''); ?>
					</h3>
					<?php
					wp_nav_menu([
						'theme_location' => 'quick-links',
						'container' => false,
						'menu_class' => 'ftr_list list-unstyled ms-0 mb-0 gap-2',
						'depth' => 1,
						'fallback_cb' => false,
					]);
					?>
				</nav>
				<?php
			endif; ?>

			<!-- Support -->
			<?php if (has_nav_menu('support')): ?>
				<nav class="ftr_nav nav_support"
					aria-label="<?= esc_attr($footer_fields['footer_menu_title_2'] ?? 'Support Links'); ?>">
					<h3 class="ftr_col_head">
						<?= esc_html($footer_fields['footer_menu_title_2'] ?? ''); ?>
					</h3>
					<?php
					wp_nav_menu([
						'theme_location' => 'support',
						'container' => false,
						'menu_class' => 'ftr_list list-unstyled ms-0 mb-0 gap-2',
						'depth' => 1,
						'fallback_cb' => false,
					]);
					?>
				</nav>
				<?php
			endif; ?>

		</div>

		<!-- ===== Contact & Social ===== -->
		<section class="ftr_connect_wrapper" aria-labelledby="footer-contact-heading">

			<div class="ftr_connect">
				<h3 id="footer-contact-heading" class="ftr_col_head">
					<?= esc_html($footer_fields['footer_menu_title_3'] ?? 'Reach Us'); ?>
				</h3>
				<address>
					<ul class="ftr_list list-group list-unstyled ms-0 mb-0 gap-2 d-flex">

						<?php
						$contact_groups = [
							$address_group,
							$email_group,
							$phone_group,
						];

						foreach ($contact_groups as $group):
							if (empty($group))
								continue;

							$icon = $group[array_key_first($group)] ?? null;
							$link = array_values($group)[1] ?? null;

							if (empty($link))
								continue;
							?>
							<li class="d-flex align-items-start gap-3">

								<?php if (!empty($icon['url'])): ?>
									<img src="<?= esc_url($icon['url']); ?>" alt="<?= esc_attr($icon['alt'] ?? ''); ?>" aria-hidden="true"
										class="<?= esc_attr($icon['alt']); ?>">
									<?php
								endif; ?>

								<a href="<?= esc_url($link['url'] ?? '#'); ?>"
									target="<?= esc_attr($link['target'] ?? '_self'); ?>">
									<?= esc_html($link['title'] ?? ''); ?>
								</a>

							</li>
							<?php
						endforeach; ?>

						<?php if (!empty($hours_group)): ?>
							<li class="d-flex align-items-start gap-3">

								<?php if (!empty($hours_group['hours_icon']['url'])): ?>
									<img src="<?= esc_url($hours_group['hours_icon']['url']); ?>" class="mt-1"
										alt="<?= esc_attr($hours_group['hours_icon']['alt'] ?? ''); ?>">
									<?php
								endif; ?>

								<div class="ofc_hours d-flex flex-column">
									<?php if (!empty($hours_group['hours'])): ?>
										<span>
											<?= esc_html($hours_group['hours']); ?>
										</span>
										<?php
									endif; ?>
									<?php if (!empty($hours_group['hours_2'])): ?>
										<span>
											<?= esc_html($hours_group['hours_2']); ?>
										</span>
										<?php
									endif; ?>
								</div>

							</li>
							<?php
						endif; ?>

					</ul>
				</address>
			</div>

			<!-- ===== Social Media ===== -->
			<?php if (have_rows('social_media_data', 'option')): ?>
				<nav class="socials" aria-label="<?= esc_attr($footer_fields['footer_menu_title_4'] ?? 'Social Media'); ?>">
					<h3 class="ftr_col_head">
						<?= esc_html($footer_fields['footer_menu_title_4'] ?? ''); ?>
					</h3>

					<ul class="social_handles list-unstyled d-flex ms-0 mb-0">
						<?php while (have_rows('social_media_data', 'option')):
							the_row();
							$social_link = get_sub_field('url');
							$social_icon = get_sub_field('icon');

							if (empty($social_link) || empty($social_icon['url']))
								continue;
							?>
							<li>
								<a href="<?= esc_url($social_link); ?>" target="_blank" rel="noopener noreferrer"
									aria-label="<?= esc_attr($social_icon['alt'] ?? 'Social Media Link'); ?>">
									<img src="<?= esc_url($social_icon['url']); ?>" alt="<?= esc_attr($social_icon['alt'] ?? 'Social Media Icon'); ?>" aria-hidden="true">
								</a>
							</li>
							<?php
						endwhile; ?>
					</ul>
				</nav>
				<?php
			endif; ?>

		</section>

	</div>

	<!-- ================= Bottom Footer ================= -->
	<div class="row footer_bottom gap-3 gap-xl-0">

		<div class="col-xl-6">
			<?php if (!empty($copyright_text)): ?>
				<p class="m-0 text-center text-xl-end copyright">
					<?= wp_kses_post($copyright_text); ?>
				</p>
				<?php
			endif; ?>
		</div>

		<div class="col-xl-6 legal_col">
			<?php if (has_nav_menu('legal-menu')): ?>
				<nav class="legal_menu" aria-label="Legal Links">
					<?php
					wp_nav_menu([
						'theme_location' => 'legal-menu',
						'container' => false,
						'menu_class' => 'list-unstyled d-flex justify-content-center justify-content-xl-start gap-1 mb-0 ms-0',
						'fallback_cb' => false,
						'depth' => 1,
					]);
					?>
				</nav>
				<?php
			endif; ?>
		</div>

	</div>

</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>