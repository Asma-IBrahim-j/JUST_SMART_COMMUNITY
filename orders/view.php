<?php
session_start();
include "../database/db_connection.php";

/** @var mysqli $conn */

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT 
    orders.*,
    meals.name AS meal_name,
    meals.price,
    cafeterias.name AS cafeteria_name
FROM orders
JOIN meals ON orders.meal_id = meals.id
JOIN cafeterias ON meals.cafeteria_id = cafeterias.id
WHERE orders.user_id = $user_id
ORDER BY orders.created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Orders</title>

    <link rel="stylesheet" href="../assets/css/orderstyle.css">
</head>

<body>

<div class="navbar">

    <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">
        Dashboard
    </a>

    <a href="view_cafeterias.php">
        Cafeterias
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

<h1>
    My Orders
</h1>

<?php

if(mysqli_num_rows($result) == 0){

    echo "
<div class='empty-state'>

    <h3>No Orders Yet</h3>

    <p>
        Your orders will appear here.
    </p>

</div>
";

}else{

while($row = mysqli_fetch_assoc($result)){

?>

<div class="order-card">

    <h2>
        <?= $row['meal_name'] ?>
    </h2>

    <p>

        <strong>Cafeteria:</strong>

        <?= $row['cafeteria_name'] ?>

    </p>

    <p>

        <strong>Quantity:</strong>

        <?= $row['quantity'] ?>

    </p>

    <p>

        <strong>Total Price:</strong>

        <?= $row['price'] * $row['quantity'] ?> JD

    </p>

    <p>

    <strong>Status:</strong>

    <span class="status <?= $row['status'] ?>">

        <?= ucfirst($row['status']) ?>

    </span>

</p>

<?php if($row['status'] == 'preparing'){ ?>

    <a class="order-btn cancel-btn"
       href="cancel_order.php?id=<?= $row['id'] ?>"
       onclick="return confirm('Cancel this order?')">

       Cancel Order

    </a>

<?php } ?>
    <p>

        <strong>Payment:</strong>

        <span class="<?= $row['payment_status'] ?>">

            <?= ucfirst($row['payment_status']) ?>

        </span>

    </p>

    <p>

        <strong>Order Date:</strong>

        <?= $row['created_at'] ?>

    </p>

</div>

<?php
}
}
?>

</div>

</body>
</html>