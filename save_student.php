<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];
$amount = $_POST['amount'];

$conn->query("INSERT INTO payments(user_id,amount,status)
              VALUES('$user_id','$amount','Paid')");

echo "success";
?>