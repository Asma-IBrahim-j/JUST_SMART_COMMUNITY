<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
   
    $role = 'student';

    // 1. password match
    if ($password !== $confirm_password) {
     
        $error="Passwords do not match";
     
    }

    // 2. password length
   elseif (strlen($password) < 6) {
      
        $error="Password must be at least 6 characters";
       
    }
    

    // 3. email validation (FIXED)
    elseif (!str_contains($email, "@") || !str_ends_with($email, "just.edu.jo")) {
        $error="Only JUST emails allowed for students, example:ahmad@cit.just.edu.jo";
     
     
    }
else{
    // 4. duplicate email check
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
   if (mysqli_num_rows($check) > 0) {
        $error="Email already exists";
      
    }
else{
    // 5. hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 6. insert user
    if(!isset($error)){
    $query = "INSERT INTO users (name, email, password, role )
              VALUES ('$name', '$email', '$hashedPassword', '$role')";

    if (mysqli_query($conn, $query)) {

    $success="registerd successfully";
        header("Location: ../auth/login.php");
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }}}}
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