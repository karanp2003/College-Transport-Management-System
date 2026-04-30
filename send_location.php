<?php
include("../config/db.php");

$bus_id = $_POST['bus_id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// CHECK IF EXISTS
$check = $conn->query("SELECT * FROM bus_tracking WHERE bus_id='$bus_id'");

if($check->num_rows > 0){
    $conn->query("UPDATE bus_tracking 
                  SET latitude='$lat', longitude='$lng' 
                  WHERE bus_id='$bus_id'");
}else{
    $conn->query("INSERT INTO bus_tracking(bus_id,latitude,longitude)
                  VALUES('$bus_id','$lat','$lng')");
}
?>