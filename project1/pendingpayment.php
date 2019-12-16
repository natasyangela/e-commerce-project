<?php
session_start();
include "./database/dbpembayaran.php";
$uname=$_SESSION["username"];
$query="SELECT * FROM pembayaran WHERE username='$uname'";
$result=$con->query($query);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc() ){?>

        Nama Produk : <?php echo $row["nama_produk"];?><br>
        Jumlah Pemesanan : <?php echo $row["jumlah"];?><br>
        Bukti Pembayaran : <img src="./bukti transfer/<?= $row["username"]?>/<?=$row["bukti_trf"];  ?>" class="img-responsive" alt="Image">
        <br>Status:
        <?php 
        if ($row["stat"]=="DECLINED"){
            echo "Admin does not approve.";
            echo "<br>";?> 
            <a href="./controller/doDelete_Cust.php?id=<?=$row["id"]?>">Delete Order</a>
            <?php
        }else{
            echo "Waiting for admin's confirmation";
            echo "<br>";
        }
    }
}else{
    echo "There is no pending confirmation";
}
    ?>
    <br>
<a href="./home.php">Back to Home</a>