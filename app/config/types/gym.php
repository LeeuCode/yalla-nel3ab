<?php

use LC\CPT;

$gym = new CPT(
    array(
        'post_type_name' => 'gym',
        'singular' => __('Gym', 'qeema'),
        'plural' => __('صالات الجيم', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/gym.png' //'dashicons-slides',
    )
);

/*=============================
    [02. Create Taxonimes]
===============================*/

$gym->register_taxonomy(array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('الاقسام', 'qeema'),
    'slug' => 'section',
));

$gym->register_taxonomy(array(
    'taxonomy_name' => 'city',
    'singular' => __('Country', 'qeema'),
    'plural' => __('المدن', 'qeema'),
    'slug' => 'city',
));

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$gym->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'basic_image' => __('صورة مصغره', 'qeema'),
        'title' => __('اسم الجيم', 'qeema'),
        'section' => __('الاقسام', 'qeema'),
        'city' => __('االمدن', 'qeema'),
        'date' => __('تاريخ النشر', 'qeema')
    )
);

$gym->populate_column('basic_image', function ($column, $post) {
    echo '<img class="rounded-1" style="width:90px;height:90px;object-fit:cover;" src="' . get_field('basic_image', $post->ID) . '" >';
});
