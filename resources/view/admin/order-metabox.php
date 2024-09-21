<?php
global $post;

$post_id = get_post_meta($post->ID, 'post_id', true);
$price = get_post_meta($post->ID, 'price', true);
$size = get_post_meta($post->ID, 'size', true);
$color = get_post_meta($post->ID, 'color', true);
$getPrice = get_post_meta($post->ID, 'getPrice', true);
$qt = get_post_meta($post->ID, 'qt', true);
$total = get_post_meta($post->ID, 'total', true);

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

    <table class="table table-light table-striped table-hover my-3">
        <thead>
            <tr>
                <th><?php echo __('المنتج', 'qeema'); ?></th>
                <th><?php echo __('السعر', 'qeema'); ?></th>
                <th><?php echo __('الكمية', 'qeema'); ?></th>
                <th><?php echo __('المجموع', 'qeema'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="align-middle">
                    <div class="d-flex gap-2">
                        <img width="80" class="border border-light shadow rounded-1" src="<?php echo get_the_post_thumbnail_url($post_id, 'full'); ?>" alt="">
                        <div>
                            <h6 class="small fw-bold mb-3"><?php echo get_the_title($post_id); ?></h6>
                            <div class="d-flex gap-2">
                                <?php if ($size) : ?>
                                    <p class="small">
                                        <span class="text-secondary fw-bold"><?php echo __('الحجم', 'qeema'); ?></span>:
                                        <span class="bg-primary text-white py-1- px-3 rounded-1 fw-bold small"><?php echo $size; ?></span>
                                    </p>
                                <?php endif; ?>

                                <?php if ($color) : ?>
                                    <p class="small">
                                        <span class="text-secondary fw-bold"><?php echo __('اللون', 'qeema'); ?></span>:
                                        <span class="bg-success text-white py-1- px-3 rounded-1 fw-bold small"><?php echo $color; ?></span>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="align-middle">
                    <span class="bg-info text-dark py-1- px-3 rounded-1 fw-bold small-"><?php echo $getPrice; ?>ج.م</span>
                </td>

                <td class="align-middle">
                    <span class="bg-dark text-white py-1- px-3 rounded-1 fw-bold small-"><?php echo $qt; ?></span>
                </td>

                <td class="align-middle">
                    <span class="bg-success text-white py-1- px-3 rounded-1 fw-bold small-"><?php echo $total; ?>ج.م</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>