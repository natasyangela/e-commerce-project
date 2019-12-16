<?php

function validateMember()
{
    $valid = true;
    $errorMessage = array();
    foreach($_POST as $key => $value)
    {
        if(empty($_POST[$key])){
            $valid = false;
        }
    }
}

if ($valid == true){
    if($_POST['password']!= $_POST['confirm_password']){
        $errorMessage[] = 'Something is not match';
        $valid = false;
    }
    if(! isset($errorMessage)){
        if(! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $errorMessage[] = "Something is wrong, Thanks";
            $valid = false;
        }
    }
}
else{
    $errorMessage[] = "Fill in the blank, Please";
}
if($valid == false){
    return $errorMessage;
}

return;

?>