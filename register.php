<?php
include("config/db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = "";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password_raw = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Check password match
    if($password_raw !== $confirm){
        $msg = "❌ Passwords do not match!";
    } else {

        $password = password_hash($password_raw, PASSWORD_BCRYPT);

        // Check if email already exists
        $check = $conn->query("SELECT * FROM users WHERE email='$email'");
        if($check->num_rows > 0){
            $msg = "❌ Email already exists!";
        } else {
            $conn->query("INSERT INTO users(name,email,password,role)
                          VALUES('$name','$email','$password','$role')");

            // Auto redirect after 2 seconds
            header("refresh:2;url=login.php");
            $msg = "✅ Registered successfully! Redirecting to login...";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: linear-gradient(135deg,#10b981,#3b82f6);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .register-container {
            background:white;
            padding:30px;
            width:400px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 15px 35px rgba(0,0,0,0.2);
        }

        .register-container h2 {
            margin-bottom:20px;
        }

        input, select {
            width:90%;
            padding:12px;
            margin:10px 0;
            border-radius:8px;
            border:1px solid #ddd;
            transition:0.3s;
        }

        input:focus, select:focus {
            border-color:#2563eb;
            box-shadow:0 0 8px rgba(37,99,235,0.3);
        }

        button {
            width:95%;
            background:#10b981;
            color:white;
            border:none;
            padding:12px;
            border-radius:8px;
            cursor:pointer;
            transition:0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow:0 10px 20px rgba(16,185,129,0.3);
        }

        .msg {
            margin:10px 0;
            font-weight:500;
        }

        .success { color:green; }
        .error { color:red; }

        a {
            text-decoration:none;
            color:#2563eb;
        }
    </style>
</head>

<body>

<div class="register-container">
    <h2>Create Account</h2>

    <?php if($msg != ""): ?>
        <div class="msg <?= strpos($msg,'❌') !== false ? 'error' : 'success' ?>">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>

        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
            <option value="driver">Driver</option>
        </select>

        <button name="register">Register</button>
    </form>

    <p style="margin-top:10px;">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>

<!-- Password Strength Script -->
<script>
const passwordInput = document.querySelector('input[name="password"]');

passwordInput.addEventListener('input', function() {
    let value = passwordInput.value;
    let strength = "Weak";

    if(value.length > 8 && /[A-Z]/.test(value) && /[0-9]/.test(value)){
        strength = "Strong";
    } else if(value.length >= 6){
        strength = "Medium";
    }

    passwordInput.style.borderColor =
        strength === "Strong" ? "green" :
        strength === "Medium" ? "orange" : "red";
});
</script>

</body>
</html>