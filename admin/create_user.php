<?php
session_start();
include "../database/db_connection.php";

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
</head>
<body>

<h2>Create New User</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Name" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <select name="role" required>
        <option value="">Select Role</option>
        <option value="student">Student</option>
        <option value="canteen">Canteen</option>
        <option value="admin">Admin</option>
    </select>

    <br><br>

    <button type="submit" name="create">Create User</button>

</form>

</body>
</html>