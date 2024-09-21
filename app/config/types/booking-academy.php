<?php

use LC\CPT;

$bookingAcademy = new CPT(
    array(
        'post_type_name' => 'booking-academy',
        'singular' => __('Booking Academy', 'qeema'),
        'plural' => __('حجوزات الاكادميات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/grammar.png' //'dashicons-slides',
    )
);
