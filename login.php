<?php
session_start();
include("config/db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";

// Handle login
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // selected role

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res->num_rows > 0){
        $user = $res->fetch_assoc();

        if(password_verify($password,$user['password'])){

            // Check if selected role matches DB role
            if($user['role'] != $role){
                $error = "❌ Wrong role selected!";
            } else {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if($role == "admin"){
                    header("Location: admin/dashboard.php");
                    exit();
                } elseif($role == "student"){
                    header("Location: student/dashboard.php");
                    exit();
                } elseif($role == "driver"){
                    header("Location: driver/dashboard.php");
                    exit();
                }
            }

        } else {
            $error = "❌ Wrong Password";
        }
    } else {
        $error = "❌ User not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: linear-gradient(135deg,#3b82f6,#0ea5e9);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-container {
            background:white;
            padding:30px;
            width:380px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 15px 35px rgba(0,0,0,0.2);
        }

        input, select {
            width:90%;
            padding:12px;
            margin:10px 0;
            border-radius:8px;
            border:1px solid #ddd;
        }

        button {
            width:95%;
            background:#2563eb;
            color:white;
            border:none;
            padding:12px;
            border-radius:8px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow:0 10px 20px rgba(37,99,235,0.3);
        }

        .error {
            color:red;
            margin:10px 0;
        }
    </style>
</head>

<body>

<div class="login-container">
    <h2>Login Portal</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>

        <!-- Role Selection -->
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
            <option value="driver">Driver</option>
        </select>

        <?php if($error != "") echo "<div class='error'>$error</div>"; ?>

        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>