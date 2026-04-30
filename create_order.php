<?php
include("../config/db.php");

$key_id = "rzp_test_SZkvAAbWgbJmVO";
$key_secret = "YOUR_NEW_SECRET_KEY"; // keep private

$amount = $_POST['amount'] * 100;

// Create order using CURL
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERPWD, $key_id . ":" . $key_secret);

$data = [
    "amount" => $amount,
    "currency" => "INR",
    "receipt" => rand(1000,9999)
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>