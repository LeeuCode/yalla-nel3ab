<?php

$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';
?>

<div class="add-champ position-fixed bg-white w-100 h-100">
    <div class="header">
        <div class="header-box justify-content-between px-3 py-4 h-auto" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">

            <a href="#" class="close-activity btn btn-sm btn-outline-light border-color-selver border-color-selver">
                <i class="fa-solid fa-chevron-right"></i>
            </a>

            <img class="w-25" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">

            <a hx-get="<?php echo site_url('notifications/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-target=".app" hx-on::before-request="showLoad()" class="icon-sm fs-5 rounded-pill d-flex align-items-center justify-content-center position-relative">
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
        </div>
    </div>

    <!-- create-activity -->
    <div class="container position-relative">
        <div class="row">
            <div class="d-flex justify-content-center my-4">
                <div class="thumb rounded-3">
                    <img class="rounded-3 shadow-sm" src="<?php echo $profileImage; ?>" alt="">
                    <input class="d-none upload-preview-image" name="team_avatar" id="team_avatar" type="file">
                    <label for="team_avatar">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </label>
                </div>
            </div>

            <div class="col-12 mb-2">
                <label class="font-x-12 mb-1 fw-bold" for="start_date"><?php echo __('اسم الفريق', 'qeema'); ?></label>
                <input type="text" name="team_name" class="form-control form-contole-sm">
            </div>

            <div class="col-12 mb-3">
                <label class="font-x-12 mb-3 fw-bold" for="start_time"><?php echo __('عدد الفريق', 'qeema'); ?></label>
                <input type="text" name="players_count" class="form-control form-contole-sm">
            </div>

            <div class="col-12 mb-2">
                <label class="font-x-12 mb-3 fw-bold" for="end_time"><?php echo __('كابتن الفريق', 'qeema'); ?></label>
                <input type="text" name="team_leader" class="form-control form-contole-sm">
            </div>
        </div>

        <div class="py-4 my-4"></div>

        <div class="create-match bg-white position-fixed bottom-0 start-0 w-100 p-3 d-flex align-items-center justify-content-between border-top shadow-sm">
            <button type="submit" class="btn btn-sm btn-danger w-50"><?php echo __('الاشتراك في البطوله', 'qeema'); ?></button>

            <span class="text-danger fw-bold"><span class="price"><?php echo get_post_meta($post_id, 'price', true); ?></span> ج.م</span>
        </div>
    </div>
</div>