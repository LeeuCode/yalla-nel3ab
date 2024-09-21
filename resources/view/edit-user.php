<?php

// get_header('global');

// Get current user.
$user = wp_get_current_user();
$logoID = get_user_meta($user->ID, 'profile_image', true);
$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

if ($logoID) {
    $profileImage = wp_get_attachment_url($logoID);
}

$link = site_url('home/');

require_once component('heading');
?>

<form hx-post="<?php echo site_url('/update/user/' . $user->ID . '/'); ?>" method="post" enctype="multipart/form-data">

    <?php wp_nonce_field('submit_picture'); ?>
    <!-- <input type="hidden" name="type" value="user"> -->

    <div class="d-flex justify-content-center my-4">
        <div class="thumb rounded-3">
            <img class="rounded-3 shadow-sm" src="<?php echo $profileImage; ?>"
                alt="<?php echo $user->first_name; ?>">
            <input class="d-none upload-preview-image" name="profile_image" id="upload-profile" type="file">
            <label for="upload-profile">
                <i class="fa-regular fa-pen-to-square"></i>
            </label>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 mb-4">
                <label for="first_name" class="form-label small mb-3">
                    <?php echo __('الاسم الاول', 'qeema'); ?>
                </label>
                <input class="form-control" name="first_name" id="first_name" value="<?php echo $user->first_name; ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label for="last_name" class="form-label small mb-3">
                    <?php echo __('الاسم الاخير', 'qeema'); ?>
                </label>
                <input name="last_name" class="form-control" id="last_name" value="<?php echo $user->last_name; ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label for="email" class="form-label mb-3">
                    <?php echo __('البريد الالكتروني', 'qeema'); ?>
                </label>
                <input class="form-control" name="email" type="email" id="email"
                    value="<?php echo $user->user_email; ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label for="phonenumber" class="form-label mb-3">
                    <?php echo __('رقم الهاتف', 'qeema'); ?>
                </label>
                <input class="form-control" type="tel" name="phonenumber" id="phonenumber"
                    value="<?php echo get_user_meta($user->ID, 'phonenumber', true); ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label for="desc" class="form-label mb-3">
                    <?php echo __('نبذه عنك', 'qeema'); ?>
                </label>
                <textarea class="form-control" name="desc"
                    id="desc"><?php echo get_user_meta($user->ID, 'desc', true); ?></textarea>
            </div>

            <div class="col-12">
                <div class="form-check d-flex align-items-center gap-2 password-checkbox mb-3">
                    <input name="change_password" class="form-check-input rounded-0" id="flexCheckDefault"
                        type="checkbox" value="yes">
                    <label class="form-check-label text-gray" for="flexCheckDefault" role="button">تغير كلمة
                        المرور</label>
                </div>
            </div>

            <div class="change-password hide">
                <div class="col-lg-12 mb-4">
                    <label for="password" class="form-label small mb-3">
                        <?php echo __('كلمة السر', 'qeema'); ?>
                    </label>
                    <div class="password">
                        <input type="password" name="password" class="form-control" id="password">
                        <i class="show-password fa-regular fa-eye-slash"></i>
                    </div>
                </div>

                <div class="col-lg-12 mb-4">
                    <label for="password_confirmation" class="form-label small mb-3">
                        <?php echo __('تأكيد كلمة السر', 'qeema'); ?>
                    </label>
                    <div class="password">
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation">
                        <i class="show-password fa-regular fa-eye-slash"></i>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-3 w-100 px-3 my-3">
                <button type="submit" class="btn btn-success-lite rounded-3px">
                    <?php echo __('متابعة', 'qeema'); ?>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    jQuery(document).ready(function($) {
        'use strict';
    });
</script>