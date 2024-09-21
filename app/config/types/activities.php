<?php

use LC\CPT;

$activities = new CPT(
    array(
        'post_type_name' => 'activity',
        'singular' => __('Activity', 'qeema'),
        'plural' => __('الانشطه', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/extracurricular-activities.png' //'dashicons-slides',
    )
);

/*=============================
    [02. Create Taxonimes]
===============================*/

$activities->register_taxonomy(array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('اقسام الانشطه', 'qeema'),
    'slug' => 'section',
));

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$activities->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'title' => __('رقم الطلب', 'qeema'),
        'user_name' => __('اسم مقدم الطلب', 'qeema'),
        'type' => __('نوع النشاط', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

$activities->populate_column('user_name', function ($column, $post) {
    $user = get_user_by('id', $post->post_author);
    echo '<span class="d-inline-block text-white bg-secondary py-1 px-3 rounded-1 small">' . $user->first_name . ' ' . $user->last_name . '</span>';
});

$activities->populate_column('type', function ($column, $post) {
    $activity_cat = get_post_meta($post->ID, 'activity_cat', true);

    // $name = get_post_type_object(get_post_type($post_id))->labels->name;
    echo '<span class="d-inline-block text-white bg-primary py-1 px-3 rounded-1 small">' .  get_term($activity_cat)->name . '</span>';
});
