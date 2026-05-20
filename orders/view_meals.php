<?php
include "../database/db_connection.php";
$cafeteria_id = $_GET['cid'];
$cafeteria_query = mysqli_query($conn,
    "SELECT name FROM cafeterias WHERE id = $cafeteria_id"
);

$cafeteria_name = mysqli_fetch_assoc($cafeteria_query);
$result = mysqli_query($conn, "SELECT * FROM meals WHERE cafeteria_id = $cafeteria_id");
?>
<html>
    <head>
            <link rel="stylesheet" href="./orderstyle.css">
<script src="./Myorder.js">


</script>
    </head>
    <body>
       
 <h2><?php  echo $cafeteria_name['name'];  ?></h2>
 <form>
    <div class="page-container">
<div class="meals-container">

<?php 
while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="meal-item">
        <img src="<?= $row['image'] ?>">
        <h3><?= $row['name'] ?></h3>
       
         <p><?= $row['description'] ?></p>
         <div class ="price-qty">
        
        <p class="price" data-price="<?= $row['price'] ?>">
            <?= $row['price'] ?> JD
        </p>

    
    
<input type="number"
               value="1"
               min="1"
               class="qty">

     
         </div>
   <span class="total" id="<?= $row['price'] ?>">Total price: <?= $row['price'] ?> JD </span>
   
<button 
    class="order-btn"
    data-name="<?= $row['name'] ?>"
    data-price="<?= $row['price'] ?>"
>
   Add to My Order
</button>


          
    </div>

<?php } ?>

</div>

<div class="order-section">
        <h3>My Order </h3>

        <div class="order-items" id="order-items">
            <p>No items yet</p>
        </div>

        <div class="order-total" id="total-price">
            Total: 0 JD
        </div>
    </div>

    </div>
</form>
    </body>
</html>