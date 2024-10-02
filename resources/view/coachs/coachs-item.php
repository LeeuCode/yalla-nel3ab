<?php
$paged = ($params['num']) ?  $params['num'] : 1;
$args = array(
    'post_type' => 'coach',
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

        $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                hx-swap="afterend"' : '';
        include component('coach-block');
        $count++;
    endwhile;
endif;
