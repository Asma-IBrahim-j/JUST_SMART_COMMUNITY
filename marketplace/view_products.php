<?php
session_start();
include "../database/db_connection.php";

$sql = "SELECT p.*, u.name FROM products p JOIN users u ON p.user_id = u.id WHERE p.status='approved'";
$res = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>Marketplace</title>
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

    <h1>Student Marketplace</h1>

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

            <small>
                by <?= $row['name'] ?>
            </small>

            <br>

            <a class="btn btn-primary"
               href="request_product.php?id=<?= $row['id'] ?>">
               Request
            </a>

        </div>

    <?php endwhile; ?>

    </div>

</div>

</body>
</html>