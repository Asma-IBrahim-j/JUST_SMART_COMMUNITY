<?php
include "../database/db_connection.php";

$id = $_GET['id'];

$sql = "SELECT * FROM lost_items WHERE id=$id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $update_sql = "UPDATE lost_items 
                   SET title='$title',
                       description='$description',
                       location='$location'
                   WHERE id=$id";

    mysqli_query($conn, $update_sql);

    header("Location: lost_found.php");
}
?>

<h2>Edit Item</h2>

<form method="POST">

    Title:
    <input type="text" name="title"
           value="<?php echo $row['title']; ?>" required>

    <br><br>

    Description:
    <textarea name="description"><?php echo $row['description']; ?></textarea>

    <br><br>

    Location:
    <input type="text" name="location"
           value="<?php echo $row['location']; ?>">

    <br><br>

    <button type="submit" name="update">
        Update
    </button>

</form>