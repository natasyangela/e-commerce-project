<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register here!</title>
</head>

<?php
    include "./controller/session.php";
?>

<link href="./asset/css/register.css" rel="stylesheet" type="text/css">

<body>

    <?php
        // session_start();
        if(isset($_SESSION['username']))
        {
            header('location: ./home.php');
        }
    ?>

    <div class="registerbox">
        <img src="./asset/image/profile.png" class="avatar">
        <h1>Register Here</h1>
        <form action="./controller/doRegister.php" name="vforms" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'];?>">

        <label class="unamepass">Enter Username: </label>
        <br>
        <input type="text" name="username" id="txtUsername" placeholder="Enter Username">
        <br>

        <label class="unamepass">Enter E-mail: </label>
        <br>
        <input type="email" name="email" id="txtEmail" placeholder="Enter Email">
        <br>

        <label class="unamepass">Enter Password: </label>
        <br>
        <input type="password" name="password" id="txtPassword" placeholder="Enter Password">
        <br>

        <label class="unamepass">Enter your password again: </label>
        <br>
        <input type="password" name="confirmpassword" id="txtConfirmPass" placeholder="Confirm Password">
        <br>

        <br>
        <input type="submit" value="Register" name="register" id="btnSubmit" onclick="return validate();">
        
    </form>
    </div>

</body>
</html>

<script type="text/javascript" src="./controller/registercontrol.js"></script>
