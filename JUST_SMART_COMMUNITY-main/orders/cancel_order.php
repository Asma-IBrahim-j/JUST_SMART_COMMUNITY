<?php

session_start();

include "../database/db_connection.php";
/** @var mysqli $conn */
if(!isset($_SESSION['user_id'])){

    header("Location: ../auth/login.php");

    exit();
}

$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$query = "
DELETE FROM orders
WHERE id = $id
AND user_id = $user_id
AND status = 'preparing'
";

mysqli_query($conn, $query);

header("Location: view.php");
exit();

?>