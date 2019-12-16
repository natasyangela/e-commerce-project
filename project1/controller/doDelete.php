<?php

include "../database/dbProduct.php";
$id=$_GET["id"];
$query="DELETE FROM product WHERE id='$id'";
$result=$connection->query($query);

if($result)
{
    header("Location:../home.php");
}


?>