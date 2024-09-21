<?php

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $post_id = esc_sql($params['id']);


    $post_title = input_exist('post_title');
    $content = input_exist('content');
    $address = input_exist('address');
    $morning_periods = input_exist('morning_periods');
    $night_periods = input_exist('night_periods');
    $type = input_exist('type');

    $countMorningPeriods = count($morning_periods);
    $countNightPeriods = count($night_periods);

    wp_update_post(array(
        'ID'           => $post_id,
        'post_title'   => $post_title,
    ));

    delete_field('morning_periods', $post_id);
    delete_field('night_periods', $post_id);
    delete_field('type', $post_id);

    update_post_meta($post_id, 'content', $content);
    update_post_meta($post_id, 'address', $address);
    update_post_meta($post_id, 'morning_periods', count($morning_periods));
    update_post_meta($post_id, 'night_periods', count($night_periods));

    update_post_meta($post_id, 'type', count($type));

    foreach ($morning_periods as $i => $morning_period) {
        add_post_meta($post_id, 'morning_periods_' . $i . '_period', $morning_period['period']);
    }

    foreach ($night_periods as $i => $night_period) {
        add_post_meta($post_id, 'night_periods_' . $i . '_period', $night_period['period']);
    }

    foreach ($type as $i => $type) {
        add_post_meta($post_id, 'type_' . $i . '_name', $type['name']);
        add_post_meta($post_id, 'type_' . $i . '_price', $type['price']);
    }

    get_template_part(
        'resources/components/message',
        null,
        array(
            'msg' => __('تم تعديل بيانات بنجاح!', 'qeema'),
            'icon' => 'success',
            // 'content' => get_template_part('template-parts/service-block', null, [
            //     'post_id' => $post_id,
            //     'swap' => true
            // ])
        )
    );
}
