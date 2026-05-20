<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "student") {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Dashboard</title>
</head>

<body>

    <h1>Welcome <?= $_SESSION['name'] ?> </h1>

    <ul>
        <li><a href="../marketplace/view_products.php">Student Marketplace</a></li>
        <li><a href="../orders/view_Cafeterias.php"> Cafeterias</a></li>
        <li><a href="../lost_found/view.php">Lost & Found</a></li>
    </ul>
    <br><br>
    <a href="../auth/logout.php">Logout</a>
</body>

</html>