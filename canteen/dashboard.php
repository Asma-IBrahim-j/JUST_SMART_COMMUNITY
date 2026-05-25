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
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="navbar">

    <h2>Canteen Dashboard</h2>

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

            <h3>View Orders</h3>

            <p>
                Monitor all student food orders.
            </p>

            <a class="dashboard-btn"
               href="../orders/view.php">
               View Orders
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Manage Order Status</h3>

            <p>
                Update preparing and completed orders.
            </p>

            <a class="dashboard-btn"
               href="../orders/manage.php">
               Manage Orders
            </a>

        </div>

        <div class="dashboard-card">

            <h3>View Cafeterias</h3>

            <p>
                Browse available cafeterias and meals.
            </p>

            <a class="dashboard-btn"
               href="../orders/view_cafeterias.php">
               Open Cafeterias
            </a>

        </div>

    </div>

</div>

</body>
</html>