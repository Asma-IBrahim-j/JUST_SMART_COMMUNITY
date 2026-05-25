<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
$id = $_GET['id'];

$sql = "SELECT * FROM lost_items WHERE id=$id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = $_POST['title'];

    $description = $_POST['description'];

    $location = $_POST['location'];

    $update_sql = "
    UPDATE lost_items
    SET
        title='$title',
        description='$description',
        location='$location'
    WHERE id=$id
    ";

    mysqli_query($conn, $update_sql);

    header("Location: view.php");
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Item</title>

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
        Edit Lost Item
    </h1>

    <form method="POST">

        <label>Item Title</label>

        <input type="text"
               name="title"
               value="<?php echo $row['title']; ?>"
               required>

        <label>Description</label>

        <textarea name="description"
                  rows="5"><?php echo $row['description']; ?></textarea>

        <label>Location</label>

        <input type="text"
               name="location"
               value="<?php echo $row['location']; ?>">

        <button type="submit"
                name="update">

            Update Item

        </button>

    </form>

</div>

</div>

</body>
</html>