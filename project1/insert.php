<!-- Form Update & Check Session -->
<?php
session_start();
include "./database/dbProduct.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>INSERT</title>

</head>
<body>
  <?php
  if(!isset($_SESSION["username"]) === 'admin')
  {
    header("Location: ./login.php");
  }
  ?>
	<!-- If user has not logged in, Redirect to login.php -->
  
				<!-- Show Error Message -->
					<p style="color: red;">
            <?php 
            if(isset($_SESSION["error"]))
            {
              echo $_SESSION["error"];
            }
            
            //[ERROR MESSAGE]
            ?>
          </p>

			<form class="form-horizontal" method="POST" action="./controller/doInsert.php" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

			<input type="hidden" name="id"> 
      <!-- id from selected product -->
            
            
            <label class="control-label col-sm-2" for="nama">Nama:</label>
            
                <!-- Show selected brand in value input type -->
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name">
              
            
              <label class="control-label col-sm-2" for="stock">Jumlah:</label>
              
				<!-- Show selected type in value input type -->
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Enter Jumlah">
              
            
              <label class="control-label col-sm-2" for="harga">Price:</label>
              
				<!-- Show selected price in value input type -->
                <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter Price">
              
            
              <label class="control-label col-sm-2" for="gambar">Image:</label>
             
                <input type="file" id="gambar" name="gambar">
              
            
              <button type="submit" class="btn btn-default">Submit</button></button>
              
            </div>
          </form>
</body>
</html>