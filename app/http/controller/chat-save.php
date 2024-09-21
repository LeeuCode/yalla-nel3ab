<?php

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $message = input_exist('message');

    $data = array(
        'post_status' => 'publish',
        'post_author' => $user->ID,
        'post_type' => 'lc_chat',
    );

    // Insert the post into the database
    $message_id = wp_insert_post($data);

    wp_update_post(array(
        'ID'           => $message_id,
        'post_title'   => '#' . $message_id,
    ));

    update_post_meta($message_id, 'message', $message);
}

?>

<script>
    jQuery(document).ready(function($) {
        'use strict';
        $(document).scrollTop($(document).height());
    });
</script>