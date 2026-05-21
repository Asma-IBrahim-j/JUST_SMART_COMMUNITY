<?php
session_start();
include "../database/db_connection.php";

function registerUser($conn, $name,  $email, $filePath)
{
    $role = 'notstudent';



    $query = "INSERT INTO users (name,  role,   email, proof_file,pending)
              VALUES ('$name',  '$role',  '$email', '$filePath',1)";

    return mysqli_query($conn, $query);
}
?>
<?php
if (isset($_POST['send'])) {
   

    $email = $_POST['email'];
    $name = $_POST['name'];

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
    $path = "../uploads/" . $uniqueName;

    move_uploaded_file($tmpName, $path);

    registerUser(
        $conn,
        $name,
        $email,
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
</head>

<body>
    <h2>Not Student Registeration</h2>
    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="name" placeholder="Name" required><br><br>


        <input type="text" name="email" placeholder="Enter your personal Email" required><br><br>
        <label> Upload a certificate to prove you are a part of JUST community </label><br>


        <br>
        <input type="file" name="proof" required><br>
        <label> Allowed extentions is : pdf,jpg,png </label><br><br>
        <button type="submit" name="send"> Submit</button>
    </form>



</body>




</html>