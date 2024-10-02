<?php
$paged = ($params['num']) ?  $params['num'] : 1;

$args = array(
    'post_type' => 'gym',
    'posts_per_page' => 4,
    'paged' => $paged,
);

if (input_exist('s', 'get')) {
    $args['s'] = input_exist('s', 'get');
}

$query = new WP_Query($args);

$count = 0;

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        include component('gum-block');

        $count++;
    endwhile;
endif;
