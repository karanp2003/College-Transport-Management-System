<?php
include("../config/db.php");

if(isset($_POST['bus_id'])){
    $bus_id = $_POST['bus_id'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    // Check if bus already exists
    $check = $conn->query("SELECT * FROM tracking WHERE bus_id=$bus_id");

    if($check->num_rows > 0){
        $conn->query("UPDATE tracking 
                      SET latitude='$lat', longitude='$lng' 
                      WHERE bus_id=$bus_id");
    } else {
        $conn->query("INSERT INTO tracking(bus_id,latitude,longitude)
                      VALUES('$bus_id','$lat','$lng')");
    }
}
?>