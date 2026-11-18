<?php
session_start();
include "../database/db_connection.php";

/** @var mysqli $conn */

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

/* APPROVE PRODUCT */
if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    mysqli_query($conn,
        "UPDATE products 
         SET status='approved'
         WHERE id=$id"
    );

    header("Location: product_requests.php");
    exit();
}

/* DELETE PRODUCT */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,
        "DELETE FROM products
         WHERE id=$id"
    );

    header("Location: product_requests.php");
    exit();
}

/* GET PENDING PRODUCTS */
$query = "
SELECT 
    products.*,
    users.name AS seller_name
FROM products
JOIN users ON products.user_id = users.id
WHERE status='pending'
ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Product Requests</title>
     <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="navbar">

    <a href="dashboard.php">Dashboard</a>

    <a href="../auth/logout.php">Logout</a>

</div>

<div class="container">

<h1 class="page-title">
    Pending Product Requests
</h1>

<?php

if(mysqli_num_rows($result)==0){

    echo "<div class='card'><h3>No Pending Products</h3></div>";

}else{

while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

    <h2>
        <?= $row['title'] ?>
    </h2>

    <p>

        <strong>Seller:</strong>

        <?= $row['seller_name'] ?>

    </p>

    <p>
        <?= $row['description'] ?>
    </p>

    <p>

        <strong>Price:</strong>

        <?= $row['price'] ?> JD

    </p>

    <?php if($row['image']){ ?>

        <img
            src="../marketplace/<?= $row['image'] ?>"
            style="
                width:250px;
                border-radius:10px;
                margin-top:10px;
            ">

    <?php } ?>

    <br><br>

    <a class="btn btn-success"
       href="product_requests.php?approve=<?= $row['id'] ?>">

       Approve

    </a>

    <a class="btn btn-danger"
   onclick="return confirm('Reject this product?')"
       href="product_requests.php?delete=<?= $row['id'] ?>">

       Reject

    </a>

</div>

<?php
}
}
?>

</div>

</body>
</html>