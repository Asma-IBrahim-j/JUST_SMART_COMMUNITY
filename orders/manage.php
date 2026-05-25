<?php
session_start();
include "../database/db_connection.php";

/** @var mysqli $conn */

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "canteen") {
    header("Location: ../auth/login.php");
    exit();
}

/* UPDATE ORDER STATUS */
if (isset($_POST['update'])) {

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $payment = $_POST['payment_status'];

    $query = "
    UPDATE orders
    SET 
        status='$status',
        payment_status='$payment'
    WHERE id=$order_id
    ";

    mysqli_query($conn, $query);

    header("Location: manage.php");
    exit();
}

/* GET ORDERS */
$query = "
SELECT 
    orders.*,
    users.name AS student_name,
    meals.name AS meal_name
FROM orders
JOIN users ON orders.user_id = users.id
JOIN meals ON orders.meal_id = meals.id
ORDER BY orders.created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Orders</title>

    <link rel="stylesheet" href="../assets/css/orderstyle.css">

</head>

<body>

<div class="navbar">

    <a href="../canteen/dashboard.php">
        Dashboard
    </a>

    <a href="../orders/view.php">
        View Orders
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

<h1>
    Manage Orders
</h1>

<?php

if(mysqli_num_rows($result) == 0){

    echo "<h3>No Orders Found</h3>";

}else{

while($row = mysqli_fetch_assoc($result)){

?>

<div class="order-card">

    <h2>
        <?= $row['meal_name'] ?>
    </h2>

    <p>

        <strong>Student:</strong>

        <?= $row['student_name'] ?>

    </p>

    <p>

        <strong>Quantity:</strong>

        <?= $row['quantity'] ?>

    </p>

    <p>

        <strong>Current Status:</strong>

        <span class="status <?= $row['status'] ?>">

            <?= ucfirst($row['status']) ?>

        </span>

    </p>

    <p>

        <strong>Payment:</strong>

        <span class="<?= $row['payment_status'] ?>">

            <?= ucfirst($row['payment_status']) ?>

        </span>

    </p>

    <form method="POST">

        <input type="hidden"
               name="order_id"
               value="<?= $row['id'] ?>">

        <label>Status</label>

        <select name="status">

            <option value="preparing"
                <?= $row['status']=="preparing" ? "selected" : "" ?>>

                Preparing

            </option>

            <option value="completed"
                <?= $row['status']=="completed" ? "selected" : "" ?>>

                Completed

            </option>

        </select>

        <br><br>

        <label>Payment Status</label>

        <select name="payment_status">

            <option value="unpaid"
                <?= $row['payment_status']=="unpaid" ? "selected" : "" ?>>

                Unpaid

            </option>

            <option value="paid"
                <?= $row['payment_status']=="paid" ? "selected" : "" ?>>

                Paid

            </option>

        </select>

        <br><br>

        <button type="submit"
                class="order-btn"
                name="update">

            Update Order

        </button>

    </form>

</div>

<?php
}
}
?>

</div>

</body>
</html>