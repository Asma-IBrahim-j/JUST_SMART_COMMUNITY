<?php
session_start();
include "../database/db_connection.php";

/** @var mysqli $conn */

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //checking if user existed in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        // password verifying
        if (password_verify($password, $row['password'])) {

            //  Create Session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // directing the user according to the rule 
            if ($row['role'] == "student") {

                header("Location: ../student/dashboard.php");

            } elseif ($row['role'] == "canteen") {

                header("Location: ../canteen/dashboard.php");

            } elseif ($row['role'] == "admin") {

                header("Location: ../admin/dashboard.php");

            } else {

                // role unknown
                session_destroy();
                header("Location: login.php");
            }

            exit();

        } else {

            $error = "Wrong Password";
        }

    } else {

        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

<div class="form-container">

    <h2>
        Login
    </h2>

    <?php
    if(isset($error)){
        echo "<div class='alert alert-error'>
        $error
      </div>";
    }
    ?>

    <form method="POST">

        <input type="email"
               name="email"
               placeholder="Enter your email"
               required>

        <div class="password-box">

            <input type="password"
                   id="password"
                   name="password"
                   placeholder="Enter your password"
                   required>

          <span class="toggle-eye"
      onclick="togglePassword(this)">
               👁
          </span>
        </div>

        <button type="submit"
                name="login">

            Login

        </button>

    </form>

    <br>

    <p style="text-align:center;">

        Don't have an account?

        <a href="usertype.php">

            Register

        </a>

    </p>

</div>

<script src="../assets/js/main.js"></script>

</body>

</html>