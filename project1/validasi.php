<?php

function validateUname ($uname){
    if ($uname == ""){
        return 1;
    }
}

function valconfPassword ($password, $conf_password){
    if( strcmp($password,$conf_password) != 0){
        return 1;
    }
}

function valEmail ($email){
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)){
        return 1;
    }
}




?>