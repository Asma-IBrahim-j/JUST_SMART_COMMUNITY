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
    <link rel="stylesheet" href="../assets/css/marketplace.css">
</head>
<body>

<div class="navbar">

    <a href="view_products.php">Marketplace</a>

    <a href="add_product.php">Sell Something</a>

    <a href="my_products.php">My Products</a>

   <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">Dashboard</a>

    <a href="../auth/logout.php">Logout</a>

</div>

<div class="container">

    <h1>My Products</h1>

    <?php if(mysqli_num_rows($res) == 0): ?>

      <div class="empty-state">

    <h3>No Products Yet</h3>

    <p>
        Start selling your first product.
    </p>

</div>
        <a class="btn btn-primary"
           href="add_product.php">
           Add Product
        </a>

    <?php else: ?>

    <div class="product-grid">

        <?php while($row = mysqli_fetch_assoc($res)): ?>

        <div class="product-card">

            <?php if($row['image']){ ?>

                <img src="<?= $row['image'] ?>">

            <?php } ?>

            <h3><?= $row['title'] ?></h3>

            <p><?= $row['description'] ?></p>

            <p class="price">
                <?= $row['price'] ?> JD
            </p>

            <p>
                <strong>Status:</strong>
                <?= ucfirst($row['status']) ?>
            </p>

            <a class="btn btn-success"
               href="edit_product.php?id=<?= $row['id'] ?>">
               Edit
            </a>

            <a class="btn btn-danger"
   href="delete_product.php?id=<?= $row['id'] ?>"
   onclick="return confirm('Are you sure you want to delete this product?')">
               Delete
            </a>

        </div>

        <?php endwhile; ?>

    </div>

    <?php endif; ?>

</div>

</body>
</html>