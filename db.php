<?php
$conn = new mysqli("localhost","root","","transport_db");

if($conn->connect_error){
    die("Connection failed");
}
?>