<?php

$terms = [];

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

$args = array(
    'post_type' => 'gym',
    'posts_per_page' => 4,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'OR',
        [
            'taxonomy' => 'city',
            'field' => 'term_id',
            'terms' => $terms
        ]

    )
);

$query = new WP_Query($args);

$count = 0;

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();


        include component('gym-block');

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