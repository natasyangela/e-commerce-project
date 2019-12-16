<?php
session_start();
$random_alphanumeric = md5(rand());
$captcha_code = substr($random_alphanumeric,0,6);
$_SESSION["captcha_code"] = $captcha_code;

$target_layer = imagecreatetruecolor(70,30);
$captcha_background = imagecolorallocate($target_layer,233, 166, 211);
imagefill($target_layer,0,0,$captcha_background);
$captcha_textcolor = imagecolorallocate($target_layer,	216, 108, 171);
imagestring($target_layer,5,5,5,$captcha_code,$captcha_textcolor);
header("Content-type: image/jpeg");
imagejpeg($target_layer);
?>