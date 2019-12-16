<?php

include "../database/dbpembayaran.php";
$id=$_GET["id"];

$msg="DECLINED";

$query = "UPDATE pembayaran SET stat = '$msg' WHERE id = $id";
$res = $con->query($query);

if($res)
{
    header("Location:../confirmation.php");
}

?>