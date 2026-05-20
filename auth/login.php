<?php
session_start();
include "../database/db_connection.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == "student") {

                header("Location: ../student/dashboard.php");
            } elseif ($row['role'] == "canteen") {

                header("Location: ../canteen/dashboard.php");
            } elseif ($row['role'] == "admin") {

                header("Location: ../admin/dashboard.php");
            }


            exit();
        } else {
            echo "Wrong Password";
        }
    } else {
        echo "User not found";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div class="form-container">

        <h2>Login</h2>

        <form method="POST" action="">

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>

        </form>

        <br>
        <a href="../auth/usertype.php">Don't have an account? Register</a>

    </div>
</body>

</html>