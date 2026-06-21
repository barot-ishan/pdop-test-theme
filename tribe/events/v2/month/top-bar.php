<?php
/**
 * Custom Month Top Bar
 *
 * Preserves sidebar filter params across month navigation.
 *
 * @package PDOP
 */

defined( 'ABSPATH' ) || exit;

// Navigation URLs from TEC.
$prev_url = $this->get('prev_url');
$next_url = $this->get('next_url');
$today_url = $this->get('today_url');

// Extract active date dynamically (works for both direct loads and TEC AJAX pushes)
$event_date = $this->get('event_date');
if (empty($event_date)) {
	$event_date = $this->get('date');
}
if (empty($event_date) && !empty($_REQUEST['eventDate'])) {
	$event_date = sanitize_text_field(wp_unslash($_REQUEST['eventDate']));
}

// ✅ FIX: parse YYYY-MM from the URL path before falling back to 'now'
// Handles /schedules/month/2026-03/ or /events/month/2026-03/ when TEC context vars are empty
if (empty($event_date)) {
	$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
	if (preg_match('#/(?:events|schedules)/(?:month/)?(\d{4}-\d{2})#', $request_uri, $matches)) {
		$event_date = $matches[1] . '-01';
	}
}

if (empty($event_date)) {
	$event_date = 'now';
}

$current_date = date_i18n('F Y', strtotime($event_date));

// Build date display string.
$navigation_btn = '/wp-content/uploads/2026/04/back.svg';

/**
 * Preserve custom filter query params across month navigation.
 * TEC's built-in URLs don't carry our custom params, so filters
 * and category card selection would otherwise be lost on nav.
 */
$preserve_keys = ['tag', 'tribe_events_cat', 'time_of_day', 'location', 'organizer', 'featured_cat'];
$carry_params = [];

foreach ($preserve_keys as $key) {
	if (!empty($_GET[$key])) {
		$carry_params[$key] = sanitize_text_field(wp_unslash($_GET[$key]));
	}
}

if (!empty($carry_params)) {
	$prev_url = add_query_arg($carry_params, $prev_url);
	$next_url = add_query_arg($carry_params, $next_url);
	$today_url = add_query_arg($carry_params, $today_url);
}
?>

<div class="pdop-events-topbar d-flex align-items-center justify-content-between w-100">

	<!-- LEFT -->
	<div class="events-topbar-left">
		<a href="<?php echo esc_url($today_url); ?>" class="btn-today">
			<?php esc_html_e('Today', 'pdop'); ?>
		</a>
	</div>

	<!-- CENTER -->
	<div class="events-topbar-center d-flex align-items-center">

		<a href="<?php echo esc_url($prev_url); ?>" class="nav-arrow prev"
			aria-label="<?php esc_attr_e('Previous month', 'pdop'); ?>">
			<img src="<?php echo esc_url($navigation_btn); ?>" alt="<?php esc_attr_e('Previous month', 'pdop'); ?>">
		</a>

		<h2 class="events-current-month" data-js="tribe-events-top-bar-datepicker-time">
			<span class="tribe-events-c-top-bar__datepicker-desktop">
				<?php echo esc_html($current_date); ?>
			</span>
		</h2>

		<a href="<?php echo esc_url($next_url); ?>" class="nav-arrow next"
			aria-label="<?php esc_attr_e('Next month', 'pdop'); ?>">
			<img src="<?php echo esc_url($navigation_btn); ?>" alt="<?php esc_attr_e('Next month', 'pdop'); ?>">
		</a>

	</div>

	<!-- RIGHT -->
	<div class="events-topbar-right"></div>

</div>