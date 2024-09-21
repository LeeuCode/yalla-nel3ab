<?php

$activity_cat = get_post_meta($post->ID, 'term_id', true);
$start_date = get_post_meta($post->ID, 'start_date', true);
$start_time = get_post_meta($post->ID, 'start_time', true);
$end_time = get_post_meta($post->ID, 'end_time', true);
?>

<div class="col-12">
    <div class="d-flex gap-2 p-3 mb-3 rounded-2 bg-white border shadow-sm">
        <img class="icon-md" src="<?php the_field('icon', 'section_' . $activity_cat); ?>" alt="">
        <div class="flex-grow-1">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <?php if ($activity_cat) : ?>
                    <h6 class="font-x-12 fw-bold mb-0"><?php echo get_the_title($post->ID); ?></h6>
                <?php endif; ?>

                <div class="text-danger small fw-bold">
                    <?php echo get_post_meta($post->ID, 'price', true); ?>ج.م
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="d-block text-secondary font-x-11 fw-bold mb-2">
                        <?php
                        $start = date('h:i a', strtotime($start_time));
                        $end = date('h:i a', strtotime($end_time));

                        echo sprintf(__('من %s الي %s', 'qeama'), $start, $end);
                        ?>
                    </span>
                    <span class="d-block text-secondary font-x-11 fw-bold"><?php echo __('تاريخ البدأ', 'qeema') . ': ' . $start_date; ?></span>
                </div>

                <a hx-get="<?php echo site_url('champion/' . $post->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-sm font-x-12 btn-danger">
                    <?php echo __('أشترك الأن', 'qeema'); ?>
                </a>
            </div>
        </div>
    </div>
</div>