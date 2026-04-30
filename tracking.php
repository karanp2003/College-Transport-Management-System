<?php session_start(); ?>

<script>
navigator.geolocation.watchPosition(function(position){
    let lat = position.coords.latitude;
    let lng = position.coords.longitude;

    fetch("update_location.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: body: "bus_id=YOUR_BUS_ID&lat="+lat+"&lng="+lng
    });
});
</script>

<h2>Sending Live Location...</h2>