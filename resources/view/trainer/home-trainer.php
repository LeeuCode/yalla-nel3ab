<?php
// Get current user.
$user = wp_get_current_user();

$logoID = get_user_meta($user->ID, 'profile_image', true);
// $type = get_user_meta($user->ID, 'type', true);
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
    <!-- <div class="header-abs shadow"> -->
    <div class="d-flex align-items-center justify-content-between py-4 px-3">
        <div class="d-flex gap-2 flex-row align-items-center">
            <div class="thumb border-0 icon-sm shadow">
                <img class="rounded-circle icon-sm" src="<?php echo $profileImage; ?>" alt="<?php echo $user->first_name; ?>">
            </div>
            <p class="font-x-12 text-dark fw-bold my-1">
                <?php echo $user->first_name; ?>
            </p>
        </div>
        <!-- <p class="small fw-bold text-white m-0">
                <?php echo __('مرحبا بكم في تطبيق فاهم', 'qeema'); ?>
            </p> -->
        <a hx-get="<?php echo site_url('notification/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" class="icon-sm fs-5 rounded-pill d-flex align-items-center justify-content-center">
            <i class="bi bi-bell text-dark"></i>
        </a>
    </div>
    <!-- </div> -->
</div>

<div class="container position-relative px-4 h-100vh">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="position-relative mb-3">
                <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/assets/images/home-image.png'; ?>" alt="">
                <img class="w-50 position-absolute top-50 start-50 translate-middle" src="<?php echo get_template_directory_uri() . '/assets/images/login-header.png'; ?>" alt="">
            </div>
        </div>

        <div class="col-12">
            <div class="d-flex aling-items-center gap-2 py-3 border-bottom mb-3 position-relative">
                <img class="icon-sm" src="<?php echo get_template_directory_uri() . '/assets/images/playgrounds.png'; ?>" alt="">
                <div>
                    <h6 class="fw-bold mb-1 small"><?php echo __('حجز ملاعب', 'qeema'); ?></h6>
                    <p class="text-secondary font-x-11 mb-0">
                        <?php echo __('كورة قدم - تنس - سله- طايرة - بولنج - بوكس', 'qeema'); ?>
                    </p>
                </div>
                <a hx-get="<?php echo site_url('reserve-playgrounds/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>