<?php

session_start();

// $uname = $_SESSION["username"];

// echo "Hello, $uname";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Pinky Lulu Shop</title>
</head>

<body>
  <?php
  if (isset($_SESSION['username']) == false) {
    // <!-- belum punya akun -->
    header("location: ./login.php");
  } else {
    if ($_SESSION["username"] == 'admin') {
      ?>
      <a href="./confirmation.php"> Confirmation </a>
      <a href="./insert.php"> Insert </a>
    <?php
      }
      ?>

    <a href="./cart.php"> Cart </a>
    <a href="./pendingpayment.php"> Payment Information</a>
    <a href="./controller/doLogout.php"> Sign out </a>

  <?php
  }
  ?>


  <?php
  include "./database/dbProduct.php";

  $query = "SELECT * FROM product";
  $result = $connection->query($query);
  //list semua product yg tersedia
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      ?>

      <p><b> <?= $row["nama"]; ?> </b></p> <!-- Show smartphone brand from database -->
      <!-- Image from path public/image/product/{image} -->
      <!-- <center> -->
      <img src="./asset/image/product/<?= $row["gambar"];  ?>" class="img-responsive" alt="Image"> <!-- {image} = image from database -->
      <!-- </center> -->
      <br>
      Stock :
      <?= $row["stock"];  ?>
      <!-- Show smartphone type from database -->
      <p>Rp <?= $row["harga"]; ?></p> <!-- Show smartphone price from database -->
      <!-- Show Button Update and Delete -->

      <?php if ($_SESSION["username"] === "admin") { ?>
        <a class="btn btn-warning" href="./update.php?id=<?= $row["id"]; ?> ">Update</a>
        <a class="btn btn-danger" href="./controller/doDelete.php?id=<?= $row["id"]; ?>">Delete</a>
  <?php }else{ ?>
      <a class="btn btn-warning" href="./buy.php?id=<?= $row["id"]; ?> ">Buy</a>

     <?php }
    }
  } ?>



</body>

</html>