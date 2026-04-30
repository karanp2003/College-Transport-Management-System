<?php
include("../config/db.php");

$id = $_GET['id'];

$conn->query("DELETE FROM payments WHERE id=$id");

echo "deleted";
?>