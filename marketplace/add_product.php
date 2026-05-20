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
              VALUES ('$user_id', '$title', '$description', '$price', '$image', 'approved')";
    
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
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .navbar { background: #2c3e50; padding: 15px; color: white; }
        .navbar a { color: white; text-decoration: none; padding: 10px 15px; }
        .container { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        input, textarea, select { width: 100%; padding: 8px; margin: 5px 0 15px; border: 1px solid #ddd; border-radius: 5px; }
        input[type=submit] { background: #27ae60; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="view_products.php">Marketplace</a>
        <a href="add_product.php">Sell Something</a>
        <a href="../student/dashboard.php">Dashboard</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Add New Product/Service</h1>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>
            
            <label>Description:</label>
            <textarea name="description" rows="5" required></textarea>
            
            <label>Price (JD):</label>
            <input type="number" step="0.01" name="price" required>
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*">
            
            <input type="submit" value="Add Product">
        </form>
    </div>
</body>
</html>