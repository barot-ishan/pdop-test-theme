<?php
/**
 * FIXED Tooltip (TEC compatible)
 */

defined('ABSPATH') || exit;

$event_id = $event->ID;

$location_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
  <mask id="mask0_4516_70185" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
    <rect width="18" height="18" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_4516_70185)">
    <path d="M9 8.99609C9.4125 8.99609 9.76563 8.84922 10.0594 8.55547C10.3531 8.26172 10.5 7.90859 10.5 7.49609C10.5 7.08359 10.3531 6.73047 10.0594 6.43672C9.76563 6.14297 9.4125 5.99609 9 5.99609C8.5875 5.99609 8.23438 6.14297 7.94063 6.43672C7.64688 6.73047 7.5 7.08359 7.5 7.49609C7.5 7.90859 7.64688 8.26172 7.94063 8.55547C8.23438 8.84922 8.5875 8.99609 9 8.99609ZM9 16.4961C6.9875 14.7836 5.48438 13.193 4.49063 11.7242C3.49688 10.2555 3 8.89609 3 7.64609C3 5.77109 3.60313 4.27734 4.80938 3.16484C6.01563 2.05234 7.4125 1.49609 9 1.49609C10.5875 1.49609 11.9844 2.05234 13.1906 3.16484C14.3969 4.27734 15 5.77109 15 7.64609C15 8.89609 14.5031 10.2555 13.5094 11.7242C12.5156 13.193 11.0125 14.7836 9 16.4961Z" fill="#009AD0"/>
  </g>
</svg>';

$calendar_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
  <mask id="mask0_4516_70190" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
    <rect width="18" height="18" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_4516_70190)">
    <path d="M9 10.5C8.7875 10.5 8.60938 10.4281 8.46563 10.2844C8.32188 10.1406 8.25 9.9625 8.25 9.75C8.25 9.5375 8.32188 9.35938 8.46563 9.21563C8.60938 9.07188 8.7875 9 9 9C9.2125 9 9.39063 9.07188 9.53438 9.21563C9.67813 9.35938 9.75 9.5375 9.75 9.75C9.75 9.9625 9.67813 10.1406 9.53438 10.2844C9.39063 10.4281 9.2125 10.5 9 10.5ZM6 10.5C5.7875 10.5 5.60938 10.4281 5.46562 10.2844C5.32187 10.1406 5.25 9.9625 5.25 9.75C5.25 9.5375 5.32187 9.35938 5.46562 9.21563C5.60938 9.07188 5.7875 9 6 9C6.2125 9 6.39062 9.07188 6.53438 9.21563C6.67812 9.35938 6.75 9.5375 6.75 9.75C6.75 9.9625 6.67812 10.1406 6.53438 10.2844C6.39062 10.4281 6.2125 10.5 6 10.5ZM12 10.5C11.7875 10.5 11.6094 10.4281 11.4656 10.2844C11.3219 10.1406 11.25 9.9625 11.25 9.75C11.25 9.5375 11.3219 9.35938 11.4656 9.21563C11.6094 9.07188 11.7875 9 12 9C12.2125 9 12.3906 9.07188 12.5344 9.21563C12.6781 9.35938 12.75 9.5375 12.75 9.75C12.75 9.9625 12.6781 10.1406 12.5344 10.2844C12.3906 10.4281 12.2125 10.5 12 10.5ZM9 13.5C8.7875 13.5 8.60938 13.4281 8.46563 13.2844C8.32188 13.1406 8.25 12.9625 8.25 12.75C8.25 12.5375 8.32188 12.3594 8.46563 12.2156C8.60938 12.0719 8.7875 12 9 12C9.2125 12 9.39063 12.0719 9.53438 12.2156C9.67813 12.3594 9.75 12.5375 9.75 12.75C9.75 12.9625 9.67813 13.1406 9.53438 13.2844C9.39063 13.4281 9.2125 13.5 9 13.5ZM6 13.5C5.7875 13.5 5.60938 13.4281 5.46562 13.2844C5.32187 13.1406 5.25 12.9625 5.25 12.75C5.25 12.5375 5.32187 12.3594 5.46562 12.2156C5.60938 12.0719 5.7875 12 6 12C6.2125 12 6.39062 12.0719 6.53438 12.2156C6.67812 12.3594 6.75 12.5375 6.75 12.75C6.75 12.9625 6.67812 13.1406 6.53438 13.2844C6.39062 13.4281 6.2125 13.5 6 13.5ZM12 13.5C11.7875 13.5 11.6094 13.4281 11.4656 13.2844C11.3219 13.1406 11.25 12.9625 11.25 12.75C11.25 12.5375 11.3219 12.3594 11.4656 12.2156C11.6094 12.0719 11.7875 12 12 12C12.2125 12 12.3906 12.0719 12.5344 12.2156C12.6781 12.3594 12.75 12.5375 12.75 12.75C12.75 12.9625 12.6781 13.1406 12.5344 13.2844C12.3906 13.4281 12.2125 13.5 12 13.5ZM3.75 16.5C3.3375 16.5 2.98438 16.3531 2.69063 16.0594C2.39688 15.7656 2.25 15.4125 2.25 15V4.5C2.25 4.0875 2.39688 3.73438 2.69063 3.44063C2.98438 3.14688 3.3375 3 3.75 3H4.5V1.5H6V3H12V1.5H13.5V3H14.25C14.6625 3 15.0156 3.14688 15.3094 3.44063C15.6031 3.73438 15.75 4.0875 15.75 4.5V15C15.75 15.4125 15.6031 15.7656 15.3094 16.0594C15.0156 16.3531 14.6625 16.5 14.25 16.5H3.75ZM3.75 15H14.25V7.5H3.75V15Z" fill="#009AD0"/>
  </g>
