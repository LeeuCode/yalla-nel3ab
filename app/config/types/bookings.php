<?php

use LC\CPT;

$bookings = new CPT(
    array(
        'post_type_name' => 'bookings',
        'singular' => __('Booking', 'qeema'),
        'plural' => __('حجوزات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/team-bench.png' //'dashicons-slides',
    )
);


/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$bookings->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'title' => __('رقم الطلب', 'qeema'),
        'user_name' => __('اسم مقدم الطلب', 'qeema'),
        'type' => __('نوع الحجز', 'qeema'),
        'booking_name' => __('الحجز', 'qeema'),
        'period' => __('نوع الفتره', 'qeema'),
        'price' => __('السعر', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

$bookings->populate_column('user_name', function ($column, $post) {
    $user = get_user_by('id', $post->post_author);
    echo '<span class="d-inline-block text-white bg-secondary py-1 px-3 rounded-1 small">' . $user->first_name . ' ' . $user->last_name . '</span>';
});

$bookings->populate_column('type', function ($column, $post) {
    $post_id = get_post_meta($post->ID, 'post_id', true);

    $name = get_post_type_object(get_post_type($post_id))->labels->name;
    echo '<span class="d-inline-block text-white bg-primary py-1 px-3 rounded-1 small">' . $name . '</span>';
});

$bookings->populate_column('booking_name', function ($column, $post) {
    $post_id = get_post_meta($post->ID, 'post_id', true);

    $name = get_the_title($post_id);
    echo '<span class="d-inline-block text-center text-dark bg-info py-1 px-3 rounded-1 small">' . $name . '</span>';
});

$bookings->populate_column('period', function ($column, $post) {
    $period = get_post_meta($post->ID, 'period', true);

    if ($period == 'period_morning') {
        $text = __('الفترة الصباحية', 'qeema');
        $class = 'text-dark bg-warning';
    } else {
        $text = __('الفترة المسائية', 'qeema');
        $class = 'text-white bg-dark';
    }

    echo '<span class="d-inline-block text-center ' . $class . ' py-1 px-3 rounded-1 small">' . $text . '</span>';
});

$bookings->populate_column('price', function ($column, $post) {
    $price = get_post_meta($post->ID, 'price', true);

    echo '<span class="d-inline-block text-center text-white bg-success py-1 px-3 rounded-1 small">' . $price . 'ج.م</span>';
});
