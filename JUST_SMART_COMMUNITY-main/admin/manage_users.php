<?php
session_start();
 include "../database/db_connection.php";
/** @var mysqli $conn */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

// Delete User
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM users WHERE id = $id");

    header("Location: manage_users.php");
    exit();
}

// Update Role
if (isset($_POST['update_role'])) {

    $id = $_POST['id'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET role='$role' WHERE id=$id");

    header("Location: manage_users.php");
    exit();
}

// Get Users
$result = mysqli_query($conn, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="navbar">

    <a href="dashboard.php">Dashboard</a>

    <a href="../auth/logout.php">Logout</a>

</div>

<div class="container">

<h1 class="page-title">
    Manage Users
</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Actions</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td><?= $row['id'] ?></td>

    <td><?= $row['name'] ?></td>

    <td><?= $row['email'] ?></td>

    <td><?= $row['role'] ?></td>

    <td>

        <!-- Delete -->
<a class="btn btn-danger"
   onclick="return confirm('Delete this user?')"
   href="manage_users.php?delete=<?= $row['id'] ?>">
   Delete
</a>

        <br><br>

        <!-- Change Role -->

        <form method="POST">

            <input type="hidden" name="id" value="<?= $row['id'] ?>">

<select name="role">

    <option value="student"
        <?= $row['role'] == 'student' ? 'selected' : '' ?>>
        Student
    </option>

    <option value="canteen"
        <?= $row['role'] == 'canteen' ? 'selected' : '' ?>>
        Canteen
    </option>

    <option value="admin"
        <?= $row['role'] == 'admin' ? 'selected' : '' ?>>
        Admin
    </option>

</select>
           <button class="btn btn-primary"
                type="submit"
                name="update_role">

            Update

          </button>

        </form>

    </td>

</tr>

<?php } ?>

</table>

<br>

<a href="dashboard.php">Back To Dashboard</a>
</div>
</body>
</html>