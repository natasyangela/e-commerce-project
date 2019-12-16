<?php

session_start();
session_unset();
session_destroy();

unset($_COOKIE["cookie_uname"]);
unset($_COOKIE["cookie_pass"]);
unset($_SESSION['csrf_token']);

if( !isset($_SESSION["username"]) ){
    header("Location: ../login.php");
}else{
    die("Fail");
}

?>