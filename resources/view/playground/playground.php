<?php

$link = site_url('reserve-playgrounds/');

require_once component('heading');
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form hx-get="<?php echo site_url('playgrounds/search/' . $params['id'] . '/'); ?>" hx-target=".products-container" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <button class="btn btn-search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    <?php
    get_template_part(PATH_COMPONENT . '/cities-filter', null, array(
        'post-type' => 'playground',
        'url' => site_url('city/playground/' . $params['id'] . '/'),
        'section_id' => $params['term_id']
    ));
    ?>

    <div id="posts-data" class="products-container row">
        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;

        $args = array(
            'post_type' => 'playground',
            'posts_per_page' => 4,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'section',
                    'field' => 'term_id',
                    'terms' => array($params['id'])
                )
            )
        );
        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';

                include component('playground-block');

                // endif;
                $count++;
            endwhile;
        else :
        ?>
            <div class="w-75 mx-auto text-center">
                <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" hx-trigger="click" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>
        <?php
        endif;
        ?>
    </div>
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
        //     scrollThreshold: 200,
        //     status: '.scroller-status',
        //     history: true,
        // });

        $('.city-select').on('change', function() {
            var term_id = this.value;
            $.get('<?php echo site_url('get/cities/') ?>' + term_id + '/', function(data) {
                $('.cities-child').html(data);
            });
        });
    });
</script>