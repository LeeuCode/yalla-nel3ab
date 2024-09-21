<?php

use LC\CPT;

$coach = new CPT(
    array(
        'post_type_name' => 'coach',
        'singular' => __('Coach', 'qeema'),
        'plural' => __('المدربين', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/coach.png' //'dashicons-slides',
    )
);

/*=============================
    [02. Create Taxonimes]
===============================*/

$columns = array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('الاقسام', 'qeema'),
    'slug' => 'section',
);

$coach->register_taxonomy($columns);

$coach->register_taxonomy(array(
    'taxonomy_name' => 'city',
    'singular' => __('Country', 'qeema'),
    'plural' => __('المدن', 'qeema'),
    'slug' => 'city',
));

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$coach->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'image_url' => __('صورة مصغره', 'qeema'),
        'title' => __('اسم المدرب', 'qeema'),
        'section' => __('الاقسام', 'qeema'),
        'city' => __('االمدن', 'qeema'),
        'date' => __('تاريخ النشر', 'qeema')
    )
);

$coach->populate_column('image_url', function ($column, $post) {
    echo '<img class="rounded-1" style="width:90px;height:90px;object-fit:cover;" src="' . get_field('image_url', $post->ID) . '" >';
});
