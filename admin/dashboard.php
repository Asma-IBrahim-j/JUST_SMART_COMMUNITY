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
    <li><a href="">View post requests</a></li><!-- Not implemented -->
  

       <li><a href="../marketplace/view_products.php">Student Marketplace</a></li>
        <li><a href="../orders/view_Cafeterias.php"> Cafeterias</a></li>
        <li><a href="../lost_found/view.php">Lost & Found</a></li>
       <li><a href="./registeration_requests.php">View Registeration Request</a></li>
       <li><a href="./create_user.php">Create New User</a></li>
</ul>
<br><br>
<a href="../auth/logout.php">Logout</a>
</body>
</html>