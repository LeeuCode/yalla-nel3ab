<?php

$link = site_url('coachs/');

require_once component('heading');

$post_id = $params['id'];
?>

<div class="container">
    <form hx-post="<?php echo site_url('booking/store/'); ?>" hx-swap="innerHTML" hx-on::before-request="showLoad()" hx-on::after-request="this.reset()" hx-target="#message" class="row">

        <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />
        <input name="post_id" type="hidden" value="<?php echo $post_id; ?>" />

        <div class="col-12 mt-3">
            <div class="position-relative my-3">
                <?php
                $images = get_field('gallery', $post_id);
                if ($images): ?>
                    <div class="main-slider mb-2">
                        <!-- <img class="img-fluid" src="<?php the_field('basic_image', $post_id); ?>" alt=""> -->
                        <?php foreach ($images as $image): ?>
                            <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex w-100 justify-content-between">
                    <div class="d-flex align-items-center- gap-2">
                        <img src="<?php the_field('image_url', $post_id); ?>" alt="" class="avater-md rounded-circle">
                        <div>
                            <h6 class="text-dark fw-bold small mb-0">
                                <?php echo get_the_title($post_id); ?>
                            </h6>
                            <span class="text-secondary font-x-12 mb-0">
                                <?php echo get_first_term_by_id($post_id, 'section', 'name'); ?>
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

        <div class="col-12">
            <h6 class="small fw-bold"><?php echo __('نبذه عن المدرب', 'qeema'); ?></h6>
            <div class="text-secondary small">
                <?php echo get_field('about_us', $post_id) ?>
            </div>
        </div>

        <?php
        $location = get_field('location', $post_id);

        if ($location):
        ?>
            <div class="col-12">
                <h6 class="fw-bold small my-3"><?php echo __('موقع الاكاديمية', 'qeema'); ?></h6>
                <iframe class="mb-2" src="<?php echo $location; ?>" width="100%" height="150" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        <?php endif; ?>


        <div class="col-12">
            <h6 class="fw-bold small my-3"><?php echo __('التاريخ', 'qeema'); ?></h6>

            <div class="d-flex flex-row gap-2 overflow-x-scroll">
                <?php
                $days = 7;
                for ($i = 0; $i <= $days; $i++) {
                ?>

                    <div class="form-check p-0 small mb-2">
                        <input type="radio" class="form-check-input lc-check-box d-none" id="day-<?php echo $i; ?>" name="day" value="<?php echo date('d-m-Y', strtotime(date("d-m-Y") . ' +' . $i . ' day')); ?>" <?php echo ($id == 0) ? 'checked' : ''; ?>>
                        <label class="form-check-label lc-check-box-label text-center rounded-3 small" for="day-<?php echo $i; ?>">
                            <span class="h6 fw-bold d-block">
                                <?php echo date('d', strtotime(date("d-m-Y") . ' +' . $i . ' day')); ?>
                            </span>
                            <?php echo date('D', strtotime(date("d-m-Y") . ' +' . $i . ' day')); ?>
                        </label>
                    </div>

                <?php } ?>
            </div>
        </div>

        <?php require_once component('periods'); ?>

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

            <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />
            <input type="hidden" name="price" class="price" value="">

            <button type="submit" class="btn btn-danger rounded-2 w-50">
                <?php echo __('حجز', 'qeema'); ?>
            </button>

            <p class="text-danger fw-bold mb-0"><span class="price"><?php echo 0; ?></span> ج.م</p>
        </div>
    </form>
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