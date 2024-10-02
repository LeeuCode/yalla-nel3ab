<?php

$link = site_url('home/');

require_once component('heading');

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form hx-get="<?php echo site_url('gyms/search/'); ?>" hx-target="#posts-data" method="GET" class="search-bar my-4">
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
        'post-type' => 'gym',
        'url' => site_url('city/gyms/')
    ));
    ?>

    <div id="posts-data" class="products-container row">
        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;

        $args = array(
            'post_type' => 'gym',
            'posts_per_page' => 4,
            'paged' => $paged,
        );

        $query = new WP_Query($args);

        $count = 0;

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                $t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';
        ?>
                <div class="col-12" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
                    <div class="shadow-sm mb-3 position-relative rounded-2">
                        <img class="img-fluid rounded-2" src="<?php the_field('basic_image', $post->ID); ?>" alt="">
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
                                    <input type="radio" name="rate" value="1">
                                </div>
                            </div>
                        </div>
                        <a hx-get="<?php echo site_url('gym/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
                    </div>
                </div>
            <?php
                $count++;
            endwhile;
        else :
            ?>
            <div class="w-75 mx-auto text-center">
                <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/not-found.svg'; ?>" alt="">
                <p class="mb-2"><?php echo __('لا يوجد اي بيانات حتي الان', 'qeema'); ?></p>
                <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
                    <?php echo __('العوده الي الرئيسيه', 'qeema'); ?>
                </a>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>

<!-- status elements -->

<?php require_once component('footer-menu'); ?>

<script>
    jQuery(document).ready(function($) {
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

        // $('.post-ajax').on('submit', function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         type: "GET",
        //         url: '<?php echo site_url('city/gyms/') ?>',
        //         data: $(this).serialize(),
        //         success: function(data) {
        //             $('#posts-data').html(data)
        //         }
        //     })
        // });

    });
</script>