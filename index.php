<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$role = $_SESSION['role'];

if ($role == "student") {
    echo "Welcome Student 👨‍🎓";
} elseif ($role == "seller") {
    echo "Welcome Seller 🛍️";
} elseif ($role == "admin") {
    echo "Welcome Admin 🛠️";
}
?>