<?php

use LC\CPT;

$bookings = new CPT(
    array(
        'post_type_name' => 'champion_calendar',
        'singular' => __('Champion Calendar', 'qeema'),
        'plural' => __('جدول البطولات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/calendar.png',
    )
);
