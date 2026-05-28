<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
$result = mysqli_query($conn, 
    "SELECT * FROM users WHERE pending = 1"
);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../auth/login.php");
    exit();
} 

if (isset($_POST['approve'])) {

    $id = $_POST['user_id'];
  
    mysqli_query($conn,
        "UPDATE users SET pending = 0 WHERE id = $id"
    );

    echo "Approved ";
}

?>
<html>
    <head>
        <link rel="stylesheet" href="../assets/css/admin.css">
    </head>
    <body>

<div class="navbar">

    <a href="dashboard.php">Dashboard</a>

    <a href="../auth/logout.php">Logout</a>

</div>

<div class="container">

<h1 class="page-title">
    Pending Registration Requests
</h1>

<?php

if(mysqli_num_rows($result) == 0){

    echo "<div class='card'><h3>No Pending Requests</h3></div>";

}else{

while($row = mysqli_fetch_assoc($result)){

?>

<div class="card">

    <h2>
        <?= $row['name'] ?>
    </h2>

    <p>
        <strong>Email:</strong>
        <?= $row['email'] ?>
    </p>

    <br>

    <a class="btn btn-primary"
      href="../assets/images/<?= basename($row['proof_file']) ?>" download>

       Download Certificate

    </a>

    <br><br>

    <form method="POST">

        <input type="hidden"
               name="user_id"
               value="<?= $row['id'] ?>">

        <button class="btn btn-success"
                name="approve">

            Approve

        </button>

    </form>

</div>

<?php
}
}
?>

</div>

</body>

</html>