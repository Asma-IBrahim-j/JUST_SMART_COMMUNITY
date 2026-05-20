<?php
session_start();
include "../database/db_connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM products WHERE user_id = $user_id ORDER BY created_at DESC";
$res = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>My Products</title>
</head>
<body>
    <h1>My Products</h1>
    <a href="view_products.php">Marketplace</a>
    <a href="add_product.php">Sell Something</a>
    <a href="../auth/logout.php">Logout</a>
    <hr>

    <?php if(mysqli_num_rows($res) == 0): ?>
        <p>You haven't added any products yet.</p>
        <a href="add_product.php">Add your first product</a>
    <?php else: ?>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px; width:300px">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <b><?php echo $row['price']; ?> JD</b><br>
                <small>Status: <?php echo $row['status']; ?></small><br><br>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</body>
</html>