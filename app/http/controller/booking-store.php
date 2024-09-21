<?php

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {

    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $post_id = input_exist('post_id');
    $day = input_exist('day');
    $period = input_exist('period');
    $period_morning = input_exist('period_morning');
    $night_periods = input_exist('night_periods');
    $price = input_exist('price');
    $subscripe_type = input_exist('type');

    $data = array(
        'post_status' => 'pending',
        'post_author' => $user->ID,
        'post_type' => 'bookings',
    );

    // Insert the post into the database
    $order_id = wp_insert_post($data);

    update_post_meta($order_id, 'post_id', $post_id);

    update_post_meta($order_id, 'day', $day);
    update_post_meta($order_id, 'period', $period);
    update_post_meta($order_id, 'period_morning', $period_morning);
    update_post_meta($order_id, 'night_periods', $night_periods);
    update_post_meta($order_id, 'price', $price);
    
    if ($subscripe_type) {
        update_post_meta($order_id, 'subscripe_type', $subscripe_type);
    }

    wp_update_post(array(
        'ID'           => $order_id,
        'post_title'   => '#' . $order_id,
    ));

    $merchantRefNum = rand();
    $customerProfileId = $user->ID;
    $returnUrl = site_url('payment/status/' . $order_id . '/');
    $itemId = $post_id;
    $quantity = 1;
    $price = $price . '.00';
    // $merchant_sec_key =  '8981923d-ca6c-4469-86aa-1ba07cd90b74'; // For the sake of demonstration

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
                price: <?php echo $price; ?>,
                quantity: 1,
                imageUrl: 'https://developer.fawrystaging.com/photos/45566.jpg',
            }, ],
            returnUrl: '<?php echo $returnUrl; ?>',
            authCaptureModePayment: false,
            signature: '<?php echo $signature; ?>'
        };
        return chargeRequest;
    }

    checkout();
</script>