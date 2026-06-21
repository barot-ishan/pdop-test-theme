<?php

if (!defined('ABSPATH')) {
    exit;
}

$title = get_sub_field('title');
$activity_page_link = get_sub_field('activity_page_link');
$select_program_from_amilia = get_sub_field('select_program_from_amilia');

$shortcode = 'smartrec_program_categories class="pdop_program_category_wrapper"';

if (!empty($title)) {
    $shortcode .= ' title="' . $title . '"';
}

if (!empty($activity_page_link)) {
    $shortcode .= ' activities_page="' . $activity_page_link . '"';
}

if (!empty($select_program_from_amilia)) {
    $shortcode .= ' program_id="' . $select_program_from_amilia . '"';
}

echo do_shortcode("[" . $shortcode . "]");
