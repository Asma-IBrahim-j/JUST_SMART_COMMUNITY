<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/** @var mysqli $conn */
include '../database/db_connection.php';

$id = $_SESSION['user_id'];

$currentPassword = $_POST['current_password'];

$newPassword = $_POST['new_password'];

$confirmPassword = $_POST['confirm_password'];

if (strlen($newPassword) < 6) {

    header("Location: change_password.php?error=password_less_than_6_characters");
exit();
}

if ($newPassword !== $confirmPassword) {

    header("Location: change_password.php?error=password_mismatch");
exit();
}

$sql = "SELECT password
        FROM users
        WHERE id = $id";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

if (!password_verify(
    $currentPassword,
    $user['password']
)) {

header("Location: change_password.php?error=wrong_password");
exit();
}

$newHashedPassword = password_hash(
    $newPassword,
    PASSWORD_DEFAULT
);

$sql = "UPDATE users
        SET password = '$newHashedPassword'
        WHERE id = $id";

mysqli_query($conn, $sql);

header("Location: profile.php");

exit();