<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
if(!isset($_GET['cid'])){

    header("Location: view_cafeterias.php");
    exit();
}

$cafeteria_id = $_GET['cid'];
$cafeteria_query = mysqli_query($conn,
    "SELECT name FROM cafeterias WHERE id = $cafeteria_id"
);

$cafeteria_name = mysqli_fetch_assoc($cafeteria_query);
if(isset($_GET['search'])){

    $search = $_GET['search'];

    $query = "
    SELECT *
    FROM meals

    WHERE cafeteria_id = $cafeteria_id

    AND (
        name LIKE '%$search%'
        OR description LIKE '%$search%'
    )
    ";

}else{

    $query = "
    SELECT *
    FROM meals
    WHERE cafeteria_id = $cafeteria_id
    ";
}

$result = mysqli_query($conn, $query);
?>
<html>
    <head>
         <title>Meals</title>
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

    <a href="view.php">
        My Orders
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

<h1>

    <?php echo $cafeteria_name['name']; ?>

</h1>
<form method="GET" class="search-form">

    <input type="hidden"
           name="cid"
           value="<?= $cafeteria_id ?>">

    <input type="text"
           name="search"
           placeholder="Search meals">

    <button type="submit">
        Search
    </button>

</form>

<div class="page-container">

<div class="meals-container">

<?php if(mysqli_num_rows($result) == 0 && isset($_GET['search'])){ ?>

<div class="empty-state">

<?php if(isset($_GET['search'])){ ?>

<h3>

   No matching items found

</h3>

<?php }else{ ?>

<h3>
    No meals found
</h3>

<?php } ?>

<p>
    Try searching for another meal or drink.
</p>

</div>

<?php } ?>
<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="meal-item">

   <img class="meal-image"
     src="<?= $row['image'] ?>">

    <h3>
        <?= $row['name'] ?>
    </h3>

    <p>
        <?= $row['description'] ?>
    </p>

    <div class="price-qty">

        <p class="price"
           data-price="<?= $row['price'] ?>">

           <?= $row['price'] ?> JD

        </p>

        <input type="number"
               value="1"
               min="1"
               class="qty">

    </div>

    <span class="total">

        Total price:
        <?= $row['price'] ?> JD

    </span>

    <form class="order-form"
      method="POST"
      action="../orders/create_order.php">

        <input type="hidden"
               name="meal_id"
               value="<?= $row['id'] ?>">

        <input type="hidden"
               name="quantity"
               value="1"
               class="hidden-qty">

        <button type="submit"
                class="order-btn"
                data-name="<?= $row['name'] ?>"
                data-price="<?= $row['price'] ?>">

            Add to My Order

        </button>

    </form>

</div>

<?php } ?>

</div>

<div class="order-section">

    <h3>
        My Order
    </h3>

    <div class="order-items"
         id="order-items">

        <p>No items yet</p>

    </div>

    <div class="order-total"
         id="total-price">

        Total: 0 JD

    </div>

</div>

</div>

</div>

<script src="./Myorder.js"></script>

</body>
</html>