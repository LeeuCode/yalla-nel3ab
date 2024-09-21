<?php

use LC\CPT;

$bookingCoach = new CPT(
    array(
        'post_type_name' => 'booking-coach',
        'singular' => __('Booking Coach', 'qeema'),
        'plural' => __('حجوزات المدربين', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/coach-01.png' //'dashicons-slides',
    )
);


/*=============================
    [02. Create Taxonimes]
===============================*/

$bookingCoach->register_taxonomy(array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('الاقسام', 'qeema'),
    'slug' => 'section',
));

$bookingCoach->register_taxonomy(array(
    'taxonomy_name' => 'city',
    'singular' => __('Country', 'qeema'),
    'plural' => __('المدن', 'qeema'),
    'slug' => 'city',
));


/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$bookingCoach->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'title' => __('العنوان', 'qeema'),
        'user' => __('اسم مقدم الطلب', 'qeema'),
        // 'user' => __('', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

