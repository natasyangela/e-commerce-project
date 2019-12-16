
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	
</head>
<body>
	
	
	<!-- If user has not logged in, Redirect to login.php -->
  <?php
  if (!isset($_SESSION["username"])){
    header("Location: ./login.php");
  }
  else{
    $uname=$_SESSION["username"];
  }
  ?>
  

	<!-- Show Error Message -->
	<p style="color: red;"> 
    <!-- [ERROR MESSAGE] -->
    <?php
        if (isset($_SESSION["error"])){
            echo $_SESSION["error"];
        }
            
        ?>
    </p>
		

    <?php
        include "./database/dbPembelian.php";
        //daftar produk yg mau dibeli per user
        $query = "SELECT * FROM pembelian WHERE username='$uname'";
        $result = $conn->query($query);
        
        if( $result->num_rows > 0){
            while ($row = $result->fetch_assoc())
            {

                
                ?>
        <!-- BELOM VALIDASI!!!!!! -->
      
      <form class="form-horizontal" method="POST" action="./pembayaran.php" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

			<input type="hidden" name="id" value=<?php echo $row["id"]; ?>  > 
      <?php 
      $stmt = $conn->prepare("SELECT * FROM pembelian WHERE id = ?");
      if($stmt){
        $stmt->bind_param('isidb',$row['id'], $row['nama_product'],$row['jumlah'],$row['harga'],$row['gambar']);
        if($stmt->execute()){
          $stmt->bind_result($row['id'],$row['nama_product'],$row['jumlah'],$row['harga'],$row['gambar']);
          //$stmt->bind_param($id,$product,$jumlah,$harga,$gambar);
          if($stmt->fetch()){
?>
            <p><b> <?= $row["nama_produk"]; ?> </b></p> 
            <img src="./asset/image/product/<?= $row["gambar"];  ?>" class="img-responsive" alt="Image"> <!-- {image} = image from database -->
            <p><?= $row["jumlah"];  ?></p> 
            <p>Rp <?= $row["harga"]; ?></p>
<?php
          session_regenerate_id();
          }
        }
      }
      
      ?>
            <!-- id from selected product -->              
            </div>
          <?php }?>
            <button type="submit">Pay Now</button>
        </form>
            <?php
            } ?>
            <a href="./home.php">Buy more</a>   
		</div>
</body>
</html>