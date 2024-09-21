<?php
global $post;

$activity_cat = get_post_meta($post->ID, 'activity_cat', true);
$start_date = get_post_meta($post->ID, 'start_date', true);
$start_time = get_post_meta($post->ID, 'start_time', true);
$end_time = get_post_meta($post->ID, 'end_time', true);

$user = get_user_by('id', $post->post_author);

$userPhoneNumber = get_user_meta($user->ID, 'phonenumber', true);

?>

<div class="d-flex flex-wrap gap-3-">

    <?php if (isset($user->ID)) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('اسم مقدم الطلب', 'qeema'); ?>:
                </span>
                <span class="text-white bg-dark py-1 px-3 rounded-1">
                    <?php echo $user->first_name . ' ' . $user->last_name; ?>
                </span>
            </div>
        </div>

        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('البريد الالكتروني لمقدم الطلب', 'qeema'); ?>:
                </span>
                <span class="text-white bg-secondary py-1 px-3 rounded-1">
                    <?php echo $user->user_email; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($userPhoneNumber) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('رقم الهاتف', 'qeema'); ?>:
                </span>
                <span class="text-dark bg-info py-1 px-3 rounded-1">
                    <?php echo $userPhoneNumber; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($activity_cat) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center  justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('نوع النشاط', 'qeema'); ?>:
                </span>
                <span class="text-white bg-primary py-1 px-3 rounded-1">
                    <?php echo get_term($activity_cat)->name; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($start_date) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('تاريخ البداء', 'qeema'); ?>:
                </span>
                <span class="badge bg-warning py-1 px-3 rounded-1">
                    <?php echo $start_date; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($start_time) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('وقت البداء', 'qeema'); ?>:
                </span>
                <span class="badge bg-success text-white py-1 px-3 rounded-1">
                    <?php echo date('h:i a', strtotime($start_time)); ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($end_time) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('وقت الانتهاء', 'qeema'); ?>:
                </span>
                <span class="badge bg-danger text-white py-1 px-3 rounded-1">
                    <?php echo date('h:i a', strtotime($end_time)); ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php

    $profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';
    $team_count = get_field('team_count', 'section_' . $activity_cat);
    $plaiers_count = get_field('plaiers_count', 'section_' . $activity_cat);

    for ($i = 0; $i < $team_count; $i++) :
    ?>

        <div class="w-100 mb-4">
            <label class="d-block mb-3 fw-bold" for="end_date"><?php echo __('الفريق', 'qeema') . ' ' . ($i + 1); ?></label>
            <div class="d-flex gap-2">
                <?php
                for ($c = 0; $c < $plaiers_count; $c++) :
                    $imageuRL = get_post_meta($post->ID, 'team_' . $i . '_' . $c . '_img_link', true);
                ?>
                    <div class="team-image position-relative">
                        <img width="55" height="55" class="rounded-circle shadow-sm" src="<?php echo ($imageuRL) ? get_attachment_link($imageuRL, 'full') : $profileImage; ?>" alt="">
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    <?php endfor; ?>
</div>