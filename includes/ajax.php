<?php

function add_like_user()
{
    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();
    $class = '';
    $output = array();

    if (filter_var($post_id, FILTER_VALIDATE_INT)) {
        $like = user_count_meta($user_id, 'like_user', $post_id);

        if ($like > 0) {
            $class = 'fa-regular fa-thumbs-up';

            delete_user_meta($user_id, 'like_user', $post_id);
            delete_user_meta($post_id, 'like_user', $user_id);
        } else {
            $class = 'fa-solid fa-thumbs-up';

            add_user_meta($user_id, 'like_user', $post_id);
            add_user_meta($post_id, 'like_user', $user_id);
        }
    }

    $output['company_likes'] = count(get_user_meta($post_id, 'like_user', false));
    $output['class'] = $class;

    echo wp_json_encode($output);
    exit();
}
add_action('wp_ajax_add_like_user', 'add_like_user');
add_action('wp_ajax_nopriv_add_like_user', 'add_like_user');
