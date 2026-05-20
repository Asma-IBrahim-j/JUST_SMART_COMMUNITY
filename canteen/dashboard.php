<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "canteen") {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Canteen Dashboard</title>
</head>
<body>

<h1>Welcome Canteen Owner 🍔</h1>

<ul>
    <li><a href="../orders/view.php">View Orders</a></li>
    <li><a href="../orders/manage.php">Manage Order Status</a></li>
</ul>
<br><br>
<a href="../auth/logout.php">Logout</a>
</body>
</html>