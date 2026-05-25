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
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

<div class="navbar">

    <h2>JUST Smart Community</h2>

    <div class="nav-links">

        <a href="../auth/logout.php">Logout</a>

    </div>

</div>

<div class="container">

    <h1>
        Welcome <?= $_SESSION['name'] ?>
    </h1>

    <br>

    <div class="dashboard-grid">

        <div class="dashboard-card">

            <h3>Student Marketplace</h3>

            <p>
                Buy and sell products and services with students.
            </p>

            <a class="dashboard-btn"
               href="../marketplace/view_products.php">
               Open Marketplace
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Cafeterias</h3>

            <p>
                Order food from campus cafeterias.
            </p>

            <a class="dashboard-btn"
               href="../orders/view_cafeterias.php">
               View Cafeterias
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Lost & Found</h3>

            <p>
                Report or search for lost items.
            </p>

            <a class="dashboard-btn"
               href="../lost_found/view.php">
               Open Lost & Found
            </a>

        </div>

    </div>

</div>

</body>

</html>