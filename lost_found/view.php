<?php
include "../database/db_connection.php";

$search = "";

/* DELETE */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM lost_items WHERE id=$id");
    header("Location: lost_found.php");
    exit;
}

/* MARK AS FOUND */
if (isset($_GET['found'])) {
    $id = $_GET['found'];
    mysqli_query($conn, "UPDATE lost_items SET status='found' WHERE id=$id");
    header("Location: lost_found.php");
    exit;
}

/* SEARCH + SELECT */
$is_search = isset($_GET['search']) && $_GET['search'] !== "";

if ($is_search) {

    $search = $_GET['search'];

    $sql = "SELECT * FROM lost_items
            WHERE title LIKE '%$search%'
            OR description LIKE '%$search%'
            OR location LIKE '%$search%'
            ORDER BY created_at DESC";

} else {

    $sql = "SELECT * FROM lost_items ORDER BY created_at DESC";
}

$result = mysqli_query($conn, $sql);
?>

<h2>Lost & Found Items</h2>

<!-- SEARCH FORM -->
<form method="GET">
    <input type="text" name="search" placeholder="Search item" value="<?php echo $search; ?>">
    <button type="submit">Search</button>
</form>

<br>

<a href="add_lost_item.php">Add New Item</a>

<br><br>

<?php
if ($is_search) {

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
?>

<div style="border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">

    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <small><?php echo $row['location']; ?></small>

    <br><br>

    Status:
    <b>
        <?php
        if ($row['status'] == 'lost') {
            echo "<span style='color:red;'>Lost</span>";
        } else {
            echo "<span style='color:green;'>Found</span>";
        }
        ?>
    </b>

    <br><br>

    <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a> |

    <a href="lost_found.php?delete=<?php echo $row['id']; ?>">Delete</a> |

    <a href="lost_found.php?found=<?php echo $row['id']; ?>">Mark as Found</a>

</div>

<?php
        }

    } else {
        echo "<h3>No items found</h3>";
    }

} else {

    while ($row = mysqli_fetch_assoc($result)) {
?>

<div style="border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">

    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['description']; ?></p>
    <small><?php echo $row['location']; ?></small>

    <br><br>

    Status:
    <b>
        <?php
        if ($row['status'] == 'lost') {
            echo "<span style='color:red;'>Lost</span>";
        } else {
            echo "<span style='color:green;'>Found</span>";
        }
        ?>
    </b>

    <br><br>

    <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a> |

    <a href="lost_found.php?delete=<?php echo $row['id']; ?>">Delete</a> |

    <a href="lost_found.php?found=<?php echo $row['id']; ?>">Mark as Found</a>

</div>

<?php
    }
}
?>