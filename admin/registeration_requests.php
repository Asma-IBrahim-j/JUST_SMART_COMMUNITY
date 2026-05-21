<?php
session_start();
include "../database/db_connection.php";

$result = mysqli_query($conn, 
    "SELECT * FROM users WHERE pending = 1"
);
/*
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
} */

if (isset($_POST['approve'])) {

    $id = $_POST['user_id'];
    $password = random_int(100000, 999999);
    /* $hashed = password_hash($password, PASSWORD_DEFAULT);*/
    mysqli_query($conn,
        "UPDATE users SET pending = 0,password='$password' WHERE id = $id"
    );

    echo "Approved ";
}

?>
<html>
    <head></head>
    <body>
<h2>Pending Requests</h2>

<?php if(mysqli_num_rows($result) == 0) echo"No pending Requests";
else{
 while($row = mysqli_fetch_assoc($result)) { 
    ?>

    <div class="request-card">

        <p><strong>Name:</strong> <?= $row['name'] ?></p>
        <p><strong>Email:</strong> <?= $row['email'] ?></p>

        <a href="<?= $row['proof_file']?>" download>
            Download Certificate
        </a>

        <br><br>

       
        <form method="POST">
            <input type="hidden" name="user_id" value="<?= $row['id'] ?>">

            <button name="approve">Approve </button>
           
        </form>

    </div>
    <?php } }?>
</body>

</html>