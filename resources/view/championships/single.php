<?php

$link = site_url('championships/');

require_once component('heading');

$post_id = $params['id'];
?>

<div class="container pt-4 position-relative">
    <div class="row">

        <?php
        $term_id = get_post_meta($post_id, 'term_id', true);
        $start_date = get_post_meta($post_id, 'start_date', true);
        $start_time = get_post_meta($post_id, 'start_time', true);
        $end_time = get_post_meta($post_id, 'end_time', true);
        $playground_id = get_post_meta($post_id, 'playground', true);

        $city = get_the_terms($playground_id, 'city');
        $city_string = join(', ', wp_list_pluck($city, 'name'));
        ?>

        <div class="col-12">
            <div class="d-flex gap-2 p-3 mb-4 rounded-2 bg-white border shadow-sm">
                <img class="icon-md" src="<?php the_field('icon', 'section_' . $term_id); ?>" alt="">
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <?php if ($term_id) : ?>
                                <h6 class="small fw-bold mb-1"><?php echo get_the_title($post_id); ?></h6>
                            <?php endif; ?>
                            <span class="badge bg-danger px-3 font-x-11">
                                <!-- <?php echo __('مغلق', 'qeema'); ?> -->
                                <?php echo get_term($term_id)->name; ?>
                            </span>
                        </div>

                        <div class="text-danger small fw-bold">
                            <?php echo get_post_meta($post_id, 'price', true); ?>ج.م
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('بيانات الملعب', 'qeema'); ?></h6>
            <div class="rounded-2 bg-white border shadow-sm p-3 mb-4">
                <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                    <div>
                        <h6 class="small mb-1"><?php echo __('أسم الملعب', 'qeema'); ?></h6>
                        <span class="d-inline-block fw-bold font-x-11"><?php echo get_the_title($playground_id); ?></span>
                    </div>

                    <div>
                        <h6 class="small mb-1"><?php echo __('مكان الملعب', 'qeema'); ?></h6>
                        <span class="d-inline-block fw-bold font-x-11"><?php echo $city_string; ?></span>
                    </div>
                </div>

                <h6 class="small mb-2"><?php echo __('صور من الملعب', 'qeema'); ?></h6>
                <div class="main-slider mb-2">
                    <img class="img-fluid" src="<?php the_field('basic_image', $playground_id); ?>" alt="">
                    <?php
                    $images = get_field('gallery', $playground_id);
                    if ($images): ?>
                        <?php foreach ($images as $image): ?>
                            <img class="img-fluid" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('معاد البطوله', 'qeema'); ?></h6>
            <div class="d-flex flex-wrap align-items-center justify-content-between  rounded-2 bg-white border shadow-sm p-3 mb-4">
                <div class="w-100 mb-2">
                    <span class="small mb-1"><?php echo __('تاريخ  البدأ', 'qeema'); ?>:</span>
                    <span class="badge bg-primary font-x-11"><?php echo get_field('start_date', $post_id); ?></span>
                </div>

                <?php

                $start = date('h:i a', strtotime($start_time));
                $end = date('h:i a', strtotime($end_time));

                ?>
                <div class="w-50">
                    <span class="small mb-1"><?php echo __('وقت البدأ', 'qeema'); ?>:</span>
                    <span class="badge bg-success font-x-11"><?php echo $start; ?></span>
                </div>

                <div class="w-50">
                    <span class="small mb-1"><?php echo __('وقت الانتهاء', 'qeema'); ?>:</span>
                    <span class="badge bg-danger font-x-11"><?php echo $end; ?></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('بيانات فرق البطوله', 'qeema'); ?></h6>
            <div class="d-flex flex-wrap align-items-center justify-content-between  rounded-2 bg-white border shadow-sm p-3 mb-4">
                <div class="w-50">
                    <span class="small mb-1"><?php echo __('عدد الفرق المطلوبه', 'qeema'); ?>:</span>
                    <span class="badge bg-primary font-x-11"><?php echo get_post_meta($post_id, 'team_count', true); ?></span>
                </div>

                <div class="w-50">
                    <span class="small mb-1"><?php echo __('الفرق المشاركه', 'qeema'); ?>:</span>
                    <span class="badge bg-danger font-x-11"><?php echo '1'; ?></span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <h6 class="fw-bold small mb-2"><?php echo __('الفرق المشاركه', 'qeema'); ?></h6>
        </div>

        <?php
        $args = array(
            'post_type' => 'booking_champion',
            'posts_per_page' => -1,
            'meta_key' => 'post_id',
            'meta_value' => $post_id
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                $team_avatar = get_post_meta($post->ID, 'team_avatar', true);
        ?>

                <div class="col-6">
                    <div class="rounded-2 bg-white border shadow-sm p-2 mb-3 text-center">
                        <img width="100px" height="100" src="<?php echo wp_get_attachment_image_url($team_avatar, 'full'); ?>" alt="" class="rounded-circle mb-2">
                        <h6 class="mb-0 font-x-12">
                            <?php the_title(); ?>
                        </h6>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            wp_reset_query();
        else :
            ?>


        <?php endif; ?>

        <div class="col-12">
            <h6 class="fw-bold small my-2"><?php echo __('انضم إلي البطوله', 'qeema'); ?></h6>

            <div class="mb-3 d-grid">
                <?php
                $args = array(
                    'post_type' => 'booking_champion',
                    'posts_per_page' => -1,
                    'post_author' => $user->ID,
                    'meta_key' => 'post_id',
                    'meta_value' => $post_id
                );

                $query = new WP_Query($args);

                // var_dump($query->found_posts);

                if ($query->found_posts > 0) : ?>
                    <span class="btn btn-sm btn-secondary">
                        <?php echo __('تم الانضمام إلي البطوله', 'qeema'); ?>
                    </span>
                <?php else: ?>
                    <button class="btn btn-sm btn-danger create-champion">
                        <?php echo __('انضم الان', 'qeema'); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once component('footer-menu'); ?>

<?php if (is_user_logged_in()) : ?>
    <form id="add-champ" onsubmit="closeForm()" hx-post="<?php echo site_url('champion/store/' . $post_id . '/'); ?>" hx-swap="innerHtml"
        --hx-on::after-request="closeForm()" hx-target="#message" enctype="multipart/form-data">

        <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />

        <?php include component('add-champion'); ?>
    </form>
<?php endif; ?>

<script>
    jQuery(document).ready(function($) {
        'use strict';

        $(document).on('click', '.create-champion', function() {
            $('.add-champ').addClass('active');
        });

        $(document).on('click', '.close-activity', function(e) {
            e.preventDefault();

            $('.add-champ').removeClass('active');
        });

        $('.upload-preview-image').on('change', function() {
            if (this.files[0]) {
                var reader = new FileReader();
                var image = $(this).prev('img');

                reader.readAsDataURL(this.files[0]);

                reader.onloadend = function() {
                    image.attr('src', reader.result);
                };
            }
        });

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

    function closeForm() {
        jQuery('.add-champ').removeClass('active');
        this.reset();
    }
</script>