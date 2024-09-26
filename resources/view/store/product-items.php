<?php
$paged = ($params['num']) ?  $params['num'] : 1;

$args = array(
    'post_type' => 'store',
    'posts_per_page' => 4,
    'paged' => $paged
);


if (isset($params['term_id'])) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'brand',
            'field' => 'term_id',
            'terms' => array($params['term_id'])
        )
    );
}

if (input_exist('s', 'get')) {
    $args['s'] = input_exist('s', 'get');
}

$query = new WP_Query($args);

$count = 0;

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        include component('product');

        $count++;
    endwhile;
endif;
