<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/** @var mysqli $conn */
include '../database/db_connection.php';

$id = $_SESSION['user_id'];

$name = mysqli_real_escape_string(
    $conn,
    $_POST['name']
);

$faculty = mysqli_real_escape_string(
    $conn,
    $_POST['faculty']
);

$sql = "UPDATE users
        SET name = '$name',
            faculty = '$faculty'
        WHERE id = $id";

mysqli_query($conn, $sql);

header("Location: profile.php");

exit();
?>