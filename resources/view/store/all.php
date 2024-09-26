<?php

$link = site_url('home/');

require_once component('heading');
?>

<div class="container position-relative px-4 h-100vh">
    <div class="row justify-content-center">
        <div class="col-12">
            <form hx-get="<?php echo site_url('store/search/'); ?>" hx-target=".products-container" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <input type="hidden" name="post_type" value="product">

                <button type="submit" class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>

        <div class="col-12">
            <div class="position-relative mb-4">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/assets/images/store.jpg'; ?>" alt="">
                <!-- <img class="w-50 position-absolute top-50 start-50 translate-middle" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt=""> -->
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aligin-items-center justify-content-between mb-3">
                <h6 class="m-0 fw-bold small">
                    <?php echo __('العلامات التجاريه', 'qeema'); ?>
                </h6>

                <!-- <a href="#" class="text-danger fw-bold small">
                    <?php echo __('المزيد', 'qeema'); ?>
                </a> -->
            </div>
        </div>

        <div class="exercise-slider">
            <?php
            $brands = get_terms(array(
                'taxonomy'   => 'brand',
                'hide_empty' => false,
                'number'     => false,
            ));

            if (!empty($brands) && !is_wp_error($brands)) :
                foreach ($brands as $brand) :
            ?>
                    <div class="col-3- mx-2">
                        <div class="text-center mb-3 position-relative">
                            <img src="<?php echo the_field('image', 'brand_' . $brand->term_id); ?>" alt="" class="icon-lg shadow-sm rounded-circle mb-2">
                            <h6 class="font-x-12 fw-bold m-0"><?php echo $brand->name ?></h6>

                            <a hx-get="<?php echo site_url('products/' . $brand->term_id . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
                            <!-- hx-on::before-request="showLoad()" -->
                        </div>
                    </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>

    <div class="col-12">
        <div class="d-flex aligin-items-center justify-content-between mb-3">
            <h6 class="m-0 fw-bold small">
                <?php echo __('المنتجات', 'qeema'); ?>
            </h6>

            <a href="#" class="text-danger fw-bold small">
                <?php echo __('المزيد', 'qeema'); ?>
            </a>
        </div>
    </div>

    <div class="products-container row justify-content-center overflow-scroll">
        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;

        $args = array(
            'post_type' => 'store',
            'posts_per_page' => 4,
            'paged' => $paged
        );

        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                include component('product');

                $count++;
            endwhile;
        endif;
        ?>
    </div>

    <?php //lc_pagination($query); 
    ?>
</div>

<?php require_once component('footer-menu'); ?>

<script>
    jQuery(document).ready(function($) {
        'use strict';

        // $('.container').infiniteScroll({
        //     // options
        //     path: '.next',
        //     append: '.products-container',
        //     // elementScroll: true,
        //     hideNav: '.pagination',
        //     scrollThreshold: 500,
        //     status: '.scroller-status',
        //     // history: true,
        // });

        $('.exercise-slider').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            slidesToShow: 2,
            slidesToScroll: 1,
            rtl: true,
            // variableWidth: true,
            prevArrow: null, //"<button type='button' class='slick-prev slick-arrow'></button>",
            nextArrow: null, //"<button type='button' class='slick-next slick-arrow'></button>",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        // dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                }
            ]
        });
    });
</script>