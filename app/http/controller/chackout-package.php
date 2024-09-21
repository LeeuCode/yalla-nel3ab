<?php

/*  hash the result using SHA-256 
merchantCode +
merchantRefNum +
customerProfileId (if exists, otherwise insert "") +
returnUrl + 
itemId + 
quantity + 
Price (in tow decimal format like ‘10.00’) + 
Secure hash key
*/

// Get current user.
$user = wp_get_current_user();

$post_id = $params['id'];

$data = array(
    'post_status' => 'pending',
    'post_author' => $user->ID,
    'post_type' => 'pakage_orders',
);

// Insert the post into the database
$order_id = wp_insert_post($data);

wp_update_post(array(
    'ID'           => $order_id,
    'post_title'   => '#' . $order_id,
));

update_post_meta($order_id, 'post_id', $params['id']);

$price = get_field('price', $post_id);
$discount = get_field('discount', $post_id);

$merchantRefNum = rand();
$customerProfileId = $user->ID;
$returnUrl = site_url('package/request/' . $post_id . '/order/' . $order_id . '/');
$itemId = $post_id;
$quantity = 1;
$Price = ($discount) ? $discount . '.00' : $price . '.00';
// $merchant_sec_key =  '8981923d-ca6c-4469-86aa-1ba07cd90b74'; // For the sake of demonstration

$signature = hash('sha256', MERCHANT_CODE . $merchantRefNum . $customerProfileId .
    $returnUrl . $itemId . $quantity . $Price . MERCHANT_SEC_KEY);

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
                price: <?php echo $Price; ?>,
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