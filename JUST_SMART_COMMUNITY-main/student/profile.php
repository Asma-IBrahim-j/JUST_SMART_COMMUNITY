<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "student") {
    header("Location: ../auth/login.php");
    exit();
}
/** @var mysqli $conn */
include '../database/db_connection.php';

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<html>

<head>
    <link rel="stylesheet" href="../assets/css/profile.css">
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="body">
    <div class="profile-page">

        <div class="profile-card">

            <div class="profile-image-container">
                <form action="upload_image.php" method="POST" enctype="multipart/form-data">

                    <input type="file"
                        name="profile_image"
                        id="imageInput"
                        hidden
                        onchange="this.form.submit()">
                    <img src="../user_profile_images/<?= $user['profile_image'] ?>" alt="Profile" class="profile-image">
                    <button class="edit-image-btn" onclick="document.getElementById('imageInput').click()" type="button">

                        <i class="fa-solid fa-camera"></i>
                    </button>
                </form>
            </div>




            <div class="profile-info">
                <h2><?= $user['name'] ?> </h2>
                <p><strong>Email:</strong> <?= $user['email'] ?></p>
                <p><strong>Faculty:</strong> <?= empty($user['faculty']) ? "Not specified" : $user['faculty']  ?></p>
<a href="edit_profile.php">
                <button class="profile-info-button" >Edit Profile</button></a>
            </div>

        </div>
      <div class="account-setting-card">

    <h2>Account Settings</h2>

    <div class="setting-option">

        <div>
            <h3>Change Password</h3>
            <p>Update your account password.</p>
        </div>

        <a href="change_password.php" class="change-btn">
            Change
        </a>

    </div>

    <div class="setting-option danger">

        <div>
            <h3>Delete Account</h3>
            <p>Permanently remove your account.</p>
        </div>

        <a href="delete_account.php" class="delete-btn">
            Delete
        </a>

    </div>

</div>

    </div>
</body>

</html>