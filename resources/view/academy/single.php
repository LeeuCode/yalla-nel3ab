<?php

$link = site_url('academies/sections/');

require_once component('heading');

$post_id = $params['id'];
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="position-relative my-3">
                <div class="main-slider mb-2">
                    <img class="img-fluid" src="<?php the_field('basic_image', $post_id); ?>" alt="">
                    <?php
                    $images = get_field('gallery', $post_id);
                    if ($images): ?>
                        <?php foreach ($images as $image): ?>
                            <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex align-items-center- gap-2">
                        <img src="<?php the_field('image_url', $post_id); ?>" alt="" class="icon-sm rounded-circle">
                        <div>
                            <h6 class="text-dark fw-bold font-x-12 mb-0">
                                <?php echo get_the_title($post_id); ?>
                            </h6>
                            <span class="text-secondary font-x-11 mb-0">
                                <?php echo get_first_term_by_id($post_id, 'name');; ?>
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
                            <input type="radio" name="rate" value="1" checked="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $content = get_field('content', $post_id);

        if ($content) :
        ?>
            <div class="col-12">
                <h6 class="fw-bold small mb-2"><?php echo __('الوصف', 'qeema'); ?></h6>
                <p class="mb-3 font-x-12 text-secondary"><?php echo $content; ?></p>
            </div>
        <?php endif; ?>

        <?php
        $address = get_field('address', $post_id);

        if ($address) :
        ?>
            <div class="col-12">
                <h6 class="fw-bold small mb-2"><?php echo __('عنوان الأكاديميه', 'qeema'); ?></h6>
                <p class="mb-3 font-x-12 text-secondary"><?php echo $address; ?></p>
            </div>
        <?php endif; ?>

        <?php
        $location = get_field('location', $post_id);

        if ($location):
        ?>
            <div class="col-12">
                <h6 class="fw-bold small my-3"><?php echo __('موقع الأكاديميه', 'qeema'); ?></h6>
                <iframe class="mb-2" src="<?php echo $location; ?>" width="100%" height="150" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        <?php endif; ?>

        <form hx-post="<?php echo site_url('booking/store/'); ?>" hx-swap="innerHTML" hx-on::before-request="showLoad()" hx-on::after-request="this.reset()" hx-target="#message" class="row">

            <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />
            <input name="post_id" type="hidden" value="<?php echo $post_id; ?>" />

            <div class="col-12">
                <h6 class="fw-bold small my-3"><?php echo __('نوع الاشتراك', 'qeema'); ?></h6>

                <select name="type" id="subscription_type" class="form-select">
                    <option value=""><?php echo __('اختار من انواع الاشتراكات', 'qeema'); ?></option>

                    <?php
                    if (have_rows('type', $post_id)):

                        $i = 0;
                        // Loop through rows.
                        while (have_rows('type', $post_id)):
                            the_row();
                    ?>
                            <option value="<?php the_sub_field('name', $post_id); ?>"
                                data-price-val="<?php the_sub_field('price', $post_id); ?>">
                                <?php the_sub_field('name', $post_id); ?>
                            </option>
                    <?php
                            $i++;
                        endwhile;
                    endif;
                    ?>
                </select>
            </div>

            <?php require_once component('periods'); ?>

            <div class="py-3 my-3"></div>

            <div
                class="bg-white shadow p-3 d-flex align-items-center justify-content-between position-fixed bottom-0 w-100">

                <input type="hidden" name="price" class="price" value="">

                <?php if (is_user_logged_in()) : ?>
                    <button type="submit" class="btn btn-danger rounded-2 w-50">
                        <?php echo __('حجز', 'qeema'); ?>
                    </button>
                <?php else: ?>
                    <a hx-get="<?php echo site_url('login/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click"
                        hx-target=".app" class="btn btn-secondary rounded-2 w-50">
                        <?php echo __('سجل دخول للحجز', 'qeema'); ?>
                    </a>
                <?php endif; ?>

                <p class="text-danger fw-bold mb-0"><span class="price"><?php echo 0; ?></span> ج.م</p>
                <?php //endif; 
                ?>
            </div>
        </form>
    </div>
</div>

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