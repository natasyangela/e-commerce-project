<?php

$host = "localhost";
$username = "root";
$password = "pinkylulushop";
$db_name = "pembayaran";

$hashpass = sha1($password);
$con = new mysqli($host,$username,$hashpass,$db_name);

if( !$con ){
    die("Database Not Found!");
}

?>