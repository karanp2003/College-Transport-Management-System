<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];

$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$amount = $_POST['amount'];

// Save directly (basic version)
$conn->query("INSERT INTO payments(user_id,amount,status,payment_id,method)
              VALUES('$user_id','$amount','Paid','$payment_id','Razorpay')");

echo "✅ Payment Successful!";
?>