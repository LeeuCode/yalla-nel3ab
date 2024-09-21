<?php

// Get current user.
$user = wp_get_current_user();

if (isset($_POST)) {
    if (!isset($_POST['form_nonce']) && !wp_verify_nonce($_POST['form_nonce'], 'test-nonce') && !is_user_logged_in()) {
        exit;
    }

    $post_id = esc_sql($params['id']);

    $team_name = input_exist('team_name');
    $players_count = input_exist('players_count');
    $team_leader = input_exist('team_leader');

    $data = array(
        'post_title' => $team_name,
        'post_status' => 'pending',
        'post_author' => $user->ID,
        'post_type' => 'booking_champion',
    );

    // Insert the post into the database
    $order_id = wp_insert_post($data);

    update_post_meta($order_id, 'post_id', $post_id);
    update_post_meta($order_id, 'players_count', $players_count);
    update_post_meta($order_id, 'team_leader', $team_leader);

    $team_avatar = esc_sql($_FILES['team_avatar']);

    if ($_FILES['team_avatar']['name'] != "") {
        $imageID = get_user_meta($order_id, 'team_avatar', true);

        wp_delete_attachment($imageID);

        update_post_meta($order_id, 'team_avatar', uploadFile($team_avatar));
    }

    $price = get_post_meta($post_id, 'price', true);

    $merchantRefNum = rand();
    $customerProfileId = $user->ID;
    $returnUrl = site_url('payment/status/' . $order_id . '/');
    $itemId = $post_id;
    $quantity = 1;
    $price = $price . '.00';

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