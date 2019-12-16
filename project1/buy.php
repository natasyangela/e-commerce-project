
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buy</title>
	
</head>
<body>
	
	
	<!-- If user has not logged in, Redirect to login.php -->
  <?php
  if (!isset($_SESSION["username"])){
    header("Location: ./login.php");
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
        include "./database/dbProduct.php";
        //buat dpt id number
        $id = $_GET["id"];
    
        
        $query = "SELECT * FROM product WHERE id = '$id'";
        $result = $connection->query($query);

        //klo ketemu
        if( $result->num_rows > 0){
          $row = $result->fetch_assoc();

      ?>
        <!-- BELOM VALIDASI!!!!!! -->
      <form class="form-horizontal" method="POST" action="./controller/doBuy.php" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

			<input type="hidden" name="id" value=<?php echo $row["id"]; ?>  > 
            <!-- id from selected product, tampilin nama, image, stock, harga -->
            
            <p><b> <?= $row["nama"]; ?> </b></p> 
            <img src="./asset/image/product/<?= $row["gambar"];  ?>" class="img-responsive" alt="Image"> <!-- {image} = image from database -->
            <p><?= $row["stock"];  ?></p> 
            <p>Rp <?= $row["harga"]; ?></p>
            

            <input type="text" id="jumlah" name="jumlah" placeholder="Enter Jumlah" value=<?php echo $row["stock"]; ?>>
  
            <button type="submit">Add to Cart</button></button>
              
            </div>
          </form>
          <?php } ?>
		</div>
</body>
</html>