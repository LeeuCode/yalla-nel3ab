<?php

$id = $params['id'];

$post_id = intval($id);
$user_id = get_current_user_id();

if (filter_var($post_id, FILTER_VALIDATE_INT)) :

    $favorite_post = user_count_meta($user_id, 'favorite_post', $post_id);

    if ($favorite_post > 0) {
        // If user Click to like Btn and he's liked, it'll be removed.
        delete_user_meta($user_id, 'favorite_post', $post_id);
    } else {
        // liked post.
        add_user_meta($user_id, 'favorite_post', $post_id);
    }

    $favorite_post = user_count_meta($user_id, 'favorite_post', $post_id);

    // Here we'll update the HTML content component with new values by HTMX.
?>
    <!-- <div hx-swap-oob="innerHTML:#favorite-<?php echo $post_id; ?>"> -->
        <i class="<?php echo ($favorite_post > 0) ? 'fa-solid' : 'fa-regular'; ?> fa-heart"></i>
    <!-- </div> -->

<?php endif; ?>