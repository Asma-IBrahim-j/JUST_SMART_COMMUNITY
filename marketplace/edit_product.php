<?php
session_start();

include "../database/db_connection.php";

$id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$sql = "
SELECT *
FROM products
WHERE id = $id
AND user_id = $user_id
";

$res = mysqli_query($conn, $sql);

$pro = mysqli_fetch_assoc($res);

if (isset($_POST['save'])) {

    $title = $_POST['title'];

    $desc = $_POST['desc'];

    $price = $_POST['price'];

    $up = "
    UPDATE products
    SET
        title='$title',
        description='$desc',
        price='$price'
    WHERE id=$id
    ";

    mysqli_query($conn, $up);

    header("Location: my_products.php");
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Product</title>

    <link rel="stylesheet"
          href="../assets/css/marketplace.css">

</head>

<body>

<div class="navbar">

    <a href="view_products.php">
        Marketplace
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

<div class="product-card">

    <h1>
        Edit Product
    </h1>

    <form method="POST">

        <label>Title</label>

        <input type="text"
               name="title"
               value="<?php echo $pro['title']; ?>"
               required>

        <label>Description</label>

        <textarea name="desc"
                  rows="5"
                  required><?php echo $pro['description']; ?></textarea>

        <label>Price</label>

        <input type="text"
               name="price"
               value="<?php echo $pro['price']; ?>"
               required>

        <button type="submit"
                name="save">

            Save Changes

        </button>

        <br><br>

        <a class="btn btn-danger"
           href="my_products.php">

           Cancel

        </a>

    </form>

</div>

</div>

</body>
</html>