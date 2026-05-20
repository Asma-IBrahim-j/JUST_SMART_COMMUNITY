<?php
session_start();
include "../database/db_connection.php";

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $faculty = $_POST['faculty'];
    //  $role = $_POST['role'];
    $role = 'student';
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['faculty']=$faculty;
    $_SESSION['role']=$role;

    if ($password !== $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters";
        exit();
    }
    // 1. Email validation (JUST only)
    if ($role == "student" && !str_ends_with($email, "just.edu.jo") && !str_contains($email, "@")) {

        echo "Only JUST emails allowed for students";
        exit();
    }

    // 2. Check duplicate email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already exists";
        exit();
    }

    // 3. Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 4. Insert into DB
    $query = "INSERT INTO users (name, email, password, role,faculty)
              VALUES ('$name', '$email', '$hashedPassword', '$role','$faculty')";

    if (mysqli_query($conn, $query)) {
      //  echo "Registered successfully";
        header("Location: ../student/dashboard.php");
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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <script src="./assets/js/main.js"></script>


    <form method="POST" action="">
        <div class="form-container">
            <h2>Student Registeration</h2>
            <input type="text" name="name" placeholder="Name" required><br><br>

            <input type="email" name="email" id="email" placeholder="JUST Email" required><br><br>
            <!--
    <select name="role" required>
    <option value="">Select Account Type</option>
    <option value="student">Student</option>
    <option value="canteen">Canteen</option>
    </select>
    <br><br>
-->
            <select name="faculty" required>
                <option value="">Select Faculty</option>
                <option value="Engineering">Engineering</option>
                <option value="IT">IT</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Medicine">Medicine</option>
                <option value="Nursing">Nursing</option>
                <option value="Dentistry">Dentistry</option>
                <option value="Agriculture">Agriculture</option>
                <option value="Veterinarian">Veterinarian</option>
                <option value="Science&Arts">Science&Arts</option>
                <option value="Architecture&Design">Architecture&Design</option>
            </select>

            <br><br>
            <div class="password-box">
                <input type="password" id="password" name="password" placeholder="Password" minlength="6" required>

                <span class="toggle-eye" onclick="togglePassword()">👁</span>
            </div>
            <br>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required><br><br>

            <button type="submit" name="register" id="register">Register</button>
        </div>
    </form>

</body>

</html>