<?php
session_start();
include "../database/db_connection.php";

$sql = "SELECT p.*, u.name FROM products p JOIN users u ON p.user_id = u.id WHERE p.status='approved'";
$res = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>Marketplace</title>
</head>
<body>
    <h1>Student Marketplace</h1>
    <a href="add_product.php">Sell Something</a>
    <a href="my_products.php">My Products</a>
    <a href="../auth/logout.php">Logout</a>
    <hr>
   
    <?php while($row = mysqli_fetch_assoc($res)): ?>
        <div style="border:1px solid #ccc; padding:10px; margin:10px; width:300px">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <b><?php echo $row['price']; ?> JD</b><br>
            <small>by <?php echo $row['name']; ?></small><br>
            <a href="request_product.php?id=<?php echo $row['id']; ?>">Request</a>
        </div>
    <?php endwhile; ?>
</body>
</html>