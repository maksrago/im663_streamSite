<?php
// This class handles payments for platforms like Paypal, etc.

Class Payments {
    // Create a request URL to do the magic.
    public function PayPalRequest($type_of_payment, $paypal_amount, $item_name, $paypal_buyer_name, $paypal_config, $paypal_url, $Database) {
    $to_send = [];
    $to_send["business"] = $paypal_config["email"];
    $to_send["return"] = stripslashes($paypal_config["return_url"]);
    $to_send["cancel_return"] = stripslashes($paypal_config["cancel_url"]);
    $to_send["notify_url"] = stripslashes($paypal_config["notify_url"]);
    // Details about the purchase
        $to_send["item_name"] = $item_name;
        $to_send["amount"] = $paypal_amount;
        $to_send["currency_code"] = $paypal_config["currency"];

    $http_query_to_send = http_build_query($to_send);
    return $paypal_url . "?" . $http_query_to_send;
    }
    // Handle PayPal response
    public function PayPalResponse($item_name, $item_number, $payment_status, $payment_amount, $payment_currency, $txn_id, $receiver_email, $payer_email) {

    }

}