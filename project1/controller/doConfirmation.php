<?php

include "../database/dbpembayaran.php";
include "../database/dbProduct.php";


$id=$_GET["id"];

$query1 = "SELECT * FROM pembayaran WHERE id='$id'";
$res=$con->query($query1);
$row=$res->fetch_assoc();


$namaP = $row["nama_produk"];

$queryS = "SELECT * FROM product WHERE nama='$namaP'";
$ress=$connection->query($queryS);
$row1=$ress->fetch_assoc();

$jml = $row1["stock"] - $row["jumlah"];

$queryU = "UPDATE product SET stock = '$jml' WHERE nama='$namaP'";
$hasil = $connection->query($queryU);

$query="DELETE FROM pembayaran WHERE id='$id'";
$result=$con->query($query);

if($result)
{
    header("Location:../confirmation.php");
}

?>