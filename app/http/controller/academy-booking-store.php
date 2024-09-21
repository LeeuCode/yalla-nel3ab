<?php

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $type = input_exist('type');
    $period = input_exist('period');
    $period_morning = input_exist('period_morning');
    $night_periods = input_exist('night_periods');
    $price = input_exist('price');

    $data = array(
        'post_title' => $title,
        'post_status' => 'pending',
        'post_author' => $user->ID,
        'post_type' => 'booking-academy',
    );

    // // Insert the post into the database
    $post_id = wp_insert_post($data);

    wp_update_post(
        array(
            'ID' => $post_id,
            'post_title' => '#' . $post_id
        )
    );

    update_post_meta($post_id, 'type', $type);
    update_post_meta($post_id, 'period', $period);
    update_post_meta($post_id, 'period_morning', $period_morning);
    update_post_meta($post_id, 'night_periods', $night_periods);
    update_post_meta($post_id, 'price', $price);

    get_template_part(
        'template-parts/message',
        null,
        array(
            'msg' => __('تم التقيدم علي الاكادميه بنجاح!', 'qeema'),
            'icon' => 'success',
            // 'content' => get_template_part('template-parts/service-block', null, [
            //     'post_id' => $post_id,
            //     'swap' => true
            // ])
        )
    );
}