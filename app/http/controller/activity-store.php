<?php

if ($_POST) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $activity_cat = input_exist('activity_cat');
    $start_date = input_exist('start_date');
    $start_time = input_exist('start_time');
    $end_time = input_exist('end_time');
    $playground = input_exist('playground');

    // Get current user.
    $user = wp_get_current_user();

    $data = array(
        'post_status' => 'publish',
        'post_author' => $user->ID,
        'post_type' => 'activity',
    );

    // Insert the post into the database
    $post_id = wp_insert_post($data);

    wp_update_post(
        array(
            'ID' => $post_id,
            'post_title' => '#' . $post_id
        )
    );

    update_post_meta($post_id, 'activity_cat', $activity_cat);
    update_post_meta($post_id, 'start_date', $start_date);
    update_post_meta($post_id, 'start_time', $start_time);
    update_post_meta($post_id, 'end_time', $end_time);
    update_post_meta($post_id, 'playground', $playground);

    $team_count = get_field('team_count', 'section_' . $activity_cat);
    $plaiers_count = get_field('plaiers_count', 'section_' . $activity_cat);

    $countTeam = 0;

    $data = [];

    $t = 0;
    for ($i = 0; $i < $team_count; $i++) {

        $t++;

        for ($c = 0; $c < $plaiers_count; $c++) {

            if (isset($_FILES['team_' . $i . '_' . $c])) {

                foreach (split_files($_FILES['team_' . $i . '_' . $c]) as $key => $file) {
                    update_post_meta($post_id, 'team_' . $i . '_' . $c . '_img_link', uploadFile($file));
                }

                $data['team_' . $i] =  $c + 1;
            }
        }
    }

    update_post_meta($post_id, 'team', $data);
}
