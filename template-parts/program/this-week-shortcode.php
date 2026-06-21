<?php

if (!defined('ABSPATH')) {
    exit;
}

$title = get_sub_field('title');
$select_program_from_amilia = get_sub_field('select_program_from_amilia');

$shortcode = 'smartrec_this_week_swiper class="pdop_program_this_week_wrapper"';

if (!empty($title)) {
    $shortcode .= ' title="' . $title . '"';
}

if (!empty($select_program_from_amilia)) {
    $shortcode .= ' program_id="' . $select_program_from_amilia . '"';
}

echo do_shortcode("[" . $shortcode . "]");
