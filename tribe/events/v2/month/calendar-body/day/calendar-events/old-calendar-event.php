<?php
/**
 * Custom Month Calendar Event Card (BEST PRACTICE)
 */

$event_id = $event->ID;

// TEC default classes (KEEP THIS)
$classes = tribe_get_post_class(
    ['tribe-events-calendar-month__calendar-event', 'pdop-event-card'],
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

// Instructor
$instructor = get_field('instructor', $event_id);

// Waitlist logic
$is_waitlist = get_post_meta($event_id, '_waitlist', true);

// Category class
$categories = wp_get_post_terms($event_id, 'tribe_events_cat');
$card_class = !empty($categories) ? 'event-' . $categories[0]->slug : '';
?>

<article <?php tec_classes($classes); ?> class="
    <?= esc_attr($card_class); ?>">

    <div class="pdop-event-card-inner">

        <div class="event-title">
            <?= esc_html($title); ?>
        </div>

        <div class="event-time">
            <?= esc_html($start_time . ' - ' . $end_time); ?>
        </div>

        <?php if ($venue): ?>
            <div class="event-meta event-location">
                <?= esc_html($venue); ?>
            </div>
        <?php endif; ?>

        <?php if ($instructor): ?>
            <div class="event-meta event-instructor">
                <?= esc_html($instructor); ?>
            </div>
        <?php endif; ?>

        <div class="event-action">
            <?php if ($is_waitlist): ?>
                <span class="waitlist">Join Waitlist</span>
            <?php else: ?>
                <a href="<?= esc_url(get_permalink($event_id)); ?>" class="register">
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