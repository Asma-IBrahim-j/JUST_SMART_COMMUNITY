<?php
include "../database/db_connection.php";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $sql = "INSERT INTO lost_items (title, description, location)
            VALUES ('$title', '$description', '$location')";

    mysqli_query($conn, $sql);

    echo "Item added successfully";
}
?>

<form method="POST">
    <h2>Add Lost Item</h2>

    Title: <input type="text" name="title" required><br><br>
    Description: <textarea name="description"></textarea><br><br>
    Location: <input type="text" name="location"><br><br>

    <button type="submit" name="submit">Add</button>
</form>