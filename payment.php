<?php
session_start();
include("../config/db.php");

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Pay Fees</title>

<style>
body {
    font-family: Arial;
    background: #f1f5f9;
}

.container {
    width: 420px;
    margin: 50px auto;
    text-align: center;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

input {
    padding: 12px;
    width: 85%;
    margin: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    transition: 0.3s;
}

input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 8px rgba(37,99,235,0.3);
}

button {
    padding: 12px 25px;
    background: #16a34a;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

button.loading {
    background: gray;
    cursor: not-allowed;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

td, th {
    border: 1px solid #ddd;
    padding: 10px;
}

.success-box {
    background: #dcfce7;
    color: #166534;
    padding: 10px;
    margin-top: 10px;
    border-radius: 6px;
    display: none;
}

.delete-btn {
    color: red;
    cursor: pointer;
}
</style>

</head>

<body>

<div class="container">

<h2>Pay Bus Fees 💳</h2>

<input type="number" id="amount" placeholder="Enter Amount">

<br>

<button id="payBtn" onclick="payNow()">Pay Now</button>

<div class="success-box" id="successBox">✅ Payment Successful!</div>

<h3>Payment History</h3>

<table id="paymentTable">
<tr>
<th>Amount</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM payments WHERE user_id=$user_id");

while($row = $res->fetch_assoc()){
?>
<tr id="row<?= $row['id'] ?>">
<td><?= $row['amount'] ?></td>
<td><?= $row['status'] ?></td>
<td><span class="delete-btn" onclick="deletePayment(<?= $row['id'] ?>)">Delete</span></td>
</tr>
<?php } ?>

</table>

</div>

<script>

function payNow(){
    let amount = document.getElementById("amount").value;
    let btn = document.getElementById("payBtn");

    if(!amount || amount <= 0){
        alert("Enter valid amount");
        return;
    }

    // Loading state
    btn.innerText = "Processing...";
    btn.classList.add("loading");

    fetch("save_payment.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "amount=" + amount
    })
    .then(res => res.text())
    .then(data => {

        // Reset button
        btn.innerText = "Pay Now";
        btn.classList.remove("loading");

        // Show success
        let box = document.getElementById("successBox");
        box.style.display = "block";

        setTimeout(() => box.style.display = "none", 2000);

        // Add row dynamically
        let table = document.getElementById("paymentTable");
        let row = table.insertRow();

        row.innerHTML = `
            <td>${amount}</td>
            <td>Paid</td>
            <td><span class="delete-btn">Delete</span></td>
        `;

        document.getElementById("amount").value = "";
    });
}

function deletePayment(id){
    if(!confirm("Delete this payment?")) return;

    fetch("delete_payment.php?id=" + id)
    .then(res => res.text())
    .then(data => {
        document.getElementById("row"+id).remove();
    });
}

</script>

</body>
</html>