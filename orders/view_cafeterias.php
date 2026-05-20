<?php
session_start();
include "../database/db_connection.php";
?>
<html>

<head>

</head>
<title>view cafeterias</title>
 <link rel="stylesheet" href="./orderstyle.css">

<body>

    <div class="cafeterias-bar">

        <div class="cafeterias-bar">

            <?php
            $result = mysqli_query($conn, "SELECT * FROM cafeterias");

            while ($row = mysqli_fetch_assoc($result)) {
            ?><a href="../orders/view_meals.php?cid=<?= $row['id'] ?>">
                <div class="cafeteria-item">
                    <img src="<?= $row['image'] ?>">
                    <span><?= $row['name'] ?></span>
                    
                </div>
              </a>
            <?php }   ?>

        </div>

    </div>



</body>






</html>