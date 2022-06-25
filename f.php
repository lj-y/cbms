<?php
header("content-type:text/html;charset=utf-8");
header("content-type:image/gif");
session_start();
$str = "abcdefghijklmnopqrstuvwxyz0123456789";
$len =  strlen($str);
$image = imagecreate(100,30);
$bg  = imagecolorallocate($image,255,255,255);
//imagegif($image);
$cha = "";
for($i=0;$i<5;$i++){
    $char = strtoupper($str[rand(0,$len-1)]);
    $charcolor  = imagecolorallocate($image,rand(0,155),rand(0,155),rand(0,155));
    imagestring($image,16,5+$i*20,rand(5,15),$char,$charcolor);
   
    $cha.=$char;   
    }
$_SESSION['char'] = $cha;

//点干扰和线干扰同时 有顺序吗？

for($j=0;$j<3;$j++){
    $linecolor = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
    imageline($image,rand(1,60),rand(1,30),rand(50,100),rand(1,30),$linecolor);
}
for($j=0;$j<80;$j++){
    $pointcolor = imagecolorallocate($image,155,155,155);
    imagesetpixel($image,rand(0,100),rand(0,30),$pointcolor);
}

imagegif($image);
imagedestroy($image);
?> 