<?php

if (!wp_is_mobile()) {
    require_once component('server-down');
    exit;
}

get_header();

// permission
// if (is_user_logged_in()) {

//     // Get current user.
//     $user = wp_get_current_user();

//     $permission = get_user_meta($user->ID, 'permission', true);

//     if ($permission && $permission == 'yes') {
//         require_once view('trainer/home-trainer');
//         exit;
//     }
// }

require_once view('home');

// } else {
//     require_once view('login');
// }

// get_template_part('template-parts/exercise', 'offcanvas');

get_footer();
