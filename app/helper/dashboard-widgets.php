<?php

/**
 * Add a new dashboard widget.
 */
function wpdocs_add_dashboard_widgets()
{
    wp_add_dashboard_widget('dashboard_lc_users', 'المستخدمين', 'rander_dashboard_lc_users', 'dashboard', 'advanced', 'normal');
    wp_add_dashboard_widget('dashboard_lc_hells', 'القاعات', 'rander_dashboard_lc_hells', 'dashboard', 'side', 'normal');
    wp_add_dashboard_widget('dashboard_lc_marriage_contracts', 'عقود الزواج', 'rander_dashboard_lc_marriage_contracts', 'dashboard', 'column4', 'side');
    wp_add_dashboard_widget('dashboard_lc_online', 'جلسه اون لاين', 'rander_dashboard_lc_online', 'dashboard', 'column1', 'side');
    wp_add_dashboard_widget('dashboard_lc_tohome', 'زيارات منزلية', 'rander_dashboard_lc_tohome', 'dashboard', 'column1', 'side');
    wp_add_dashboard_widget('dashboard_lc_marriage_official', 'خدمة المأذون', 'rander_dashboard_lc_marriage_official', 'dashboard', 'column4', 'side');
}
add_action('wp_dashboard_setup', 'wpdocs_add_dashboard_widgets');

/**
 * Output the contents of the dashboard widget
 */
function rander_dashboard_lc_users($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-solid fa-users',
        'title' => 'عدد المستخدمين',
        'class' => 'primary',
        'number' => 25
    ]);
}

function rander_dashboard_lc_hells($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-solid fa-hotel',
        'title' => 'عدد القاعات',
        'class' => 'success',
        'number' => 13
    ]);
}

function rander_dashboard_lc_marriage_contracts($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-regular fa-newspaper',
        'title' => 'عدد عقود الزواح',
        'class' => 'warning',
        'number' => 53
    ]);
}

function rander_dashboard_lc_online($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-solid fa-display',
        'title' => 'عدد الجلسات الاون لاين',
        'class' => 'info',
        'number' => 10
    ]);
}

function rander_dashboard_lc_tohome($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-solid fa-house-user',
        'title' => 'عدد الزيارات المنزلية',
        'class' => 'danger',
        'number' => 20
    ]);
}

function rander_dashboard_lc_marriage_official($post, $callback_args)
{
    get_template_part('template-parts/dashboard', 'block', [
        'icon' => 'fa-solid fa-handshake-angle',
        'title' => 'عدد طلبات الماذون',
        'class' => 'primary',
        'number' => 12
    ]);
}

add_action('wp_dashboard_setup', 'wpdocs_remove_dashboard_widgets');

function wpdocs_remove_dashboard_widgets()
{

    // global $wp_meta_boxes;

    // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    // unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    // unset($wp_meta_boxes['dashboard']['normal']['high']['rank_math_dashboard_widget']);

    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}


function example_admin_bar_remove_logo()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0);