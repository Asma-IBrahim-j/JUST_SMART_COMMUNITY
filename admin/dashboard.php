<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Welcome Admin 👨‍💼</h1>

<ul>
    <li><a href="../admin/manage_users.php">Manage Users</a></li>
    <li><a href="../admin/manage_orders.php">Manage Orders</a></li>
    <li><a href="../lost_found/view.php">View Lost & Found</a></li>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="create_user.php">Create User</a></li>
</ul>
<br><br>
<a href="../auth/logout.php">Logout</a>
</body>
</html>