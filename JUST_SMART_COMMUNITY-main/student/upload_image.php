<?php
session_start();
/** @var mysqli $conn */
include '../database/db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}
$id = $_SESSION['user_id'];

if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0){
    $allowed = ['image/jpeg', 'image/png', 'image/jpg'];
    if (in_array($_FILES['profile_image']['type'], $allowed)) {

    $file = $_FILES['profile_image'];
$uploadDir = "../user_profile_images/";


    $fileName = time() . "_" . basename($file['name']);
$target = $uploadDir . $fileName;
  

    if(move_uploaded_file($file['tmp_name'], $target)){

        $sql = "UPDATE users
                SET profile_image = '$fileName'
                WHERE id = $id";

        mysqli_query($conn, $sql);
    }
}
}

header("Location: profile.php");
exit();