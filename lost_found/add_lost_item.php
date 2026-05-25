<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
if (isset($_POST['submit'])) {

    $title = $_POST['title'];

    $description = $_POST['description'];

    $location = $_POST['location'];

    $sql = "
    INSERT INTO lost_items
    (title, description, location)
    VALUES
    ('$title', '$description', '$location')
    ";

    mysqli_query($conn, $sql);

    $success = "Item added successfully";
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Lost Item</title>

    <link rel="stylesheet"
          href="../assets/css/lostfound.css">

</head>

<body>

<div class="navbar">

    <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">
        Dashboard
    </a>

    <a href="view.php">
        Lost & Found
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

<div class="item-card">

    <h1>
        Add Lost Item
    </h1>

    <?php
   if(isset($success)){
    echo "<div class='alert alert-success'>
            $success
          </div>";
     }
    ?>

    <form method="POST">

        <label>Item Title</label>

        <input type="text"
               name="title"
               placeholder="Enter item title"
               required>

        <label>Description</label>

        <textarea name="description"
                  rows="5"
                  placeholder="Describe the item.."></textarea>

        <label>Location</label>

        <input type="text"
               name="location"
               placeholder="Where was it lost?">

        <button type="submit"
                name="submit">

            Add Item

        </button>

    </form>

</div>

</div>

</body>
</html>