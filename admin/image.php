<?php
session_start();
header ('Content-type:image/jpeg');

$text = $_SESSION['captcha'] = mt_rand(111111, 999999);
$font_size = 30;
$total_lines = 70;
$width = 150;
$height = 43;

$image = imagecreate($width, $height);

//$r = mt_rand(100,200);
//$g = mt_rand(100, 200);
//$b = mt_rand(100, 200);

imagecolorallocate($image, 255, 255, 255);


$r = mt_rand(0, 100);
$g = mt_rand(0, 100);
$b = mt_rand(0, 100);
$font_color = imagecolorallocate($image, $r, $g, $b);
for($i=1; $i<= $total_lines; $i++)
{
    $x1 = mt_rand(0, 100);
    $y1 = mt_rand(0, 100);
    $x2 = mt_rand(0, 100);
    $y2 = mt_rand(0, 100);
    imageline($image, $x1, $y1, $x2, $y2, $font_color);
}

$angle = mt_rand(-2, 2);
imagettftext($image, $font_size, $angle, 20, 40, $font_color,'assets/fonts/BRUSHSCI.ttf', $text);
imagejpeg($image);
?>
