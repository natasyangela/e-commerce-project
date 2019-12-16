<?php
session_start();

include "../database/db.php";


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

if(isset($csrfErr) && empty($csrfErr))
{
    if(isset($_POST['submit']))
    {
        $usernameErr = $passwordErr = "";
        $username = $pass = "";
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST['username'])){
                $usernameErr = "Username Required";
            }else{
                $username = test_input($_POST['username']);
            }
    
            if(empty($_POST['password'])){
                $passwordErr = "Password Required";
            }else{
                $pass = test_input($_POST['password']);
            }
    
            if(!empty($usernameErr) || !empty($passwordErr))
            {
                header("location: ../login.php");
            }
        }
    
        if($usernameErr === "" && $passwordErr === "")
        {
            if($_POST['captcha_code']===$_SESSION['captcha_code']){
                # code...
                $time = time();
                $escaped_Uname = mysqli_escape_string($connection,$username);
                $query = "SELECT * FROM users WHERE uname = '$username'";
                $result = $connection->query($query);
                
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    session_regenerate_id();
                    
                    if (password_verify($pass,$row["password"])){
                        $_SESSION["username"] = $username;
                        
                        if($_POST["remember"]){
                            setcookie("cookie_uname", $username, $time + 3600 ,"/");
                            setcookie("cookie_pass", $pass, $time + 3600 ,"/");
                        }
                    }
                }
                header("Location: ../home.php");
            }
            else{
                header("Location: ../login.php");
                echo("wrong");
            }
    
        }

    }

    // $Uname = $_POST["username"];
    // $pass = $_POST["password"];
    // // $cookie = $_POST["remember"];

    
}

function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>