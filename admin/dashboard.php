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
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div class="navbar">

    <h2>Admin Dashboard</h2>

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

            <h3>Marketplace</h3>

            <p>
                View marketplace products and requests.
            </p>

            <a class="dashboard-btn"
               href="../marketplace/view_products.php">
               Open Marketplace
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Product Requests</h3>

            <p>
                Approve or reject pending products.
            </p>

            <a class="dashboard-btn"
               href="product_requests.php">
               Manage Requests
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Manage Users</h3>

            <p>
                Create, delete, and update user roles.
            </p>

            <a class="dashboard-btn"
               href="manage_users.php">
               Manage Users
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Registration Requests</h3>

            <p>
                Approve external JUST community accounts.
            </p>

            <a class="dashboard-btn"
               href="registration_requests.php">
               View Requests
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Lost & Found</h3>

            <p>
                Monitor lost and found reports.
            </p>

            <a class="dashboard-btn"
               href="../lost_found/view.php">
               Open Lost & Found
            </a>

        </div>

        <div class="dashboard-card">

            <h3>Cafeterias</h3>

            <p>
                Monitor cafeteria orders and meals.
            </p>

            <a class="dashboard-btn"
               href="../orders/view_cafeterias.php">
               View Cafeterias
            </a>

        </div>

    </div>

</div>

</body>
</html>