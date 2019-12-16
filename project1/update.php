<!-- Form Update & Check Session -->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	
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
        
        $id = $_GET["id"];
    
        
        $query = "SELECT * FROM product WHERE id = '$id'";
        $result = $connection->query($query);
        
        if( $result->num_rows > 0){
          $row = $result->fetch_assoc();

      ?>

      <form class="form-horizontal" method="POST" action="./controller/doUpdate.php" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

			<input type="hidden" name="id" value=<?php echo $row["id"]; ?>  > 
      <!-- id from selected product -->
            
            
            <label class="control-label col-sm-2" for="nama">Nama:</label>
            
                <!-- Show selected brand in value input type -->
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" value=<?php echo $row["nama"]; ?>>
              
            
              <label class="control-label col-sm-2" for="stock">Jumlah:</label>
              
				<!-- Show selected type in value input type -->
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Enter Jumlah" value=<?php echo $row["stock"]; ?>>
              
            
              <label class="control-label col-sm-2" for="harga">Price:</label>
              
				<!-- Show selected price in value input type -->
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter Price" value=<?php echo $row["harga"]; ?>>
              
            
              <label class="control-label col-sm-2" for="gambar">Image:</label>
             
                <input type="file" id="gambar" name="gambar">
              
            
              <button type="submit" class="btn btn-default">Submit</button></button>
              
            </div>
          </form>
          <?php } ?>
		</div>
</body>
</html>