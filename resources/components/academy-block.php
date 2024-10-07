<?php
$user_id = get_current_user_id();
$favorite_post = user_count_meta($user_id, 'favorite_post', $post->ID);
?>

<div class="col-12" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
    <div class="shadow-sm mb-3 position-relative">
        <div class="position-relative">
            <img class="img-fluid mb-2 " src="<?php the_field('basic_image'); ?>" alt="">

            <a hx-post="<?php echo site_url('action/favorite/' . $post->ID . '/'); ?>" hx-trigger="click" hx-swap="innerHTML" class="faveorite-btn icon-sm rounded-circle position-absolute z-index-2" role="button">
                <i class="<?php echo ($favorite_post > 0) ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i>
            </a>
        </div>
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
        <a hx-get="<?php echo site_url('booking/academy/' . $post->ID . '/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app"
            hx-trigger="click" class="z-index-2 stretched-link"></a>
    </div>
</div>