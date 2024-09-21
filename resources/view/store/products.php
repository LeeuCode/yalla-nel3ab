<?php

$link = site_url('store/');

require_once component('heading');
?>

<div class="container position-relative px-4 h-100vh">
    <div class="row justify-content-center">
        <div class="col-12">
            <form action="<?php echo home_url(); ?>" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <input type="hidden" name="post_type" value="product">

                <button class="btn btn-search-bar">
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
                    <?php echo __('المنتجات', 'qeema'); ?>
                </h6>

                <!-- <a href="#" class="text-danger fw-bold small">
                    <?php echo __('المزيد', 'qeema'); ?>
                </a> -->
            </div>
        </div>

        <?php
        $args = array(
            'post_type' => 'store',
            'tax_query' => array(
                array(
                    'taxonomy' => 'brand',
                    'field' => 'term_id',
                    'terms' => array($params['term_id'])
                )
            )
        );

        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                include component('product');

                $count++;
            endwhile;
        else :
        ?>
            <div class="w-75 mx-auto text-center">
                <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found-product.svg'; ?>" alt="">
                <p class="mb-2 small"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-sm btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>

<?php require_once component('footer-menu'); ?>