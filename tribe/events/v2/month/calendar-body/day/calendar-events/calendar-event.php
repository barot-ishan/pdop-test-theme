<?php
/**
 * Custom Month Calendar Event Card (BEST PRACTICE)
 */

defined('ABSPATH') || exit;
$event_id = $event->ID;

// Category class
$categories = wp_get_post_terms($event_id, 'tribe_events_cat');
$card_class = !empty($categories) ? 'event-' . $categories[0]->slug : '';

// TEC default classes (KEEP THIS)
$class_list = ['tribe-events-calendar-month__calendar-event', 'pdop-event-card'];
if (!empty($card_class)) {
  $class_list[] = $card_class;
}
$classes = tribe_get_post_class(
  $class_list,
  $event_id
);

// Time
$start_time = tribe_get_start_time($event_id, 'g:i a');
$end_time = tribe_get_end_time($event_id, 'g:i a');

// Title
$title = get_the_title($event_id);

// Day
$day = tribe_get_start_date($event_id, false, 'l');

// Location
$venue = tribe_get_venue($event_id);

// Organizer
$organizer = tribe_get_organizer($event_id);

// Amilia specific meta
$is_waitlist = get_post_meta($event_id, '_waitlist', true);
$event_url = get_post_meta($event_id, '_EventURL', true);
if (empty($event_url)) {
    $event_url = get_permalink($event_id);
}

$location_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
  <mask id="mask0_40002800_8817" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
    <rect width="14" height="14" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_40002800_8817)">
    <path d="M6.99967 7.0013C7.32051 7.0013 7.59516 6.88707 7.82363 6.65859C8.0521 6.43012 8.16634 6.15547 8.16634 5.83464C8.16634 5.5138 8.0521 5.23915 7.82363 5.01068C7.59516 4.78221 7.32051 4.66797 6.99967 4.66797C6.67884 4.66797 6.40419 4.78221 6.17572 5.01068C5.94724 5.23915 5.83301 5.5138 5.83301 5.83464C5.83301 6.15547 5.94724 6.43012 6.17572 6.65859C6.40419 6.88707 6.67884 7.0013 6.99967 7.0013ZM6.99967 12.8346C5.4344 11.5027 4.2653 10.2655 3.49238 9.12318C2.71947 7.98082 2.33301 6.92352 2.33301 5.9513C2.33301 4.49297 2.80211 3.33116 3.7403 2.46589C4.67849 1.60061 5.76495 1.16797 6.99967 1.16797C8.2344 1.16797 9.32086 1.60061 10.259 2.46589C11.1972 3.33116 11.6663 4.49297 11.6663 5.9513C11.6663 6.92352 11.2799 7.98082 10.507 9.12318C9.73405 10.2655 8.56495 11.5027 6.99967 12.8346Z" fill="#009AD0"/>
  </g>
</svg>';

$user_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
  <mask id="mask0_40002800_8822" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
    <rect width="14" height="14" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_40002800_8822)">
    <path d="M7.4347 6.63685C6.79069 6.63685 6.23938 6.40754 5.78076 5.94893C5.32215 5.49031 5.09284 4.939 5.09284 4.29499C5.09284 3.65098 5.32215 3.09966 5.78076 2.64105C6.23938 2.18243 6.79069 1.95312 7.4347 1.95312C8.07871 1.95312 8.63003 2.18243 9.08864 2.64105C9.54726 3.09966 9.77656 3.65098 9.77656 4.29499C9.77656 4.939 9.54726 5.49031 9.08864 5.94893C8.63003 6.40754 8.07871 6.63685 7.4347 6.63685ZM2.75098 11.3206V9.68127C2.75098 9.34951 2.83636 9.04458 3.00712 8.76648C3.17788 8.48838 3.40475 8.27615 3.68772 8.12979C4.2927 7.8273 4.90744 7.60043 5.53194 7.44918C6.15643 7.29794 6.79069 7.22232 7.4347 7.22232C8.07871 7.22232 8.71297 7.29794 9.33746 7.44918C9.96196 7.60043 10.5767 7.8273 11.1817 8.12979C11.4647 8.27615 11.6915 8.48838 11.8623 8.76648C12.033 9.04458 12.1184 9.34951 12.1184 9.68127V11.3206H2.75098Z" fill="#009AD0"/>
  </g>
</svg>';

$plus_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
  <mask id="mask0_40002998_9019" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
    <rect width="16" height="16" fill="#D9D9D9"/>
  </mask>
  <g mask="url(#mask0_40002998_9019)">
    <path d="M7.5013 11.1562H8.5013V8.48958H11.168V7.48958H8.5013V4.82292H7.5013V7.48958H4.83464V8.48958H7.5013V11.1562ZM8.00247 14.3229C7.12647 14.3229 6.30308 14.1567 5.5323 13.8243C4.76152 13.4918 4.09108 13.0406 3.52097 12.4708C2.95086 11.9009 2.49947 11.2307 2.1668 10.4603C1.83425 9.68981 1.66797 8.86664 1.66797 7.99075C1.66797 7.11475 1.83419 6.29136 2.16664 5.52058C2.49908 4.74981 2.95025 4.07936 3.52014 3.50925C4.09002 2.93914 4.76019 2.48775 5.53064 2.15508C6.30108 1.82253 7.12425 1.65625 8.00014 1.65625C8.87614 1.65625 9.69952 1.82247 10.4703 2.15492C11.2411 2.48736 11.9115 2.93853 12.4816 3.50842C13.0517 4.07831 13.5031 4.74847 13.8358 5.51892C14.1684 6.28936 14.3346 7.11253 14.3346 7.98842C14.3346 8.86442 14.1684 9.68781 13.836 10.4586C13.5035 11.2294 13.0524 11.8998 12.4825 12.4699C11.9126 13.04 11.2424 13.4914 10.472 13.8241C9.70152 14.1566 8.87836 14.3229 8.00247 14.3229Z" fill="#006EAB"/>
  </g>
</svg>';
?>

<article <?php tribe_classes($classes); ?>
  data-pdop-tooltip-id="tribe-events-tooltip-content-<?php echo esc_attr($event_id); ?>">

  <div class="pdop-event-card-inner">

    <div class="event-title tribe-events-calendar-month__calendar-event-title">
      <a href="<?= esc_url($event_url); ?>" target="_blank"
        class="tribe-events-calendar-month__calendar-event-title-link">
        <?= esc_html($title); ?>
      </a>
    </div>

    <div class="event-time">
      <?= esc_html($start_time . ' - ' . $end_time); ?>
    </div>

    <?php if ($venue): ?>
      <div class="event-meta event-location">
        <span class="tec_location_icon">
          <?php echo $location_icon; ?>
        </span>
        <span class="tec_location">
          <?= esc_html($venue); ?>
        </span>
      </div>
    <?php endif; ?>

    <?php if ($organizer): ?>
      <div class="event-meta event-organizer">
        <span class="tec_user_icon">
          <?php echo $user_icon; ?>
        </span>
        <span class="tec_user">
          <?= esc_html($organizer); ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="event-action">
      <?php if ($is_waitlist): ?>
        <span class="waitlist">Join Waitlist</span>
      <?php else: ?>
        <span class="tec_register_icon">
          <?php echo $plus_icon; ?>
        </span>
        <a href="<?= esc_url($event_url); ?>" class="register" target="_blank">
          Register
        </a>
      <?php endif; ?>
    </div>

  </div>

  <!-- KEEP TOOLTIP -->
  <?php $this->template(
    'month/calendar-body/day/calendar-events/calendar-event/tooltip',
    ['event' => $event]
  ); ?>

</article>