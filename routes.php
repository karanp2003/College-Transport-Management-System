<?php
include("../config/db.php");

// Add Route
if(isset($_POST['add'])){
    $bus_id = $_POST['bus_id'];
    $source = $_POST['source'];
    $source_time = $_POST['source_time'];
    $destination = $_POST['destination'];
    $destination_time = $_POST['destination_time'];

    // Fetch bus details
    $bus = $conn->query("SELECT * FROM buses WHERE id=$bus_id")->fetch_assoc();
    $bus_name = $bus['bus_name'];
    $bus_no = $bus['bus_no'];

    $conn->query("INSERT INTO routes(bus_id,bus_name,bus_no,source,source_time,destination,destination_time)
                  VALUES('$bus_id','$bus_name','$bus_no','$source','$source_time','$destination','$destination_time')");
}

// Delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM routes WHERE id=$id");
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
    <h1>Manage Routes</h1>

    <form method="POST">
        
        <!-- Select Bus -->
        <select name="bus_id" required>
            <option value="">Select Bus</option>
            <?php
            $buses = $conn->query("SELECT * FROM buses");
            while($b = $buses->fetch_assoc()){
                echo "<option value='{$b['id']}'>{$b['bus_name']} ({$b['bus_no']})</option>";
            }
            ?>
        </select>

        <input name="source" placeholder="Starting Point" required>
        <input type="time" name="source_time" required>

        <input name="destination" placeholder="Destination Point" required>
        <input type="time" name="destination_time" required>

        <button name="add">Add Route</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Bus</th>
            <th>Bus No</th>
            <th>Start</th>
            <th>Time</th>
            <th>Destination</th>
            <th>Time</th>
            <th>Action</th>
        </tr>

        <?php
        $res = $conn->query("SELECT * FROM routes");
        while($row = $res->fetch_assoc()){
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['bus_name'] ?></td>
            <td><?= $row['bus_no'] ?></td>
            <td><?= $row['source'] ?></td>
            <td><?= $row['source_time'] ?></td>
            <td><?= $row['destination'] ?></td>
            <td><?= $row['destination_time'] ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>