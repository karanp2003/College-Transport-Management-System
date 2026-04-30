<?php
include("../config/db.php");

$res = $conn->query("SELECT * FROM tracking ORDER BY updated_at DESC LIMIT 1");
$row = $res->fetch_assoc();

echo json_encode($row);
?>