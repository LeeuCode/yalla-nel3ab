<?php

$order_id = $params['id'];

// var_dump($_GET);

// exit;

if (isset($_GET['statusCode']) && $_GET['statusCode'] == 200) {

    update_post_meta($order_id, 'referenceNumber', input_exist('referenceNumber', 'get'));
    update_post_meta($order_id, 'merchantRefNumber', input_exist('merchantRefNumber', 'get'));
    update_post_meta($order_id, 'orderAmount', input_exist('orderAmount', 'get'));
    // update_post_meta($order_id, 'paymentAmount', input_exist('paymentAmount', 'get'));
    // update_post_meta($order_id, 'paymentAmount', input_exist('paymentAmount', 'get'));
    // update_post_meta($order_id, 'fawryFees', input_exist('fawryFees', 'get'));
    // update_post_meta($order_id, 'orderStatus', input_exist('orderStatus', 'get'));
    // update_post_meta($order_id, 'paymentMethod', input_exist('paymentMethod', 'get'));
    // update_post_meta($order_id, 'paymentTime', input_exist('paymentTime', 'get'));
    // update_post_meta($order_id, 'cardLastFourDigits', input_exist('cardLastFourDigits', 'get'));
    // update_post_meta($order_id, 'customerName', input_exist('customerName', 'get'));
    // update_post_meta($order_id, 'customerProfileId', input_exist('customerProfileId', 'get'));
    // update_post_meta($order_id, 'statusCode', input_exist('statusCode', 'get'));
    // update_post_meta($order_id, 'statusDescription', input_exist('statusDescription', 'get'));

    wp_update_post(array(
        'ID'           => $order_id,
        'post_status'   => 'publish',
    ));
} else {
    update_post_meta($order_id, 'statusCode', input_exist('statusCode', 'get'));
    update_post_meta($order_id, 'statusDescription', input_exist('statusDescription', 'get'));
}

wp_safe_redirect(site_url('payment/code/' . input_exist('statusCode', 'get') . '/msg/' . input_exist('statusDescription', 'get') . '/'));

exit;
