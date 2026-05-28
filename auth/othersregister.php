<?php
session_start();
include "../database/db_connection.php";

function registerUser($conn, $name,  $email, $hashedpassword,$filePath)
{
    $role = 'notstudent';



    $query = "INSERT INTO users (name,  role,   email,password, proof_file,pending)
              VALUES ('$name',  '$role',  '$email','$hashedpassword', '$filePath',1)";

    return mysqli_query($conn, $query);
}


if (isset($_POST['register'])) {
   

    $email = $_POST['email'];
    $name = $_POST['name'];
$password=$_POST['password'];
 $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 
    echo "Invalid Email";
    exit();
}


    if (!isset($_FILES['proof']) || $_FILES['proof']['error'] != 0) {
        echo "File upload failed";
        exit();
    }

    $fileName = $_FILES['proof']['name'];
    $tmpName = $_FILES['proof']['tmp_name'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowed = ['pdf', 'jpg', 'png'];

    if (!in_array($ext, $allowed)) {
        echo "Invalid file type";
        exit();
    }

    $uniqueName = uniqid() . "." . $ext;
    $path = "../assets/images/" . $uniqueName;

    move_uploaded_file($tmpName, $path);
/** @var mysqli $conn */
    registerUser(
        $conn,
        $name,
        $email,
        $hashedPassword,
        $path
    );

    echo "Your request has been submitted. Waiting for admin approval.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Othersregisteration </title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>

<div class="form-container">

    <h2>
        Community Registration
    </h2>

    <?php
    if(isset($error)){
        echo "<p style='color:red;'>$error</p>";
    }

    if(isset($success)){
        echo "<p style='color:green;'>$success</p>";
    }
    ?>

    <form method="POST"
          enctype="multipart/form-data">

        <input type="text"
               name="name"
               placeholder="Full Name"
               required>

        <input type="email"
               name="email"
               placeholder="Email"
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

        <label class="file-label">
    Upload proof of relation to JUST
</label>

<input class="file-input"
       type="file"
       name="proof"
       required>

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