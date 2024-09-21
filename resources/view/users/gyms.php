<?php

$link = site_url('user/account/');

require_once component('heading');
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo home_url(); ?>" method="GET" class="search-bar my-4">
                <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

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

    <div id="posts-data" class="products-container row">
        <?php
        $paged = ($params['num']) ?  $params['num'] : 1;

        $user = wp_get_current_user();

        $args = array(
            'post_type' => 'gym',
            'posts_per_page' => -1,
            'meta_key' => 'user_id',
            'meta_value' => $user->ID
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
                    <div class="mb-3 position-relative shadow p-3 rounded-2">
                        <img class="img-fluid mb-2 rounded-2" src="<?php the_field('basic_image'); ?>" alt="">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center- gap-2">
                                <img src="<?php the_field('image_url'); ?>" alt="" class="icon-sm rounded-circle">
                                <div>
                                    <h6 class="text-dark fw-bold font-x-12 mb-0">
                                        <?php the_title(); ?>
                                    </h6>
                                    <span class="text-secondary font-x-11 mb-0">
                                        <?php echo get_first_term_by_id($post->ID, 'section', 'name'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-3">
                            <a hx-get="<?php echo site_url('user/gym/edit/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger">
                                <?php echo __('تعديل', 'qeema'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
                // endif;
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

<?php require_once component('footer-menu'); ?>