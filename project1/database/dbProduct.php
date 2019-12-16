<?php

$host = "localhost";
$username = "root";
$password = "pinkylulushop";
$db_name = "product";

$hashpass = sha1($password);
$connection = new mysqli($host,$username,$hashpass,$db_name);

if( !$connection ){
    die("Database Not Found!");
}

?>