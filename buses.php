<?php
include("../config/db.php");

// Add Bus
if(isset($_POST['add'])){
    $bus_name = $_POST['bus_name'];
    $bus_no = $_POST['bus_no'];
    $plate = $_POST['plate'];
    $driver_name = $_POST['driver_name'];
    $driver_phone = $_POST['driver_phone'];

    // Image upload
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/".$photo);

    $conn->query("INSERT INTO buses(bus_name,bus_no,plate,driver_name,driver_phone,photo)
                  VALUES('$bus_name','$bus_no','$plate','$driver_name','$driver_phone','$photo')");
}

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM buses WHERE id=$id");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="sidebar">
    <h2>Transport</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="buses.php">Buses</a>
    <a href="routes.php">Routes</a>
</div>

<div class="main">
    <h1>Manage Buses</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="bus_name" placeholder="Bus Name" required>
        <input name="bus_no" placeholder="Bus Number" required>
        <input name="plate" placeholder="Number Plate" required>
        <input name="driver_name" placeholder="Driver Name" required>
        <input name="driver_phone" placeholder="Driver Contact" required>
        <input type="file" name="photo" required>
        <button name="add">Add Bus</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Bus Name</th>
            <th>Bus No</th>
            <th>Plate</th>
            <th>Driver</th>
            <th>Phone</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>

        <?php
        $res = $conn->query("SELECT * FROM buses");
        while($row = $res->fetch_assoc()){
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['bus_name'] ?></td>
            <td><?= $row['bus_no'] ?></td>
            <td><?= $row['plate'] ?></td>
            <td><?= $row['driver_name'] ?></td>
            <td><?= $row['driver_phone'] ?></td>
            <td>
                <img src="../uploads/<?= $row['photo'] ?>" width="60" height="60">
            </td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>