<?php

$host = "localhost";
$username = "root";
$password = "pinkylulushop";
$db_name = "pembelian";

$hashpass = sha1($password);
$conn = new mysqli($host,$username,$hashpass,$db_name);

if( !$conn ){
    die("Database Not Found!");
}

?>