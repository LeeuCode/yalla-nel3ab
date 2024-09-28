<?php
$post_id = $params['id'];

$sectionID = get_first_term_by_id($post_id, 'section');

$link = site_url('playgrounds/' . $sectionID . '/');

require_once component('heading');

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
                            <input type="radio" name="rate" value="1">
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
                <h6 class="fw-bold small mb-2"><?php echo __('عنوان الملعب', 'qeema'); ?></h6>
                <p class="mb-3 font-x-12 text-secondary"><?php echo $address; ?></p>
            </div>
        <?php endif; ?>

        <?php
        $location = get_field('location', $post_id);

        if ($location) :
        ?>
            <div class="col-12">
                <h6 class="fw-bold small mb-3"><?php echo __('موقع الملعب', 'qeema'); ?></h6>
                <iframe class="mb-2" src="<?php echo $location; ?>" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        <?php endif; ?>
    </div>

    <form hx-post="<?php echo site_url('booking/store/'); ?>" hx-swap="innerHTML" hx-on::before-request="showLoad()" hx-on::after-request="this.reset()" hx-target="#message" class="row">

        <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />
        <input name="post_id" type="hidden" value="<?php echo $post_id; ?>" />

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

        <div class="py-3 my-3"></div>

        <div class="bg-white shadow p-3 d-flex align-items-center justify-content-between position-fixed bottom-0 w-100">
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

            <span class="text-danger fw-bold"><span class="price"><?php echo 0; ?></span> ج.م</span>
            <input type="hidden" name="price" class="set-price">
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