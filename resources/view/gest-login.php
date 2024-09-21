<?php

$link = site_url('home/');

require_once component('heading');
?>

<div class="w-75 mx-auto text-center py-5">
    <img class="w-100 d-block mb-3" src="<?php echo get_template_directory_uri() . '/assets/images/mobile_login.svg'; ?>" alt="">
    <p class="mb-2"><?php echo __('سجل الدخول للمتابعة', 'qeema'); ?></p>
    <a hx-get="<?php echo site_url('login/'); ?>" hx-swap="innerHTML show:top" hx-trigger="click" hx-target=".app" hx-on::before-request="showLoad()" class="btn btn-danger px-5">
        <?php echo __('تسجيل الدخول', 'qeema'); ?>
    </a>
</div>