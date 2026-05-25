<?php
session_start();
include "../database/db_connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
  
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $image = $target_dir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }
    
    $query = "INSERT INTO products (user_id, title, description, price, image, status) 
              VALUES ('$user_id', '$title', '$description', '$price', '$image', 'pending')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Product added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - JUST Smart Community</title>
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

<div class="sell-container">

    <div class="sell-card">
        <h1>Add New Product / Service</h1>

        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <?php if(isset($success)) echo "<div class='alert alert-success'>
        $success
        </div>"; ?>

        <form method="POST" enctype="multipart/form-data">

            <label>Title</label>

            <input type="text"
                   name="title"
                   required>

            <label>Description</label>

            <textarea name="description"
                      rows="5"
                      required></textarea>

            <label>Price (JD)</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   required>

            <label>Image</label>

           <input class="file-input"
               type="file"
               name="image"
               accept="image/*">

            <button class="sell-btn"
                 type="submit">

              Add Product

            </button>

        </form>

    </div>

</div>

</body>
</html>