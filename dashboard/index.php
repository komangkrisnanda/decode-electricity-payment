<?php
    require_once "../config/connection.php";
    require_once "../helper/alert.php";

    if(@$_SESSION['Level'] != "Admin" && @$_SESSION['Level'] != "Operator"){
        alert("Not Authorized! Please login!", "../login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello, <?= $_SESSION['NamaLengkap'] ?></h1>
    <a href="../logout.php">Logout</a>
    <hr>

    <h3>Menu : </h3>
    <ul>
        <li><a href="#">Customers</a></li>
        <li><a href="#">Bills</a></li>
        <li><a href="#">Payments</a></li>
        <li><a href="#">Rates</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="../users/index.php">Users</a></li>
    </ul>
</body>
</html>