<?php

$city = input_exist('city', 'get');
$cityChild = input_exist('city-child', 'get');
$postType = input_exist('post-type', 'get');

if ($city) {
    $terms = $city;
}

if ($cityChild) {
    $terms = $cityChild;
}

$paged = ($params['num']) ?  $params['num'] : 1;

$_args = array(
    'post_type' => 'coach',
    'posts_per_page' => 4,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
        [
            'taxonomy' => 'city',
            'field' => 'term_id',
            'terms' => $terms
        ],

    )
);

if (isset($args['section_id'])) {

    $_args['tax_query'][] = [
        'taxonomy' => 'section',
        'field' => 'term_id',
        'terms' => [$args['section_id']]
    ];
}

$query = new WP_Query($_args);

$count = 0;


if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();

        $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
        hx-swap="afterend"' : '';

        include component('coach-block');

        $count++;
    endwhile;
else :
?>
    <div class="w-75 mx-auto text-center">
        <img class="w-100 d-block mt-5 mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found-product.svg'; ?>" alt="">
        <p class="mb-2"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
        <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
            <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
        </a>
    </div>
<?php
endif;
?>