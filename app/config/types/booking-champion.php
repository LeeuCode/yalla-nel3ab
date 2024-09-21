<?php

use LC\CPT;

$booking_champion = new CPT(
    array(
        'post_type_name' => 'booking_champion',
        'singular' => __('Booking Championship', 'qeema'),
        'plural' => __('حجز البطولات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/winner.png' //'dashicons-slides',
    )
);

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$booking_champion->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'image' => __('صورة الفريق', 'qeema'),
        'title' => __('اسم الفرقه', 'qeema'),
        'user_name' => __('اسم مقدم الطلب', 'qeema'),
        'champ' => __('البطوله', 'qeema'),
        // 'type' => __('نوع النشاط', 'qeema'),
        'players_count' => __('عدد اللاعبين', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

$booking_champion->populate_column('image', function ($column, $post) {
    $i = get_post_meta($post->ID, 'team_avatar', true);
    echo '<img width="90" height="90" class="rounded-1 shadow" src="' . wp_get_attachment_image_url($i, 'full') . '" >';
});

$booking_champion->populate_column('user_name', function ($column, $post) {
    $user = get_user_by('id', $post->post_author);
    echo '<span class="d-inline-block text-white bg-secondary py-1 px-3 rounded-1 small">' . $user->first_name . ' ' . $user->last_name . '</span>';
});

$booking_champion->populate_column('champ', function ($column, $post) {
    $post_id = get_post_meta($post->ID, 'post_id', true);
    echo '<span class="d-inline-block text-white bg-primary py-1 px-3 rounded-1 small">' . get_the_title($post_id) . '</span>';
});

$booking_champion->populate_column('players_count', function ($column, $post) {
    $players_count = get_post_meta($post->ID, 'players_count', true);
    echo '<span class="d-inline-block text-white bg-success py-1 px-3 rounded-1 small">' . $players_count . '</span>';
});
