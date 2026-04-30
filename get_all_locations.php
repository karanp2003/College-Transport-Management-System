<?php
include("../config/db.php");

$res = $conn->query("
    SELECT t.*, b.bus_name, b.bus_no 
    FROM tracking t
    JOIN buses b ON t.bus_id = b.id
");

$data = [];

while($row = $res->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>