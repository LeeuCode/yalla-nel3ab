<?php
global $post;

$post_id = get_post_meta($post->ID, 'post_id', true);
$day = get_post_meta($post->ID, 'day', true);
$period = get_post_meta($post->ID, 'period', true);
$price = get_post_meta($post->ID, 'price', true);

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

    <div class="w-50">
        <div class="d-flex align-items-center  justify-content-between gap-1 p-2">
            <span class="fw-bold">
                <?php echo __('نوع الحجز', 'qeema'); ?>:
            </span>
            <span class="text-white bg-primary py-1 px-3 rounded-1">
                <?php echo get_post_type_object(get_post_type($post_id))->labels->name; //get_the_title($post_id); 
                ?>
            </span>
        </div>
    </div>

    <div class="w-50">
        <div class="d-flex align-items-center  justify-content-between gap-1 p-2">
            <span class="fw-bold">
                <?php echo __('الحجز', 'qeema'); ?>:
            </span>
            <span class="text-white- bg-warning py-1 px-3 rounded-1">
                <?php echo get_the_title($post_id); ?>
            </span>
        </div>
    </div>

    <?php if ($day) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('اليوم', 'qeema'); ?>:
                </span>
                <span class="text-dark bg-info py-1 px-3 rounded-1">
                    <?php echo $day; ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($period) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php
                    if ($period == 'period_morning') {
                        echo __('الفترة الصباحية', 'qeema');
                    } else {
                        echo __('الفترة المسائية', 'qeema');
                    }
                    ?>:
                </span>
                <span class="text-dark bg-info py-1 px-3 rounded-1">
                    <?php echo get_post_meta($post->ID, $period, TRUE); ?>
                </span>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($price) : ?>
        <div class="w-50">
            <div class="d-flex align-items-center justify-content-between gap-1 p-2">
                <span class="fw-bold">
                    <?php echo __('السعر', 'qeema'); ?>:
                </span>
                <span class="text-white bg-success py-1 px-3 rounded-1">
                    <?php echo $price; ?>ج.م
                </span>
            </div>
        </div>
    <?php endif; ?>
</div>