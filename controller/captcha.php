<?php

if(!isset($_SESSION)){ 
    session_start(); 
}

$random_num    = md5(random_bytes(64));
$captcha_code  = substr($random_num, 0, 5);

$_SESSION['CAPTCHA_CODE'] = $captcha_code;

$layer = imagecreatetruecolor(150, 37);
$captcha_bg = imagecolorallocate($layer, 99, 99, 100);
imagefill($layer, 0, 0, $captcha_bg);
$captcha_text_color = imagecolorallocate($layer, 255, 255, 255);
imagestring($layer, 5, 55, 10, $captcha_code, $captcha_text_color);
header("Content-type: image/jpeg");
imagejpeg($layer);

?>