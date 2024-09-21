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

$args = array(
    'post_type' => 'coach',
    'tax_query' => array(
        'relation' => 'AND',
        [
            'taxonomy' => 'city',
            'field' => 'term_id',
            'terms' => $terms
        ]
    )
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();


?>

        <div class="col-12">
            <div class="mb-4 position-relative">
                <!-- <img class="img-fluid mb-2"
                    src="<?php echo get_template_directory_uri() . '/assets/images/bg-01.png'; ?>" alt=""> -->
                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <img src="<?php the_field('image_url'); ?>" alt="" class="avater-md rounded-circle">
                        <div>
                            <h6 class="text-dark fw-bold font-x-12 mb-0">
                                <?php the_title(); ?>
                            </h6>
                            <span class="text-secondary font-x-11 mb-0">
                                <?php echo get_first_term_by_id($post->ID, 'section', 'name'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <!-- <span class="text-white small"><?php echo __('تقييم المدرب', 'qeema'); ?></span> -->
                        <div class="user-rate checked small">
                            <input type="radio" name="rate" value="5">
                            <input type="radio" name="rate" value="4">
                            <input type="radio" name="rate" value="3">
                            <input type="radio" name="rate" value="2">
                            <input type="radio" name="rate" value="1" checked="">
                        </div>
                    </div>
                </div>
                <a hx-get="<?php echo site_url('coach/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
            </div>
        </div>

    <?php
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