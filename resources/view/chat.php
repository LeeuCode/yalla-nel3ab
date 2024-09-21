<?php

$link = site_url('home/');

// require_once component('heading');

// Get current user.
$user = wp_get_current_user();

?>

<div class="load-spinner hide d-flex align-items-center justify-content-center">
    <div class="text-center p-3 bg-white rounded-2">
        <div class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="d-block font-x-12 mt-2"><?php echo __('جاري التحميل', 'qeema'); ?>.....</span>
    </div>
</div>

<div class="header position-fixed top-0">
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

<div class="container p-3 pt-5 mt-4">
    <div class="row">
        <div id="chatbox" class="col-12">
            <div class="chat-messages" hx-get="<?php echo site_url('chat/room'); ?>" hx-trigger="every 2s scroll:bottom">
                <?php

                // Get current user.
                $user = wp_get_current_user();

                $chats = new WP_Query(array(
                    'post_type' => 'lc_chat',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'order' => 'ASC'
                ));

                if ($chats->have_posts()) {
                    while ($chats->have_posts()) {
                        $chats->the_post();

                        include component('chat-message');
                    }
                }
                ?>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="chat-input">
            <form hx-post="<?php echo site_url('chat/save'); ?>" hx-swap="innerHTML" hx-on::after-request="this.reset()" hx-target="#message">
                <input name="form_nonce" type="hidden" value="<?= wp_create_nonce('test-nonce') ?>" />

                <div class="input-group mb-3">
                    <input type="text" name="message" class="form-control" placeholder="<?php echo __('اكتب رسالتك هنا', 'qeema'); ?>" required>
                    <button class="btn btn-success-lite" type="submit">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        'use strict';
        $(document).scrollTop($(document).height());
    });
</script>