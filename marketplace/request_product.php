<?php
session_start();
include "../database/db_connection.php";

$id = $_GET['id'];
$buyer = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($conn, $sql);
$pro = mysqli_fetch_assoc($res);

if (isset($_POST['send'])) {

    $msg = trim($_POST['msg']);

    if(empty($msg)){

        $error = "Message cannot be empty";

    } else {

        $insert = "
        INSERT INTO product_requests
        (product_id, buyer_id, seller_id, message)

        VALUES
        ($id, $buyer, " . $pro['user_id'] . ", '$msg')
        ";

        mysqli_query($conn, $insert);

        header("Location: view_products.php");

        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>
        Request Product
    </title>

    <link rel="stylesheet"
          href="../assets/css/marketplace.css">

</head>

<body>

<div class="navbar">

    <a href="view_products.php">
        Marketplace
    </a>

    <a href="add_product.php">
        Sell Something
    </a>

    <a href="my_products.php">
        My Products
    </a>

    <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">
        Dashboard
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

<div class="request-card">

    <h1>

        Request:
        <?= $pro['title']; ?>

    </h1>
    <?php if(isset($error)){ ?>

   <div class="alert alert-error">

    <?= $error ?>

     </div>

    <?php } ?>
    <p class="request-text">

        Send a message to the seller
        to request this product.

    </p>

    <form method="POST">

        <label>
            Message
        </label>

        <textarea
         name="msg"
         rows="6"
         placeholder="Write your request here..."
         required></textarea>
        <div class="request-actions">

            <button type="submit"
                    name="send"
                    class="order-btn">

                Send Request

            </button>

            <a class="cancel-btn"
               href="view_products.php">

               Cancel

            </a>

        </div>

    </form>

</div>

</div>

</body>
</html>