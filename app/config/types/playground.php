<?php

use LC\CPT;

$playground = new CPT(
    array(
        'post_type_name' => 'playground',
        'singular' => __('Playground', 'qeema'),
        'plural' => __('ملاعب', 'qeema'),
    ),
    array(
        'supports' => array('title'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/soccer.png'
    )
);

/*=============================
    [02. Create Taxonimes]
===============================*/

$playground->register_taxonomy(array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('الاقسام', 'qeema'),
    'slug' => 'section',
));

$playground->register_taxonomy(array(
    'taxonomy_name' => 'city',
    'singular' => __('Country', 'qeema'),
    'plural' => __('المدن', 'qeema'),
    'slug' => 'city',
));

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$playground->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'basic_image' => __('صورة مصغره', 'qeema'),
        'title' => __('اسم الملعب', 'qeema'),
        'section' => __('الاقسام', 'qeema'),
        'city' => __('االمدن', 'qeema'),
        'date' => __('تاريخ النشر', 'qeema')
    )
);

$playground->populate_column('basic_image', function ($column, $post) {
    echo '<img class="rounded-1" style="width:90px;height:90px;object-fit:cover;" src="' . get_field('basic_image', $post->ID) . '" >';
});
