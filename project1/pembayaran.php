<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pay</title>
	
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
        $uname=$_SESSION["username"];
        include "./database/dbPembelian.php";
        $query = "SELECT * FROM pembelian WHERE username = '$uname'";
        $result = $conn->query($query);
        $totalharga=0;
        //klo ketemu
        if( $result->num_rows > 0){
          while ($row = $result->fetch_assoc())
          {
            $totalharga=$totalharga+$row["harga"];}
            $_SESSION['total']=$totalharga;
            
      ?>
        <!-- BELOM VALIDASI!!!!!! -->
      <form class="form-horizontal" method="POST" action="./controller/doPembayaran.php" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

            Harga yang harus dibayar : 
            <p>Rp <?php echo $totalharga; ?></p>
            Upload bukti bayar:
            <input type="file" id="gambar" name="gambar">
            <br>
            <button type="submit">Submit</button></button>
              
            </div>
          </form>
    <?php }?>
		</div>
</body>
</html>