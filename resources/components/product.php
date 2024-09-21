<?php

$price = get_post_meta($post->ID, 'price', true);
$discount = get_post_meta($post->ID, 'discount', true);

$t = ($count == 3) ? 'hx-get="' . get_next_posts_page_link($query->max_num_pages) . '" hx-trigger="revealed"
                    hx-swap="afterend"' : '';

?>

<div class="product col-6" <?php echo (get_next_posts_page_link($query->max_num_pages)) ? $t : ''; ?>>
    <div class="p-2 rounded-2 shadow-sm mb-3">
        <div class="mb-2">
            <img src="<?php the_post_thumbnail_url('full') ?>" alt="" class="img-fluid rounded-2">
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <span class="text-secondary font-x-11"><?php echo get_first_term_by_id($post->ID, 'brand', 'name'); ?></span>
            <div>
                <?php if ($discount) : ?>
                    <span class="fw-bold font-x-12">
                        <?php echo $discount; ?>ج.م
                    </span>
                    <span class="text-decoration-line-through text-secondary font-x-11">
                        <?php echo $price; ?>ج.م
                    </span>
                <?php else : ?>
                    <span class="fw-bold font-x-12">
                        <?php echo $price; ?>ج.م
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <h6 class="mb-2">
            <a hx-get="<?php echo site_url('product/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="text-dark font-x-11 fw-bold">
                <?php the_title(); ?>
            </a>
        </h6>
        <div class="d-flex gap-2">
            <a hx-get="<?php echo site_url('product/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-sm btn-danger flex-grow-1 ">
                <?php echo __('شراء الأن', 'qeema'); ?>
            </a>
            <a href="" class="btn btn-sm btn-light">
                <i class="fa-solid fa-cart-plus text-danger"></i>
            </a>
        </div>
    </div>
</div>