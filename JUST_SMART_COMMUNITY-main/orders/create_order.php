<?php
session_start();
include "../database/db_connection.php";

/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$meal_id = $_POST['meal_id'];
$quantity = $_POST['quantity'];

$query = "INSERT INTO orders 
(user_id, meal_id, quantity, status, payment_status)
VALUES 
($user_id, $meal_id, $quantity, 'preparing', 'unpaid')";

$result = mysqli_query($conn, $query);

if ($result) {

    header("Location: view.php");
    exit();

} else {

    die("Error: " . mysqli_error($conn));
}
?>