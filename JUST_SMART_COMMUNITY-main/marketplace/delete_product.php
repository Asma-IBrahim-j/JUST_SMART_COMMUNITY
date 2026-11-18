<?php
session_start();
include "../database/db_connection.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM products WHERE id = $id AND user_id = $user_id";
mysqli_query($conn, $sql);

header("Location: my_products.php");
?>