</svg>';

$clock_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
  <mask id="mask0_4516_70195" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
    <rect width="18" height="18" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_4516_70195)">
    <path d="M11.475 12.525L12.525 11.475L9.75 8.7V5.25H8.25V9.3L11.475 12.525ZM9 16.5C7.9625 16.5 6.9875 16.3031 6.075 15.9094C5.1625 15.5156 4.36875 14.9813 3.69375 14.3063C3.01875 13.6313 2.48438 12.8375 2.09063 11.925C1.69687 11.0125 1.5 10.0375 1.5 9C1.5 7.9625 1.69687 6.9875 2.09063 6.075C2.48438 5.1625 3.01875 4.36875 3.69375 3.69375C4.36875 3.01875 5.1625 2.48438 6.075 2.09063C6.9875 1.69687 7.9625 1.5 9 1.5C10.0375 1.5 11.0125 1.69687 11.925 2.09063C12.8375 2.48438 13.6313 3.01875 14.3063 3.69375C14.9813 4.36875 15.5156 5.1625 15.9094 6.075C16.3031 6.9875 16.5 7.9625 16.5 9C16.5 10.0375 16.3031 11.0125 15.9094 11.925C15.5156 12.8375 14.9813 13.6313 14.3063 14.3063C13.6313 14.9813 12.8375 15.5156 11.925 15.9094C11.0125 16.3031 10.0375 16.5 9 16.5Z" fill="#009AD0"/>
  </g>
</svg>';

// Data
$title = get_the_title($event_id);
$start_date = tribe_get_start_date($event_id, false, 'l, F j Y');
$start_time = tribe_get_start_time($event_id, 'g:i a');
$end_time = tribe_get_end_time($event_id, 'g:i a');
$venue = tribe_get_venue($event_id);
$organizer = tribe_get_organizer($event_id);
$excerpt = get_the_excerpt($event_id);
$permalink = get_permalink($event_id);
$event_url = get_post_meta($event_id, '_EventURL', true);
if (empty($event_url)) {
    $event_url = $permalink;
}
$price = get_post_meta($event_id, '_EventCost', true);
?>

<div class="tribe-events-calendar-month__calendar-event-tooltip-template tribe-common-a11y-hidden">
	<div class="tribe-events-calendar-month__calendar-event-tooltip pdop-custom-tooltip"
		id="tribe-events-tooltip-content-<?php echo esc_attr($event_id); ?>" role="tooltip">
		<div class="pdop-tooltip-inner">

			<button class="tooltip-close" aria-label="Close">×</button>

			<h3 class="tooltip-title">
				<?= esc_html($title); ?>
			</h3>

			<div class="tooltip-meta">

				<?php if ($venue): ?>
					<div><?= $location_icon ?>
						<?= esc_html($venue); ?>
					</div>
				<?php endif; ?>

				<div><?= $calendar_icon ?>
					<?= esc_html($start_date); ?>
				</div>

				<div>
					<?= $clock_icon ?>
					<?= esc_html($start_time . ' - ' . $end_time); ?>
				</div>

				<?php if ($price): ?>
					<div class="price">Price:
						$<?= esc_html($price); ?>
					</div>
				<?php endif; ?>

			</div>

			<?php if ($excerpt): ?>
				<div class="tooltip-desc">
					<?= wp_trim_words($excerpt, 25, '... <a href="' . esc_url($event_url) . '" class="tooltip-read-more" target="_blank">Read more</a>'); ?>
				</div>
			<?php endif; ?>

			<div class="tooltip-actions">
				<a href="<?= esc_url($event_url); ?>" class="btn-primary pdop_btn" target="_blank">
					Book Now
				</a>
				<a href="<?= esc_url($event_url); ?>" class="btn-secondary" target="_blank">
					View Details
				</a>
			</div>

		</div>

	</div>
</div>