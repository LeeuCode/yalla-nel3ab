<?php
$logoID = get_user_meta($post->post_author, 'profile_image', true);
$profileImage = get_template_directory_uri() . '/assets/images/user-defualt.jpg';

if ($logoID) {
    $profileImage = wp_get_attachment_url($logoID);
}

$sender = get_userdata($post->post_author);
?>

<div class="message-content d-flex gap-1 <?php echo ($post->post_author == $user->ID) ? 'sender' : 'messager'; ?> mb-3">
    <img class="avater-xs rounded-circle shadow-sm" src="<?php echo $profileImage; ?>" alt="">
    <div class="flex-grow-1 <?php echo ($post->post_author == $user->ID) ? 'text-end d-flex align-items-end flex-column' : ''; ?> ">
        <span class="mb-1 font-x-11"><?php echo $sender->first_name . ' ' . $sender->last_name; ?></span>
        <div class="message font-x-12">
            <?php echo get_post_meta($post->ID, 'message', true); ?>
        </div>
    </div>
</div>