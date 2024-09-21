<?php

// Get current user.
$curUser = wp_get_current_user();

if ($_POST) {

    $nonce = $_REQUEST['_wpnonce'];

    if (!wp_verify_nonce($nonce, 'submit_picture')) {
        exit; // Get out of here, the nonce is rotten!
    }

    // Check first name is present 
    $user['first_name'] = esc_sql($_REQUEST['first_name']);

    $errors = [];

    if (empty($user['first_name'])) {
        $errors['first_name'] = __("Please enter a first name", 'qeema');
    }

    // Check last name is present 
    $user['last_name'] = esc_sql($_REQUEST['last_name']);

    if (empty($user['last_name'])) {
        $errors['last_name'] = __("Please enter a last name", 'qeema');
    }

    // Check email address is present and valid  
    $user['user_email'] = esc_sql($_REQUEST['email']);

    if ($user['user_email'] != $curUser->user_email) {

        if (!is_email($user['user_email'])) {
            $errors['email'] = "Please enter a valid email";
        } elseif (email_exists($user['user_email'])) {
            $errors['email'] = "This email address is already in use";
        }
    }


    if (isset($_POST['change_password']) && $_POST['change_password'] == 'yes') {
        // Check password is valid  
        if (0 === preg_match("/.{6,}/", $_POST['password'])) {
            $errors['password'] = "Password must be at least six characters";
        }

        if (0 !== strcmp($_POST['password'], $_POST['password_confirmation'])) {
            $errors['password_confirmation'] = "Passwords do not match";
        }
    }

    if (0 === count($errors)) {

        if (isset($_POST['change_password']) && $_POST['change_password'] == 'yes') {
            $user['user_pass'] = esc_sql($_POST['password']);
        }
        
        $phonenumber = isset($_POST['phonenumber']) ? esc_sql($_POST['phonenumber']) : '';

        $desc = isset($_POST['desc']) ? esc_sql($_POST['desc']) : '';

        $type = isset($_POST['type']) ? esc_sql($_POST['type']) : '';

        $user['ID'] = esc_sql($params['id']);

        // Insert new user.
        $new_user_id = wp_update_user($user);

        // ==== Update User Meta ====//
        if (!empty($phonenumber)) {
            update_user_meta($new_user_id, 'phonenumber', $phonenumber);
        }

        if (!empty($desc)) {
            update_user_meta($new_user_id, 'desc', $desc);
        }

        if (!empty($type)) {
            update_user_meta($new_user_id, 'type', $type);
        }

        update_user_meta($new_user_id, 'age', input_exist('age'));

        update_user_meta($new_user_id, 'height', input_exist('height'));

        update_user_meta($new_user_id, 'weight', input_exist('weight'));

        $profile_image = esc_sql($_FILES['profile_image']);

        if ($_FILES['profile_image']['name'] != "") {
            $imageID = get_user_meta($new_user_id, 'profile_image', true);

            wp_delete_attachment($imageID);

            update_user_meta($new_user_id, 'profile_image', uploadFile($profile_image));
        }

        // wp_set_current_user($new_user_id);
        // wp_set_auth_cookie($new_user_id);
        // $user = get_user_by('id', $new_user_id);
        // do_action('wp_login', $user->user_login); //`[Codex Ref.][1]
        // wp_redirect(home_url());

        wp_safe_redirect($_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['errors'] = $errors;

        var_dump($errors);
        // wp_redirect(home_url('register'));
    }
}
