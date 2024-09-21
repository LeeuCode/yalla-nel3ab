<?php

global $post;

$post_id = get_post_meta($post->ID, 'post_id', true);

$basic_image = get_post_meta($post_id, 'basic_image', true);

$imageLink = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

if ($basic_image) {
    $imageLink = wp_get_attachment_url($basic_image);
}

$period = get_post_meta($post->ID, 'period', true);
$start_time = get_post_meta($post->ID, 'start_time', true);
$end_time = get_post_meta($post->ID, 'end_time', true);
$price = get_post_meta($post->ID, 'price', true);

?>

<div class="col-12">
    <div class="order p-3 mb-4 rounded-2 shadow-sm">
        <span
            class="badge <?php echo ($post->post_status == 'pending') ? 'bg-primary' : 'bg-success'; ?> mb-2 py-1 px-3 font-x-11">
            <?php echo ($post->post_status == 'pending') ? __('قيد التنفيذ', 'qeema') : __('اكتملت', 'qeema'); ?>
        </span>
        <div class="d-flex gap-2 mb-2">
            <div class="order-image">
                <img class="avater-md rounded-2 object-fit-cover" src="<?php echo $imageLink; ?>"
                    alt="">
            </div>
            <div class="w-100">
                <h6 class="mb-2 small">
                    <?php echo get_the_title($post_id); ?>
                </h6>
                <div class="d-flex justify-content-between small">
                    <p class="font-x-12 text-gray">
                        <span class="text-secondary fw-bold font-x-11">
                            <?php
                            if ($period == 'period_morning') {
                                echo __('الفترة الصباحية', 'qeema');
                            } else {
                                echo __('الفترة المسائية', 'qeema');
                            }
                            ?>:
                        </span>

                        <span class="text-dark bg-info py-1- px-2 rounded-1 font-x-11">
                            <?php echo get_post_meta($post->ID, $period, TRUE); ?>
                        </span>
                    </p>
                    <p class="font-x-12 text-gray">
                        <span class="mx-1">
                            <?php echo __('السعر', 'qeema'); ?>:
                        </span>
                        <span class="text-white bg-success px-2 rounded-1 font-x-11">
                            <?php echo $price; ?>ج.م
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>