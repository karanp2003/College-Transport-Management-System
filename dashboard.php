<?php 
include("../includes/auth.php");
include("../config/db.php");

// counts
$buses = $conn->query("SELECT COUNT(*) as total FROM buses")->fetch_assoc()['total'];
$drivers = $conn->query("SELECT COUNT(*) as total FROM drivers")->fetch_assoc()['total'];
$routes = $conn->query("SELECT COUNT(*) as total FROM routes")->fetch_assoc()['total'];
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="sidebar">
    <h2>Transport</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="buses.php">Buses</a>
    <a href="drivers.php">Drivers</a>
    <a href="routes.php">Routes</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="main">
    <h1>Admin Dashboard</h1>

    <div class="card" style="background:#2563eb;color:white;">
        🚌 <h2><?= $buses ?></h2>
        <p>Total Buses</p>
    </div>

    <div class="card" style="background:#16a34a;color:white;">
        👨‍✈️ <h2><?= $drivers ?></h2>
        <p>Drivers</p>
    </div>

    <div class="card" style="background:#f59e0b;color:white;">
        🗺️ <h2><?= $routes ?></h2>
        <p>Routes</p>
    </div>
</div>