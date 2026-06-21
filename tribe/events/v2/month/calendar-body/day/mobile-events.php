<?php
/**
 * Override: Mobile Events (FORCE CUSTOM STRUCTURE)
 */

defined( 'ABSPATH' ) || exit;
if (empty($events)) {
    return;
}
?>

<div class="tribe-events-calendar-month__day-cell-events tribe-events-calendar-month__day-cell-events--mobile">

    <?php foreach ($events as $event):

        $event_id = $event->ID;

        $title = get_the_title($event_id);
        $start = tribe_get_start_time($event_id, 'g:i a');
        $end = tribe_get_end_time($event_id, 'g:i a');
        $venue = tribe_get_venue($event_id);
        $organizer = tribe_get_organizer($event_id);
        $is_waitlist = get_post_meta($event_id, '_waitlist', true);
        $event_url = get_post_meta($event_id, '_EventURL', true);
        if (empty($event_url)) {
            $event_url = get_permalink($event_id);
        }

        $categories = wp_get_post_terms($event_id, 'tribe_events_cat');
        $card_class = !empty($categories) ? 'event-' . $categories[0]->slug : '';

        $classes = tribe_get_post_class(
            ['tribe-events-calendar-month__calendar-event', 'pdop-event-card', $card_class],
            $event_id
        );
        ?>

        <article <?php tec_classes($classes); ?>>

            <!-- TITLE -->
            <h3 class="tribe-events-calendar-month__calendar-event-title">
                <a href="<?= esc_url($event_url); ?>" target="_blank"
                    class="tribe-events-calendar-month__calendar-event-title-link">
                    <?= esc_html($title); ?>
                </a>
            </h3>

            <!-- TIME -->
            <div class="event-time">
                <?= esc_html($start . ' - ' . $end); ?>
            </div>

            <!-- LOCATION -->
            <?php if ($venue): ?>
                <div class="event-location">
                    <?= esc_html($venue); ?>
                </div>
            <?php endif; ?>

            <!-- ORGANIZER -->
            <?php if ($organizer): ?>
                <div class="event-organizer">
                    <?= esc_html($organizer); ?>
                </div>
            <?php endif; ?>

            <!-- ACTION -->
            <div class="event-action">
                <?php if ($is_waitlist): ?>
                    <span>Join Waitlist</span>
                <?php else: ?>
                    <a href="<?= esc_url($event_url); ?>" target="_blank">
                        Register
                    </a>
                <?php endif; ?>
            </div>

            <!-- TOOLTIP (IMPORTANT) -->
            <?php
            $this->template(
                'month/calendar-body/day/calendar-events/calendar-event/tooltip',
                ['event' => $event]
            );
            ?>

        </article>

    <?php endforeach; ?>

</div>