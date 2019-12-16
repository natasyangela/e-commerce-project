<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
</head>

<?php 
    include "./controller/session.php";
?>

<link href="./asset/css/login.css" rel="stylesheet" type="text/css">
<body>

    <?php
        // session_start();
        if(isset($_SESSION['username']))
        {
            header('location: ./home.php');
        }
    ?>

    <div class="loginbox">
    <img src="./asset/image/profile.png" class="avatar">
    <h1>Login Here</h1>
    
    <form action="controller/doLogin.php" method="post">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">
    
    <label class="unamepass">Username</label>
    <br>
    
    <input type="text" name="username" id="txtUsername" placeholder="Enter Username" value=<?php if(isset($_COOKIE["cookie_uname"])) echo $_COOKIE["cookie_uname"]  ?>>
    
    <label class="unamepass">Password</label>
    <br>
    <input type="password" name="password" id="txtPassword" placeholder="Enter Password" value=<?php if(isset($_COOKIE["cookie_pass"])) echo $_COOKIE["cookie_pass"]  ?>>
    <br>
    <input type="checkbox" name="remember" id=""> 
    <label id="rememberMe">Remember me</label>
    <br>
    <br>
    
    <img src= "captcha.php">
    <br>
    <label id="lblCaptcha"><b>Enter Captcha: </b></label><input type="text" name ="captcha_code" maxlength="6" id="txtCaptcha">
    <br><br>

    <input type="submit" name="submit" id="btnSubmit" value="Login">
    <br>
    </form>

    <label class="unamepass">Don't have an account? Click</label>
    <br>
    <label id="register">
    <a href="register.php">Register</a>
    </label>
    </div>

</body>
</html> 
