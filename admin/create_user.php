<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['create'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, role)
              VALUES ('$name', '$email', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "User created successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>

<div class="navbar">

    <a href="dashboard.php">Dashboard</a>

    <a href="../auth/logout.php">Logout</a>

</div>

<div class="container">

<div class="card">

    <h1 class="page-title">
        Create New User
    </h1>

    <form method="POST">

        <label>Name</label>

        <input type="text"
               name="name"
               placeholder="Name"
               required>

        <label>Email</label>

        <input type="email"
               name="email"
               placeholder="Email"
               required>

        <label>Password</label>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <label>Role</label>

        <select name="role" required>

            <option value="">
                Select Role
            </option>

            <option value="student">
                Student
            </option>

            <option value="canteen">
                Canteen
            </option>

            <option value="admin">
                Admin
            </option>

        </select>

        <br><br>

        <button class="btn btn-primary"
                type="submit"
                name="create">

            Create User

        </button>

    </form>

</div>

</div>

</body>
</html>