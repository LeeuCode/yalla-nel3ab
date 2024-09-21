<?php

use LC\CPT;

$store = new CPT(
    array(
        'post_type_name' => 'store',
        'singular' => __('Product', 'qeema'),
        'plural' => __('المتجر', 'qeema'),
    ),
    array(
        'supports' => array('title', 'thumbnail'),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() . '/assets/images/icons/store.png' //'dashicons-slides',
    )
);

/*=============================
    [02. Create Taxonimes]
===============================*/

$store->register_taxonomy(array(
    'taxonomy_name' => 'brand',
    'singular' => __('Brand', 'qeema'),
    'plural' => __('العلامة التجاريه', 'qeema'),
    'slug' => 'brand',
));

$columns = array(
    'taxonomy_name' => 'section',
    'singular' => __('Section', 'qeema'),
    'plural' => __('الاقسام', 'qeema'),
    'slug' => 'section',
);

$store->register_taxonomy($columns);

$store->register_taxonomy(array(
    'taxonomy_name' => 'color',
    'singular' => __('Color', 'qeema'),
    'plural' => __('الالوان', 'qeema'),
    'slug' => 'color',
));

$store->register_taxonomy(array(
    'taxonomy_name' => 'size',
    'singular' => __('Size', 'qeema'),
    'plural' => __('المقاس', 'qeema'),
    'slug' => 'size',
));

/*=============================
    [03. Sort & Rebuild Columns]
===============================*/

$store->columns(
    array(
        'cb' => '<input type="checkbox" />',
        'image' => __('صوره توضيحيه', 'qeema'),
        'title' => __('العنوان', 'qeema'),
        'brand' => __('العلامه التجاريه', 'qeema'),
        'section' => __('القسم', 'qeema'),
        'color' => __('اللون', 'qeema'),
        'size' => __('المقاس', 'qeema'),
        'date' => __('تاريخ التقديم', 'qeema')
    )
);

$store->populate_column('image', function ($column, $post) {
    echo '<img class="rounded-1" style="width:90px;height:90px;object-fit:cover;" src="' . get_the_post_thumbnail_url($post->ID) . '" >';
});
