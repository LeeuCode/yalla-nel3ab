<?php

$link = site_url('store/');

require_once component('heading');

$post_id = esc_sql($params['id']);

$price = get_post_meta($post_id, 'price', true);
$discount = get_post_meta($post_id, 'discount', true);
?>

<form hx-post="<?php echo site_url('checkout/'); ?>" hx-swap="innerHTML" hx-on::before-request="showLoad()" hx-on::after-request="this.reset()" hx-target="#message">

    <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />
    <input name="post_id" type="hidden" value="<?php echo $post_id; ?>" />

    <div class="container position-relative px-4 h-100vh">
        <div class="row">
            <div class="col-9 mt-3 mx-auto">
                <div class="main-slider mb-2">
                    <img class="img-fluid" src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="">
                    <?php
                    $images = get_field('gallery', $post_id);
                    if ($images): ?>
                        <?php foreach ($images as $image): ?>
                            <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-12">
                <span class="text-secondary font-x-11"><?php echo get_first_term_by_id($post_id, 'brand', 'name'); ?></span>
                <h6 class="mb-2">
                    <?php echo get_the_title($post_id); ?>
                </h6>
                <div>
                    <?php if ($discount) : ?>
                        <span class="fw-bold fs-5">
                            <?php echo $discount; ?>ج.م
                        </span>
                        <span class="text-decoration-line-through text-secondary font-x-12">
                            <?php echo $price; ?>ج.م
                        </span>
                    <?php else : ?>
                        <span class="text-decoration-line-through text-secondary font-x-12">
                            <?php echo $price; ?>ج.م
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between pb-3 mt-3 border-bottom">
                <span class="fw-bold"><?php echo __('الكمية', 'qeema'); ?></span>
                <div class="col-3">
                    <input type="number" class="form-control" name="qt" id="" min="1" max="15" value="1">
                </div>
                <span class="font-x-12 text-secondary">
                    <?php echo __('عدد المخزون', 'qeema'); ?>:
                    <strong>
                        <?php
                        $stock = get_post_meta($post_id, 'stock', true);

                        echo ($stock) ? $stock : 0;
                        ?>
                    </strong>
                </span>
            </div>

            <?php
            $colors = get_the_terms($post_id, 'color');

            if ($colors) :
            ?>
                <div class="pt-3">
                    <p class="fw-bold mb-3"><?php echo __('اللون', 'qeema'); ?></p>
                    <ul class="nav gap-1">

                        <?php foreach ($colors as $key => $color) : ?>
                            <div class="form-check p-0 small mb-3">
                                <input type="radio" class="form-check-input lc-check-box lc-check-border d-none" id="color-<?php echo $key; ?>" name="color" value="<?php echo $color->name; ?>">
                                <label class="form-check-label lc-check-box-label  p-0" style="background-color: <?php the_field('color', 'color_' . $color->term_id); ?>;width:25px;height:25px;border-radius:50%;" for="color-<?php echo $key; ?>">
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="pt-3">
                <p class="fw-bold mb-3"><?php echo __('المقاس', 'qeema'); ?></p>
                <div class="d-flex gap-2">
                    <?php
                    $sizes = get_the_terms($post_id, 'size');

                    if ($sizes) :
                        foreach ($sizes as $key => $size) : ?>
                            <div class="form-check p-0 small mb-3">
                                <input type="radio" class="form-check-input lc-check-box d-none" id="size-<?php echo $key; ?>" name="size" value="<?php echo $size->name; ?>">
                                <label class="form-check-label lc-check-box-label px-4 py-2" for="size-<?php echo $key; ?>">
                                    <?php echo $size->name; ?>
                                </label>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <div class="py-3">
                <p class="fw-bold mb-2"><?php echo __('وصف المنتج', 'qeema'); ?></p>
                <div class="text-secondary small">
                    <?php the_field('description', $post_id); ?>
                </div>
            </div>

            <div class="py-5"></div>
        </div>
    </div>
    <div class="d-grid w-100 bg-white border-top position-fixed bottom-0 p-3 shadow-sm">
        <?php if (is_user_logged_in()) : ?>
            <button class="btn btn-danger py-2" type="submit">
                <?php echo __('دفع', 'qeema'); ?>
            </button>
        <?php else: ?>
            <a hx-get="<?php echo site_url('login/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                hx-target=".app" class="btn btn-secondary rounded-2-">
                <?php echo __('سجل دخول لأكمال الشراء', 'qeema'); ?>
            </a>
        <?php endif; ?>
    </div>
</form>

<script>
    jQuery(document).ready(function($) {
        'use strict';
        $('.main-slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: true,
            prevArrow: null, //"<button type='button' class='slick-prev slick-arrow'></button>",
            nextArrow: null, //"<button type='button' class='slick-next slick-arrow'></button>",
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        // dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    });
</script>