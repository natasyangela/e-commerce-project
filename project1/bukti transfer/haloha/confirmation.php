<!-- Form Update & Check Session -->
<?php
session_start();
include "./database/dbpembayaran.php"?>
<!DOCTYPE html>
<html>
<head>
	<title>Confirmation</title>

</head>
<body>
  <?php
  if($_SESSION["username"]!='admin')
  {
    header("Location: ./login.php");
  }
  ?>
    <?php

    $query = "SELECT * FROM pembayaran";
    $result = $con->query($query);
    //list semua permintaan konfirmasi
    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc() ){
    ?>

<p><b> <?= $row["username"]; ?> </b></p>
      <p>Rp <?= $row["totalharga"]; ?></p>
      <br>
      <img src="./bukti transfer/<?= $row["username"]?>/<?=$row["buktibayar"];  ?>" class="img-responsive" alt="Image"> <!-- {image} = image from database -->
      <br>
      
      <a class="btn btn-danger" href="./controller/doConfirmation.php?id=<?= $row["id"]; ?>">Confirm</a>   
      <?php }}?>
      <a class="btn btn-danger" href="./home.php">Back</a>
</body>
</html>