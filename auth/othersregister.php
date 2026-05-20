<?php
session_start();
include "../database/db_connection.php";

function registerUser($conn, $name,  $phone, $filePath)
{
    $role = 'notstudent';



    $query = "INSERT INTO users (name,  role,  isverified, phone, proof_file)
              VALUES ('$name',  '$role',  0, '$phone', '$filePath')";

    return mysqli_query($conn, $query);
}
?>
<?php
if (isset($_POST['send'])) {
    /*
    if (!isset($_SESSION['name'], $_SESSION['email'], $_SESSION['password'])) {
        echo "Session expired. Please register again.";
        exit();
    }
*/
    $phone = $_POST['phone'];
    $name = $_POST['name'];

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
        $phone,
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


        <input type="text" name="phone" placeholder="Phone Number" required><br><br>
        <label> Upload a certificate that your a part of JUST community </label><br>


        <br>
        <input type="file" name="proof" required><br>
        <label> Allowed extentions is : pdf,jpg,png </label><br><br>
        <button type="submit" name="send"> Submit</button>
    </form>



</body>




</html>