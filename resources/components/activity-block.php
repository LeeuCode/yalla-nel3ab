<?php

$activity_cat = get_post_meta($post->ID, 'activity_cat', true);
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
                    <h6 class="small fw-bold mb-0"><?php echo get_term($activity_cat)->name; ?></h6>
                <?php endif; ?>

                <div class="d-flex team-container">
                    <?php

                    $profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';
                    $team_count = get_field('team_count', 'section_' . $activity_cat);
                    $plaiers_count = get_field('plaiers_count', 'section_' . $activity_cat);
                    $count = 0;

                    for ($i = 0; $i < $team_count; $i++) :
                        for ($c = 0; $c < 2; $c++) :
                            $imageuRL = get_post_meta($post->ID, 'team_' . $i . '_' . $c . '_img_link', true);
                    ?>
                            <img width="30" height="30" class="rounded-circle border" src="<?php echo ($imageuRL) ? get_attachment_link($imageuRL, 'full') : $profileImage; ?>" alt="">
                    <?php
                        endfor;
                    endfor;
                    ?>
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

                <a hx-get="<?php echo site_url('activity/single/' . $post->ID . '/'); ?>" hx-swap="innerHTML transition:true show:top" hx-target="closest .app" hx-trigger="click" hx-on::before-request="showLoad()" class="btn btn-sm font-x-12 btn-danger">
                    <?php echo __('طلب الانضمام', 'qeema'); ?>
                </a>
            </div>
        </div>
    </div>
</div>