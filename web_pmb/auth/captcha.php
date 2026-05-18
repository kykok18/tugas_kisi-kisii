<?php
session_start();

$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$captcha = substr(str_shuffle($chars), 0, 4);

$_SESSION['captcha'] = $captcha;

$image = imagecreate(120, 40);

$bg = imagecolorallocate($image, 255, 255, 255);
$text = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 35, 12, $captcha, $text);

header("Content-type: image/png");
imagepng($image);

imagedestroy($image);
