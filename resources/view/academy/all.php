<?php

$link = site_url('academies/sections/');

require_once component('heading');

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo home_url(); ?>" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm"
                    placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <input type="hidden" name="post_type" value="product">

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="products-container row">
        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;
        $args = array(
            'post_type' => 'academy',
            'posts_per_page' => 4,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'section',
                    'field' => 'term_id',
                    'terms' => array($params['term_id'])
                )
            )
        );

        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()):
            while ($query->have_posts()):
                $query->the_post();

                $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';
        ?>
                <div class="col-12" <?php echo ($query->max_num_pages) ? $t : ''; ?>>
                    <div class="shadow-sm mb-3 position-relative">
                        <img class="img-fluid" src="<?php the_field('basic_image', $post->ID); ?>" alt="">
                        <div class="position-absolute bottom-0 start-0 p-3">
                            <h6 class="text-white mb-1">
                                <?php echo the_title(); ?>
                            </h6>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                                <div class="user-rate checked  small">
                                    <input type="radio" name="rate" value="5">
                                    <input type="radio" name="rate" value="4">
                                    <input type="radio" name="rate" value="3">
                                    <input type="radio" name="rate" value="2">
                                    <input type="radio" name="rate" value="1" checked="">
                                </div>
                            </div>
                        </div>
                        <a hx-get="<?php echo site_url('booking/academy/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top"
                            hx-trigger="click" hx-target=".app" class="z-index-2 stretched-link"></a>
                    </div>
                </div>
            <?php
                $count++;
            endwhile;
        else:
            ?>
            <div class="w-75 mx-auto text-center">
                <img class="w-100 d-block mb-3"
                    src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                    hx-target=".app" class="btn btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>
        <?php
        endif;
        ?>
    </div>
    <?php //lc_pagination($query, $paged); 
    ?>
</div>

<!-- status elements -->
<!-- <div class="scroller-status">
    <div class="infinite-scroll-request loader-ellips">
        ...
    </div>
    <p class="infinite-scroll-last text-center text-danger">End of content</p>
    <p class="infinite-scroll-error">No more pages to load</p>
</div> -->


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
        //     scrollThreshold: 200,
        //     status: '.scroller-status',
        //     history: true,
        // });
    });
</script>