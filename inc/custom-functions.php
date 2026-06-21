<?php

if (!defined('ABSPATH')) {
    exit;
}

function event_card($event)
{
    ob_start();
    $event_id = $event->ID;
    $event_title = get_the_title($event_id);
    $event_link = get_permalink($event_id);
    $event_desc = get_the_excerpt($event_id) ?: wp_trim_words(get_post_field('post_content', $event_id), 25, '...');

    $event_image = get_the_post_thumbnail(
        $event_id,
        'medium_large',
        [
            'alt' => esc_attr($event_title),
            'loading' => 'lazy',
        ]
    ) ?: '<img src="/wp-content/uploads/2026/04/default_event.png" alt="' . esc_attr($event_title) . '" loading="lazy">';

    // Date & time
    $event_start_raw = tribe_get_start_date($event_id, false, 'Y-m-d H:i:s');
    $display_date = tribe_get_start_date($event_id, false, 'l, F j Y.');
    $start_time = tribe_get_start_date($event_id, false, 'g:i A');
    $end_time = tribe_get_end_date($event_id, false, 'g:i A');

    // Venue / location
    $venue_name = '';
    if (function_exists('tribe_get_venue')) {
        $venue_name = tribe_get_venue($event_id);
    }

    // Category terms
    $event_cats = get_the_terms($event_id, 'tribe_events_cat');

    // Google Calendar link
    $gcal_start = tribe_get_start_date($event_id, false, 'Ymd\THis');
    $gcal_end = tribe_get_end_date($event_id, false, 'Ymd\THis');
    $gcal_url = add_query_arg([
        'action' => 'TEMPLATE',
        'text' => urlencode($event_title),
        'dates' => $gcal_start . '/' . $gcal_end,
        'location' => urlencode($venue_name),
    ], 'https://www.google.com/calendar/render');

    $unique_id = 'event-title-' . $event_id;
?>

    <article class="pdop_upcoming_events_card swiper-slide"
        aria-labelledby="<?php echo esc_attr($unique_id); ?>">

        <!-- Image -->
        <div class="pdop_upcoming_events_card_image">
            <a href="<?php echo esc_url($event_link); ?>" tabindex="-1" aria-hidden="true">
                <?php echo $event_image; ?>
            </a>
            <?php if ($event_cats && !is_wp_error($event_cats)) : ?>
                <span class="pdop_upcoming_events_card_tag">
                    <?php echo esc_html($event_cats[0]->name); ?>
                </span>
            <?php else : ?>
                <span class="pdop_upcoming_events_card_tag">Event</span>
            <?php endif; ?>
        </div>

        <!-- Content -->
        <div class="pdop_upcoming_events_card_content">

            <h3 id="<?php echo esc_attr($unique_id); ?>"
                class="pdop_upcoming_events_card_title">
                <?php echo esc_html($event_title); ?>
            </h3>

            <?php if (!empty($event_desc)) : ?>
                <p class="pdop_upcoming_events_card_desc">
                    <?php echo esc_html($event_desc); ?>
                </p>
            <?php endif; ?>

            <!-- Meta: Location -->
            <?php if (!empty($venue_name)) : ?>
                <div class="pdop_upcoming_events_card_meta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                        <mask id="mask0_40002441_24908" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                            <rect width="18" height="18" fill="#D9D9D9" />
                        </mask>
                        <g mask="url(#mask0_40002441_24908)">
                            <path d="M9 8.99805C9.4125 8.99805 9.76563 8.85117 10.0594 8.55742C10.3531 8.26367 10.5 7.91055 10.5 7.49805C10.5 7.08555 10.3531 6.73242 10.0594 6.43867C9.76563 6.14492 9.4125 5.99805 9 5.99805C8.5875 5.99805 8.23438 6.14492 7.94063 6.43867C7.64688 6.73242 7.5 7.08555 7.5 7.49805C7.5 7.91055 7.64688 8.26367 7.94063 8.55742C8.23438 8.85117 8.5875 8.99805 9 8.99805ZM9 16.498C6.9875 14.7855 5.48438 13.1949 4.49063 11.7262C3.49688 10.2574 3 8.89805 3 7.64805C3 5.77305 3.60313 4.2793 4.80938 3.1668C6.01563 2.0543 7.4125 1.49805 9 1.49805C10.5875 1.49805 11.9844 2.0543 13.1906 3.1668C14.3969 4.2793 15 5.77305 15 7.64805C15 8.89805 14.5031 10.2574 13.5094 11.7262C12.5156 13.1949 11.0125 14.7855 9 16.498Z" fill="#009AD0" />
                        </g>
                    </svg>
                    <span><?php echo esc_html($venue_name); ?></span>
                </div>
            <?php endif; ?>

            <!-- Meta: Date -->
            <?php if (!empty($event_start_raw)) : ?>
                <div class="pdop_upcoming_events_card_meta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                        <mask id="mask0_40002441_24913" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                            <rect width="18" height="18" fill="#D9D9D9" />
                        </mask>
                        <g mask="url(#mask0_40002441_24913)">
                            <path d="M9 10.5C8.7875 10.5 8.60938 10.4281 8.46563 10.2844C8.32188 10.1406 8.25 9.9625 8.25 9.75C8.25 9.5375 8.32188 9.35938 8.46563 9.21563C8.60938 9.07188 8.7875 9 9 9C9.2125 9 9.39063 9.07188 9.53438 9.21563C9.67813 9.35938 9.75 9.5375 9.75 9.75C9.75 9.9625 9.67813 10.1406 9.53438 10.2844C9.39063 10.4281 9.2125 10.5 9 10.5ZM6 10.5C5.7875 10.5 5.60938 10.4281 5.46562 10.2844C5.32187 10.1406 5.25 9.9625 5.25 9.75C5.25 9.5375 5.32187 9.35938 5.46562 9.21563C5.60938 9.07188 5.7875 9 6 9C6.2125 9 6.39062 9.07188 6.53438 9.21563C6.67812 9.35938 6.75 9.5375 6.75 9.75C6.75 9.9625 6.67812 10.1406 6.53438 10.2844C6.39062 10.4281 6.2125 10.5 6 10.5ZM12 10.5C11.7875 10.5 11.6094 10.4281 11.4656 10.2844C11.3219 10.1406 11.25 9.9625 11.25 9.75C11.25 9.5375 11.3219 9.35938 11.4656 9.21563C11.6094 9.07188 11.7875 9 12 9C12.2125 9 12.3906 9.07188 12.5344 9.21563C12.6781 9.35938 12.75 9.5375 12.75 9.75C12.75 9.9625 12.6781 10.1406 12.5344 10.2844C12.3906 10.4281 12.2125 10.5 12 10.5ZM9 13.5C8.7875 13.5 8.60938 13.4281 8.46563 13.2844C8.32188 13.1406 8.25 12.9625 8.25 12.75C8.25 12.5375 8.32188 12.3594 8.46563 12.2156C8.60938 12.0719 8.7875 12 9 12C9.2125 12 9.39063 12.0719 9.53438 12.2156C9.67813 12.3594 9.75 12.5375 9.75 12.75C9.75 12.9625 9.67813 13.1406 9.53438 13.2844C9.39063 13.4281 9.2125 13.5 9 13.5ZM6 13.5C5.7875 13.5 5.60938 13.4281 5.46562 13.2844C5.32187 13.1406 5.25 12.9625 5.25 12.75C5.25 12.5375 5.32187 12.3594 5.46562 12.2156C5.60938 12.0719 5.7875 12 6 12C6.2125 12 6.39062 12.0719 6.53438 12.2156C6.67812 12.3594 6.75 12.5375 6.75 12.75C6.75 12.9625 6.67812 13.1406 6.53438 13.2844C6.39062 13.4281 6.2125 13.5 6 13.5ZM12 13.5C11.7875 13.5 11.6094 13.4281 11.4656 13.2844C11.3219 13.1406 11.25 12.9625 11.25 12.75C11.25 12.5375 11.3219 12.3594 11.4656 12.2156C11.6094 12.0719 11.7875 12 12 12C12.2125 12 12.3906 12.0719 12.5344 12.2156C12.6781 12.3594 12.75 12.5375 12.75 12.75C12.75 12.9625 12.6781 13.1406 12.5344 13.2844C12.3906 13.4281 12.2125 13.5 12 13.5ZM3.75 16.5C3.3375 16.5 2.98438 16.3531 2.69063 16.0594C2.39688 15.7656 2.25 15.4125 2.25 15V4.5C2.25 4.0875 2.39688 3.73438 2.69063 3.44063C2.98438 3.14688 3.3375 3 3.75 3H4.5V1.5H6V3H12V1.5H13.5V3H14.25C14.6625 3 15.0156 3.14688 15.3094 3.44063C15.6031 3.73438 15.75 4.0875 15.75 4.5V15C15.75 15.4125 15.6031 15.7656 15.3094 16.0594C15.0156 16.3531 14.6625 16.5 14.25 16.5H3.75ZM3.75 15H14.25V7.5H3.75V15Z" fill="#009AD0" />
                        </g>
                    </svg>
                    <time datetime="<?php echo esc_attr($event_start_raw); ?>">
                        <?php echo esc_html($display_date); ?>
                    </time>
                </div>
            <?php endif; ?>

            <!-- Meta: Time -->
            <?php if (!empty($start_time)) : ?>
                <div class="pdop_upcoming_events_card_meta">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                        <mask id="mask0_40002441_24918" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="18" height="18">
                            <rect width="18" height="18" fill="#D9D9D9" />
                        </mask>
                        <g mask="url(#mask0_40002441_24918)">
                            <path d="M11.475 12.525L12.525 11.475L9.75 8.7V5.25H8.25V9.3L11.475 12.525ZM9 16.5C7.9625 16.5 6.9875 16.3031 6.075 15.9094C5.1625 15.5156 4.36875 14.9813 3.69375 14.3063C3.01875 13.6313 2.48438 12.8375 2.09063 11.925C1.69687 11.0125 1.5 10.0375 1.5 9C1.5 7.9625 1.69687 6.9875 2.09063 6.075C2.48438 5.1625 3.01875 4.36875 3.69375 3.69375C4.36875 3.01875 5.1625 2.48438 6.075 2.09063C6.9875 1.69687 7.9625 1.5 9 1.5C10.0375 1.5 11.0125 1.69687 11.925 2.09063C12.8375 2.48438 13.6313 3.01875 14.3063 3.69375C14.9813 4.36875 15.5156 5.1625 15.9094 6.075C16.3031 6.9875 16.5 7.9625 16.5 9C16.5 10.0375 16.3031 11.0125 15.9094 11.925C15.5156 12.8375 14.9813 13.6313 14.3063 14.3063C13.6313 14.9813 12.8375 15.5156 11.925 15.9094C11.0125 16.3031 10.0375 16.5 9 16.5Z" fill="#009AD0" />
                        </g>
                    </svg>
                    <span><?php echo esc_html($start_time); ?><?php echo !empty($end_time) ? ' - ' . esc_html($end_time) : ''; ?></span>
                </div>
            <?php endif; ?>

            <!-- Footer: Add to Calendar + View Details -->
            <div class="pdop_upcoming_events_card_footer">
                <?php
                $gcal_url = tribe_get_gcal_link($event_id);
                $ical_url = $event_link . '?ical=1';

                $outlook_url = "https://outlook.office.com/owa/?path=/calendar/action/compose&rrv=addevent"
                    . "&startdt={$gcal_start}"
                    . "&enddt={$gcal_end}"
                    . "&subject={$event_title}"
                    . "&body={$event_desc}"
                    . "&location={$venue_name}";
                ?>

                <button class="pdop_upcoming_events_card_cal" type="button" data-bs-toggle="collapse" href="#pdop_upcoming_events_card_cal_<?php echo esc_attr($event_id); ?>" role="button" aria-expanded="false" aria-controls="collapseExample"
                    aria-label="Add <?php echo esc_attr($event_title); ?> to Google Calendar">
                    + Add to Calendar
                </button>

                <div id="pdop_upcoming_events_card_cal_<?php echo esc_attr($event_id); ?>" class="collapse pdop_event_dropdown pdop_upcoming_events_card_cal_dropdown unset_li">
                    <ul class="pdop_upcoming_events_card_cal_list">
                        <li>
                            <a class="pdop_upcoming_events_card_cal_link"
                                href="<?php echo esc_url($gcal_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Add <?php echo esc_attr($event_title); ?> to Google Calendar">
                                Google Calendar
                            </a>
                        </li>

                        <li>
                            <a class="pdop_upcoming_events_card_cal_link"
                                href="<?php echo esc_url($ical_url); ?>"
                                download
                                aria-label="Download <?php echo esc_attr($event_title); ?> iCal file">
                                iCalendar
                            </a>
                        </li>

                        <li>
                            <a class="pdop_upcoming_events_card_cal_link"
                                href="<?php echo esc_url($outlook_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Add <?php echo esc_attr($event_title); ?> to Outlook Calendar">
                                Outlook
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="<?php echo esc_url($event_link); ?>"
                    class="pdop_btn"
                    aria-label="View details for <?php echo esc_attr($event_title); ?>">
                    View Details
                </a>
            </div>
        </div>
    </article>
<?php
    return ob_get_clean();
}


add_filter('acf/fields/post_object/query/name=select_program_page', 'filter_post_object_by_template', 10, 3);

function filter_post_object_by_template($args, $field, $post_id)
{

    $args['meta_query'] = array(
        array(
            'key'     => '_wp_page_template',
            'value'   => array(
                'templates/program.php',
                'templates/program-activity.php',
            ),
            'compare' => '='
        )
    );

    return $args;
}

add_filter('acf/load_field/name=select_program_from_amilia', 'load_amilia_program_options');

function load_amilia_program_options($field)
{

    // Reset choices
    $field['choices'] = [];

    global $wpdb;

    // Replace with your actual table name
    $table_name = $wpdb->prefix . 'smartrec_programs';

    // Fetch program data
    $programs = $wpdb->get_results("
        SELECT program_id, name 
        FROM {$table_name}
        ORDER BY name ASC
    ");

    if (!empty($programs)) {
        foreach ($programs as $program) {
            $field['choices'][$program->program_id] = $program->name . ' (ID: ' . $program->program_id . ')';
        }
    }

    return $field;
}



?>