<?php
include("../config/db.php");

// Add Driver
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // Upload photo
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmp, "../uploads/".$photo);

    $conn->query("INSERT INTO drivers(name,phone,photo)
                  VALUES('$name','$phone','$photo')");
}

// Delete Driver
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM drivers WHERE id=$id");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<div class="sidebar">
    <h2>Transport</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="buses.php">Buses</a>
    <a href="routes.php">Routes</a>
    <a href="drivers.php">Drivers</a>
</div>

<div class="main">
    <h1>Manage Drivers</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="name" placeholder="Driver Name" required>
        <input name="phone" placeholder="Driver Contact Number" required>
        <input type="file" name="photo" required>
        <button name="add">Add Driver</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>

        <?php
        $res = $conn->query("SELECT * FROM drivers");
        while($row = $res->fetch_assoc()){
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['phone'] ?></td>
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