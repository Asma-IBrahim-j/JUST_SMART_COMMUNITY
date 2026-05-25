<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $faculty = $_POST['faculty'];
    $role = 'student';

    // 1. password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // 2. password length
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters";
        exit();
    }

    // 3. email validation (FIXED)
    if (!str_contains($email, "@") || !str_ends_with($email, "just.edu.jo")) {
        echo "Only JUST emails allowed for students";
        exit();
    }

    // 4. duplicate email check
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already exists";
        exit();
    }

    // 5. hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 6. insert user
    $query = "INSERT INTO users (name, email, password, role, faculty)
              VALUES ('$name', '$email', '$hashedPassword', '$role', '$faculty')";

    if (mysqli_query($conn, $query)) {

    
        header("Location: ../auth/login.php");
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>StudentRegisteration</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

<div class="form-container">

    <h2>
        Student Registration
    </h2>

    <?php
    if(isset($error)){
        echo "<p style='color:red;'>$error</p>";
    }

    if(isset($success)){
        echo "<p style='color:green;'>$success</p>";
    }
    ?>

    <form method="POST">

        <input type="text"
               name="name"
               placeholder="Full Name"
               required>

        <input type="email"
               name="email"
               placeholder="JUST Email"
               required>

        <div class="password-box">

            <input type="password"
                   id="password"
                   name="password"
                   placeholder="Password"
                   required>

          <span class="toggle-eye"
      onclick="togglePassword(this)">
          👁
     </span>

        </div>

        <div class="password-box">

            <input type="password"
                   id="confirm_password"
                   name="confirm_password"
                   placeholder="Confirm Password"
                   required>

        </div>

        <button type="submit"
                name="register">

            Register

        </button>

    </form>

    <br>

    <p style="text-align:center;">

        Already have an account?

        <a href="login.php">

            Login

        </a>

    </p>

</div>

<script src="../assets/js/main.js"></script>

</body>

</html>