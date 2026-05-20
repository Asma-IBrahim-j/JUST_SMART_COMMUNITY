<?php
session_start();
include "../database/db_connection.php";
$id = $_GET['id'];
$buyer = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($conn, $sql);
$pro = mysqli_fetch_assoc($res);

if (isset($_POST['send'])) {
    $msg = $_POST['msg'];
    $insert = "INSERT INTO product_requests (product_id, buyer_id, seller_id, message) 
               VALUES ($id, $buyer, " . $pro['user_id'] . ", '$msg')";
    mysqli_query($conn, $insert);
    header("Location: view_products.php");
}
?>

<html>
<head>
    <title>Request Product</title>
</head>
<body>
    <h3>Request: <?php echo $pro['title']; ?></h3>
    <form method="POST">
        Message: <br>
        <textarea name="msg" rows="3" cols="35"></textarea><br><br>
        <input type="submit" name="send" value="Send Request">
        <a href="view_products.php">Cancel</a>
    </form>
</body>
</html>