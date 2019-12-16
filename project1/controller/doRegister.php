<?php
// namespace Phppot;
// use \Phppot\Member;

session_start();

include "../database/db.php";
include "../validasi.php"; 


if(isset($_POST['csrf_token']))
{
    $csrfErr = "";
    if($_SESSION['csrf_token'] === $_REQUEST['csrf_token'])
    {
        $csrfErr = "";
    }
    else {
        $csrfErr = "error";
    }
}

$usernameError="";
$emailError="";
$passError="";

if(isset($csrfErr) && empty($csrfErr))
{
    if( isset($_POST["register"]) ){
        //biar pas register ga masukkin aneh2
        $username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);    
        $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
        $conf_password = filter_var($_POST["confirmpassword"],FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"],FILTER_SANITIZE_STRING);
        
        //cari uname sama
        $find_same = "SELECT uname FROM users WHERE uname ='$username'";
        $result_find = $connection->query($find_same);
        
        //kalo username ga diisi atau mau masukkin yang aneh2
        if(isset($_POST['username']))
        {
            $usernameError = "Fill in the blank please";
        }else{
            $username = test_input($_POST['username']);
            if(!preg_match("/^[a-zA-Z]*$/",$username))
            {
                $usernameError = "This is Error, Thank You";
            }
        }

        //kalo email ga diisi sama isi ga sesuai ama format
        if(empty($_POST['email']))
        {
            $emailError = "Fill in the blank please";   
        }else{
            // $email = test_input($_POST['email']);
            //validate it's real email
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)&& !preg_match("/([w-]+@[w-]+.[w-]+)/",$email)){
                $emailError= "This is error, Thank You";
            }
        }
        
        //kalo password ga diisi dan lebih dari 20 array dan kurang dari 5
        if(empty($_POST['password']))
        {
            $passError = "Fill in the blank please";
        }
        else if(strlen($_POST['password'])<5)
        {
            $passError = "Too Short";
        }
        else if(strlen($_POST['password'])>20)
        {
            $passError = "Too Much";
        }
        
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        if (validateUname($username) != 1 && valconfPassword($password,$conf_password) != 1 && valEmail($email) != 1 && $result_find->num_rows < 1 ){
            $hash_pass=password_hash($password, PASSWORD_BCRYPT);
            
            function isMemberExist(){
                $query = "select * FROM users WHERE username = ? OR email = ?";
                $paramType = "ss";
                $paramArray = array($username, $email);
            $memberCount = $this->ds->numRows($query, $paramType, $paramArray);

            return $memberCount;
        }
        
        function insertMemberRecord($username, $email, $password)
        {
            $passwordHash = password_hash($password,PASSWORD_BCRYPT);
            $paramType = "ssss";
            $paramArray = array(
                $username,
                $displayName,
                $passwordHash,
                $email
            );
            $insertId = $this ->ds->insert($query, $paramType,$paramArray);
            return $insertId;
        }


        $query = "INSERT INTO users (uname,password,email) VALUE ('$username','$hash_pass','$email')";
        $result = $connection->query($query);   
        header("Location: ../login.php");
        }else{

        header("Location: ../register.php");
        }
    }
}

?>