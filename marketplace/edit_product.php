<?php
session_start();
include "../database/db_connection.php";

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products WHERE id = $id AND user_id = $user_id";
$res = mysqli_query($conn, $sql);
$pro = mysqli_fetch_assoc($res);

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    
    $up = "UPDATE products SET title='$title', description='$desc', price='$price' WHERE id=$id";
    mysqli_query($conn, $up);
    header("Location: my_products.php");
}
?>

<html>
<head>
    <title>Edit</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST">
        Title: <input type="text" name="title" value="<?php echo $pro['title']; ?>"><br><br>
        Description: <br>
        <textarea name="desc" rows="5" cols="30"><?php echo $pro['description']; ?></textarea><br><br>
        Price: <input type="text" name="price" value="<?php echo $pro['price']; ?>"><br><br>
        <input type="submit" name="save" value="Save Changes">
        <a href="my_products.php">Cancel</a>
    </form>
</body>
</html>