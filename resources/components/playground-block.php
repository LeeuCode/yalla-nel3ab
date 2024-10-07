<?php
$user_id = get_current_user_id();
$favorite_post = user_count_meta($user_id, 'favorite_post', $post->ID);
?>

<div class="col-12" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
    <div class="mb-3 ">
        <div class="position-relative">
            <img class="img-fluid mb-2 " src="<?php the_field('basic_image'); ?>" alt="">

            <a hx-post="<?php echo site_url('action/favorite/' . $post->ID . '/'); ?>" hx-trigger="click" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" class="faveorite-btn icon-sm rounded-circle position-absolute top-0 end-0" role="button">
                <i class="<?php echo ($favorite_post > 0) ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i>
            </a>
        </div>

        <div class="d-flex w-100 justify-content-between position-relative">
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
            <div class="d-flex gap-2 align-items-center">
                <span class="text-white small"><?php echo __('تقييم الخدمة', 'qeema'); ?></span>
                <div class="user-rate checked small">
                    <input type="radio" name="rate" value="5">
                    <input type="radio" name="rate" value="4">
                    <input type="radio" name="rate" value="3">
                    <input type="radio" name="rate" value="2">
                    <input type="radio" name="rate" value="1" >
                </div>
            </div>
            <a hx-get="<?php echo site_url('playground/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" hx-trigger="click" hx-on::before-request="showLoad()" class="z-index-2 stretched-link"></a>
        </div>
    </div>
</div>