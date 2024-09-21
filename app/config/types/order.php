<?php

use LC\CPT;

$order = new CPT(
    array(
        'post_type_name' => 'lc_order',
        'singular' => __('Order', 'qeema'),
        'plural' => __('طلبات المنتجات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/order.png' //'dashicons-slides',
    )
);


/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$order->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'image' => __('صورة المنتج', 'qeema'),
        'title' => __('رقم الطلب', 'qeema'),
        'user_name' => __('اسم مقدم الطلب', 'qeema'),
        'product' => __('المنتج', 'qeema'),
        'qt' => __('الكمية', 'qeema'),
        'total' => __('المبلغ الاجمالي', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);


$order->populate_column('image', function ($column, $post) {
    $post_id = get_post_meta($post->ID, 'post_id', true);
    echo '<img class="rounded-1 shadow" style="width:90px;height:90px;object-fit:cover;" src="' . get_the_post_thumbnail_url( $post_id, 'full' ) . '" >';
});

$order->populate_column('user_name', function ($column, $post) {
    $user = get_user_by('id', $post->post_author);
    echo '<span class="d-inline-block text-white bg-secondary py-1 px-3 rounded-1 small">' . $user->first_name . ' ' . $user->last_name . '</span>';
});

$order->populate_column('product', function ($column, $post) {
    $post_id = get_post_meta($post->ID, 'post_id', true);
    echo '<span class="d-inline-block text-white bg-primary py-1 px-3 rounded-1 small">' . get_the_title($post_id) . '</span>';
});

$order->populate_column('qt', function ($column, $post) {
    $qt = get_post_meta($post->ID, 'qt', true);
    echo '<span class="d-inline-block text-white bg-warning py-1 px-3 rounded-1 small">' . $qt . '</span>';
});

$order->populate_column('total', function ($column, $post) {
    $total = get_post_meta($post->ID, 'total', true);
    echo '<span class="d-inline-block text-white bg-success py-1 px-3 rounded-1 small">' . $total . 'ج.م</span>';
});
