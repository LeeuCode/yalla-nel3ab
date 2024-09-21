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
