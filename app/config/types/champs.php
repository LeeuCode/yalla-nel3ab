<?php

use LC\CPT;

$champ = new CPT(
    array(
        'post_type_name' => 'champ',
        'singular' => __('Championship', 'qeema'),
        'plural' => __('البطولات', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/champ.png' //'dashicons-slides',
    )
);


/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$champ->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'title' => __('اسم البطوله', 'qeema'),
        'type' => __('نوع البطوله', 'qeema'),
        'team_count' => __('عدد الفريق', 'qeema'),
        'start_date' => __('تاريخ البطوله', 'qeema'),
        'start_time' => __('وقت البدأ', 'qeema'),
        'end_time' => __('وقت البدأ', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

$champ->populate_column('type', function ($column, $post) {
    $term_id = get_post_meta($post->ID, 'term_id', true);

    $term = get_term_by('id', $term_id, 'section');

    echo '<span class="d-inline-block text-white bg-primary py-1 px-3 rounded-1 small">' .  $term->name  . '</span>';
});

$champ->populate_column('team_count', function ($column, $post) {
    $team_count = get_post_meta($post->ID, 'team_count', true);

    echo '<span class="d-inline-block text-white bg-dark py-1 px-3 rounded-1 small">' . $team_count . '</span>';
});

$champ->populate_column('start_date', function ($column, $post) {
    $start_date = get_post_meta($post->ID, 'start_date', true);

    echo '<span class="d-inline-block text-white bg-success py-1 px-3 rounded-1 small">' . $start_date . '</span>';
});

$champ->populate_column('start_time', function ($column, $post) {
    $start_time = get_post_meta($post->ID, 'start_time', true);

    echo '<span class="d-inline-block text-dark bg-warning py-1 px-3 rounded-1 small">' . date('h:i a', strtotime($start_time)) . '</span>';
});

$champ->populate_column('end_time', function ($column, $post) {
    $end_time = get_post_meta($post->ID, 'end_time', true);

    echo '<span class="d-inline-block text-white bg-danger py-1 px-3 rounded-1 small">' . date('h:i a', strtotime($end_time)) . '</span>';
});
