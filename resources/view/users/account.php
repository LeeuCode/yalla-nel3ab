<?php

// get_header('global');

// Get current user.
$user = wp_get_current_user();

$logoID = get_user_meta($user->ID, 'profile_image', true);
$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

if ($logoID) {
    $profileImage = wp_get_attachment_url($logoID);
}

?>

<div class="load-spinner hide d-flex align-items-center justify-content-center">
    <div class="text-center p-3 bg-white rounded-2">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="d-block font-x-12 mt-2"><?php echo __('جاري التحميل', 'qeema'); ?>.....</span>
    </div>
</div>

<div class="header">
    <div class="header-box flex-wrap justify-content-between px-3 py-4 h-auto" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">

        <a hx-get="<?php echo site_url('home/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-sm btn-outline-light  border-color-selver border-color-selver">
            <i class="fa-solid fa-chevron-right"></i>
        </a>

        <img class="w-25" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">

        <a hx-get="<?php echo site_url('notifications/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="icon-sm fs-5 bg-white- rounded-pill d-flex align-items-center justify-content-center  position-relative">
            <i class="fa-solid fa-bell text-white"></i>

            <?php
            $notify = get_user_meta($user->ID, 'notify', true);

            if ($notify) :
            ?>
                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border- border-warning- rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            <?php endif; ?>
        </a>

        <div class="d-flex justify-content-center mt-4 w-100">
            <div class="thumb">
                <img class="rounded-3 shadow-sm" src="<?php echo $profileImage; ?>" alt="<?php echo $user->first_name; ?>">
            </div>
        </div>
    </div>
</div>

<div class="container position-relative py-4 h-65vh-" style="height: 67vh;">
    <div class="row justify-content-center">
        <div class="col-12">
            <a hx-get="<?php echo site_url('edit/user/' . $user->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-regular fa-circle-user fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('تعديل الحساب', 'qeema'); ?></span>
            </a>
        </div>

        <div class="col-12">
            <a hx-get="<?php echo site_url('edit/user/' . $user->ID . '/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-solid fa-cubes fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('الطلبات', 'qeema'); ?></span>
            </a>
        </div>

        <div class="col-12">
            <a hx-get="<?php echo site_url('chat/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-regular fa-comments  fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('المحادثه', 'qeema'); ?></span>
            </a>
        </div>

        <?php
        $userPlayground = new WP_Query(array(
            'post_type' => 'playground',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'user_id',
                    'value' => $user->ID,
                    'compare' => '='
                )
            )
        ));

        if ($userPlayground->found_posts > 0) :
        ?>

            <div class="col-12">
                <a hx-get="<?php echo site_url('user/playgrounds/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                    <img class="icon-xs" src="<?php echo get_template_directory_uri() . '/assets/images/playgrounds.png'; ?>" alt="">
                    <span class="text-dark fw-bold font-x-12"><?php echo __('ملاعبي', 'qeema'); ?></span>
                </a>
            </div>

        <?php endif; ?>

        <?php

        $userAcademy = new WP_Query(array(
            'post_type' => 'academy',
            'meta_key' => 'user_id',
            'meta_value' => $user->ID
        ));

        if ($userAcademy->found_posts > 0) :
        ?>

            <div class="col-12">
                <a hx-get="<?php echo site_url('user/academies/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                    <img class="icon-xs" src="<?php echo get_template_directory_uri() . '/assets/images/academies.png'; ?>" alt="">
                    <span class="text-dark fw-bold font-x-12"><?php echo __('اكادمياتي', 'qeema'); ?></span>
                </a>
            </div>

        <?php endif; ?>

        <?php

        $userAcademy = new WP_Query(array(
            'post_type' => 'gym',
            'meta_key' => 'user_id',
            'meta_value' => $user->ID
        ));

        if ($userAcademy->found_posts > 0) :
        ?>
            <div class="col-12">
                <a hx-get="<?php echo site_url('user/gyms/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                    <img class="icon-xs" src="<?php echo get_template_directory_uri() . '/assets/images/weightlifting.png'; ?>" alt="">
                    <span class="text-dark fw-bold font-x-12"><?php echo __('الجيم الخاص بي', 'qeema'); ?></span>
                </a>
            </div>
        <?php endif; ?>

        <!-- App Settings -->

        <div class="col-12">
            <a hx-get="<?php echo get_the_permalink('2'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-solid fa-circle-question fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('عن التطبيق و الجوائز', 'qeema'); ?></span>
            </a>
        </div>

        <div class="col-12">
            <a hx-get="<?php echo get_the_permalink(3); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-solid fa-list-check fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('شروط و سياسة الاستخدام', 'qeema'); ?></span>
            </a>
        </div>

        <div class="col-12">
            <a hx-get="<?php echo wp_logout_url(site_url('home/')); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-solid fa-user-xmark fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('حذف الحساب', 'qeema'); ?></span>
            </a>
        </div>

        <div class="col-12">
            <a hx-get="<?php echo wp_logout_url(site_url('home/')); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="link-hover d-flex gap-2 align-items-center p-2 mb-3 rounded-2">
                <i class="fa-solid fa-arrow-right-from-bracket fs-5 text-danger"></i>
                <span class="text-dark fw-bold font-x-12"><?php echo __('تسجيل الخروج', 'qeema'); ?></span>
            </a>
        </div>
    </div>
    <img class="position-absolute bottom-0 end-0 w-50" src="<?php echo get_template_directory_uri() . '/assets/images/Frame.png'; ?>" alt="">
</div>