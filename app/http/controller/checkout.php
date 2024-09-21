<?php

echo '<pre>';

var_dump($_POST);

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $post_id = input_exist('post_id');
    $size = input_exist('size');
    $qt = input_exist('qt');
    $color = input_exist('color');

    $price = get_post_meta($post_id, 'price', true);
    $discount = get_post_meta($post_id, 'discount', true);
    $getPost = ($discount) ? $discount : $price;

    $total = ($getPost * $qt);

    $data = array(
        'post_status' => 'pending',
        'post_author' => $user->ID,
        'post_type' => 'lc_order',
    );

    // Insert the post into the database
    $order_id = wp_insert_post($data);

    update_post_meta($order_id, 'post_id', $post_id);
    update_post_meta($order_id, 'size', $size);
    update_post_meta($order_id, 'color', $color);
    update_post_meta($order_id, 'qt', $qt);
    update_post_meta($order_id, 'getPrice', $getPost);
    update_post_meta($order_id, 'total', $total);


    $merchantRefNum = rand();
    $customerProfileId = $user->ID;
    $returnUrl = site_url('payment/status/' . $order_id . '/');
    $itemId = $post_id;
    $quantity = $qt;
    $price = $getPost . '.00';

    $signature = hash('sha256', MERCHANT_CODE . $merchantRefNum . $customerProfileId .
        $returnUrl . $itemId . $quantity . $price . MERCHANT_SEC_KEY);
}
?>

<script>
    function checkout() {
        const configuration = {
            locale: "en", //default en
            mode: DISPLAY_MODE.SIDE_PAGE, //required, allowed values [POPUP, INSIDE_PAGE, SIDE_PAGE , SEPARATED]
        };
        FawryPay.checkout(buildChargeRequest(), configuration);
    }

    function buildChargeRequest() {
        const chargeRequest = {
            merchantCode: '<?php echo MERCHANT_CODE; ?>',
            merchantRefNum: '<?php echo $merchantRefNum; ?>',
            customerMobile: '<?php echo get_user_meta($user->ID, 'phonenumber', true); ?>',
            customerEmail: '<?php echo $user->user_email; ?>',
            customerName: '<?php echo $user->first_name . ' ' . $user->last_name; ?>',
            customerProfileId: '<?php echo $user->ID; ?>',
            chargeItems: [{
                itemId: '<?php echo $itemId; ?>',
                description: '<?php echo get_the_title($itemId); ?>',
                price: <?php echo $getPost; ?>,
                quantity: <?php echo $quantity; ?>,
                imageUrl: '<?php echo get_the_post_thumbnail_url($itemId, 'full') ?>',
            }, ],
            returnUrl: '<?php echo $returnUrl; ?>',
            authCaptureModePayment: false,
            signature: '<?php echo $signature; ?>'
        };
        return chargeRequest;
    }

    checkout();
</script>