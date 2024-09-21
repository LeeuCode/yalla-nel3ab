<div class="load-spinner hide d-flex align-items-center justify-content-center">
    <div class="text-center p-3 bg-white rounded-2">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="d-block font-x-12 mt-2"><?php echo __('جاري التحميل', 'qeema'); ?>.....</span>
    </div>
</div>

<div class="header">
    <div class="header-box justify-content-between px-3 py-4 h-auto" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/images/bg-image.png'; ?>)">

        <a hx-get="<?php echo $link; ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-sm btn-outline-light  border-color-selver border-color-selver">
            <i class="fa-solid fa-chevron-right"></i>
        </a>

        <img class="w-25" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">

        <a hx-get="<?php echo site_url('notification/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-target=".app" hx-on::before-request="showLoad()" class="icon-sm fs-5 bg-white- rounded-pill d-flex align-items-center justify-content-center  position-relative">
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