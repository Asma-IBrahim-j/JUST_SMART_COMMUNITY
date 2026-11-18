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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="../assets/js/main.js"> </script>
</head>

<body>

    <div class="navbar">

        <h2>JUST Smart Community</h2>
        <div class="profile-container">

            <img src="../user_profile_images/<?= $_SESSION['profile_image'] ?>" class="avatar" onclick="toggleMenu()" alt="Profile">
            <div id="sidebar" class="sidebar">
                <div class="profile-info">
                    <img src="../user_profile_images/<?= $_SESSION['profile_image'] ?>" alt="Profile">
                    <h3><?= $_SESSION['name'] ?></h3>

                </div>

                <ul>
                    <li><a href="profile.php"><i class="fa-solid fa-user"></i>My Profile</a></li>
                    <li><a href="settings.php"> <i class="fa-solid fa-gear"></i>
                            Settings</a></li>

                    <li><a href="delivery_students.php"> <i class="fa-solid fa-person-walking"></i>
                            Work With Us</a></li>
                    <li><a href="about_us.php"> <i class="fa-solid fa-circle-info"></i>
                            About Us </a></li>
                    <li><a href="../auth/logout.php"> <i class="fa-solid fa-right-from-bracket"></i>
                            Logout</a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="container">

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