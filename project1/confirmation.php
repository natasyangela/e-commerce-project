<!-- Form Update & Check Session -->
<?php
session_start();
unset($_SESSION["stok_kurang"]);
include "./database/dbpembayaran.php";
include "./database/dbProduct.php";?>

<!DOCTYPE html>
<html>
<head>
	<title>Confirmation</title>

</head>
<body>
  <?php
  if($_SESSION["username"]!='admin')
  {
    header("Location:login.php");
  }
  ?>
    <?php

    $query = "SELECT * FROM pembayaran";
    $result = $con->query($query);
    //list semua permintaan konfirmasi
    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc() ){
        if ($row["stat"]!="DECLINED"){
    ?>

      <p>Username : <b> <?=$row["username"]; ?> </b></p>
      <?php 
            $produk=$row["nama_produk"];
            $jml=$row["jumlah"];
            $id=$row["id"];
      ?>
      <p>Total Pembayaran : Rp <?= $row["totalharga"]; ?></p>
      <p>Nama Produk : <?= $row["nama_produk"]; ?></p>
      <p>Jumlah Pemesanan : <?= $row["jumlah"]; ?></p>
      <?php $que="SELECT * FROM product WHERE nama='$produk'";
            $res=$connection->query($que);
            if($res)
            {
              $row1=$res->fetch_assoc();
              if($jml>$row1["stock"])
              {
                $_SESSION["stok_kurang"]="Stock tidak mencukupi";
                echo $_SESSION["stok_kurang"];
              }
            }?>
      <img src="./bukti transfer/<?= $row["username"]?>/<?=$row["bukti_trf"];  ?>" class="img-responsive" alt="Image"> <!-- {image} = image from database -->
      <br>
      
      <?php if(!isset($_SESSION["stok_kurang"])){?>
      <a class="btn btn-danger" href="./controller/doConfirmation.php?id=<?=$id?>">Confirm</a>
      <?php }?>
      <a class="btn btn-danger" href="./controller/doDecline.php?id=<?=$id?>">Decline</a>
      <?php }}}?>
      <br>
      <a class="btn btn-danger" href="./home.php">Back</a>
</body>
</html>