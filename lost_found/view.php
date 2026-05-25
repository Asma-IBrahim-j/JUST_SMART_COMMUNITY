<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
$search = "";

/* DELETE ITEM */
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query($conn,
        "DELETE FROM lost_items WHERE id=$id"
    );

    header("Location: view.php");
    exit;
}

/* MARK AS FOUND */
if (isset($_GET['found'])) {

    $id = $_GET['found'];

    mysqli_query($conn,
        "UPDATE lost_items
         SET status='found'
         WHERE id=$id"
    );

    header("Location: view.php");
    exit;
}

/* SEARCH */
$is_search =
    isset($_GET['search']) &&
    $_GET['search'] !== "";

if ($is_search) {

    $search = $_GET['search'];

    $sql = "
    SELECT * FROM lost_items
    WHERE title LIKE '%$search%'
    OR description LIKE '%$search%'
    OR location LIKE '%$search%'
    ORDER BY created_at DESC
    ";

} else {

    $sql = "
    SELECT * FROM lost_items
    ORDER BY created_at DESC
    ";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Lost & Found</title>

    <link rel="stylesheet"
          href="../assets/css/lostfound.css">

</head>

<body>

<div class="navbar">

   <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">
        Dashboard
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

    <div class="top-bar">

        <h1>Lost & Found</h1>

        <a class="btn add-btn"
           href="add_lost_item.php">

           Add New Item

        </a>

    </div>

    <form class="search-form" method="GET">

        <input type="text"
               name="search"
               placeholder="Search item..."
               value="<?php echo $search; ?>">

        <button type="submit">
            Search
        </button>

    </form>

    <br>

    <div class="items-grid">

    <?php

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

    ?>

    <div class="item-card">

        <h3>
            <?php echo $row['title']; ?>
        </h3>

        <p>
            <?php echo $row['description']; ?>
        </p>

        <small>
            <?php echo $row['location']; ?>
        </small>

        <br><br>

        <p>

            <strong>Status:</strong>

            <span class="status <?= $row['status'] ?>">

                <?= ucfirst($row['status']) ?>

            </span>

        </p>

        <a class="btn btn-edit"
           href="edit_item.php?id=<?php echo $row['id']; ?>">

           Edit

        </a>

        <a class="btn btn-delete"
   href="view.php?delete=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this item?')">

           Delete

        </a>

        <a class="btn btn-found"
           href="view.php?found=<?php echo $row['id']; ?>">

           Mark as Found

        </a>

    </div>

    <?php
        }

    } else {

        echo "
<div class='empty-state'>

    <h3>No Items Found</h3>

    <p>
        Try another search or add a new item.
    </p>

</div>
";
    }
    ?>

    </div>

</div>

</body>
</html>