<?php

$link = site_url('academies/sections/');

require_once component('heading');

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form hx-get="<?php echo site_url('academies/search/' . $params['term_id'] . '/'); ?>" hx-target=".products-container" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm"
                    placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <!-- <input type="hidden" name="post_type" value="product"> -->

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

                include component('academy-block');

                $count++;
            endwhile;
        else:
        ?>
            <div class="w-75 mx-auto text-center">
                <img class="w-100 d-block mb-3"
                    src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" hx-trigger="click"
                     class="btn btn-danger px-5">
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