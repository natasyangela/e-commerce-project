<?php

include "../database/dbpembayaran.php";

$id=$_GET["id"];
$query="DELETE FROM pembayaran WHERE id='$id'";
$result=$con->query($query);

if($result)
{
    header("Location:../pendingpayment.php");
}

?>