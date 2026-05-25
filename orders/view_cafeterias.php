<?php
session_start();
include "../database/db_connection.php";
/** @var mysqli $conn */
?>
<html>

<head>
<link rel="stylesheet" href="../assets/css/orderstyle.css">
<title>view cafeterias</title>
</head>
<body>

<div class="navbar">

    <a href="../<?php echo $_SESSION['role']; ?>/dashboard.php">
        Dashboard
    </a>

    <a href="../orders/view.php">
        My Orders
    </a>

    <a href="../auth/logout.php">
        Logout
    </a>

</div>

<div class="container">

    <h1>
        Campus Cafeterias
    </h1>
   <form method="GET" class="search-form">

    <input type="text"
       name="search"
       placeholder="Search cafeterias"
       value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">

    <button type="submit">
        Search
    </button>

</form>
    <div class="cafeterias-bar">

        <?php

        if(isset($_GET['search'])){

    $search = $_GET['search'];

    $query = "
    SELECT *
    FROM cafeterias

    WHERE name LIKE '%$search%'
    ";

}else{

    $query = "
    SELECT *
    FROM cafeterias
    ";
}

$result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <a href="../orders/view_meals.php?cid=<?= $row['id'] ?>">

            <div class="cafeteria-item">

                <img src="<?= $row['image'] ?>">

                <span>
                    <?= $row['name'] ?>
                </span>

            </div>

        </a>

        <?php } ?>

    </div>

</div>

</body>


</html>