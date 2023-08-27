<?php
session_start();
if (!isset($_SESSION["code"])) {
	$_SESSION["code"] = random_int(1000, 9999);
}
header("Content-Type: image/png");

function getColor($image, $x, $y) {
	$rgb = imagecolorat($image, $x, $y);
	$r = ($rgb >> 16) & 0xFF;
	$g = ($rgb >> 8) & 0xFF;
	$b = $rgb & 0xFF;
	
	return "$r$g$b";
}

$image = imagecreatetruecolor(100, 20);
$imagearc = imagecreatetruecolor(100, 20);
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$font = "/home/www/bgp.skymote.net/content/Public/font.ttf";

$numbers = str_split($_SESSION["code"]);

imagefilledrectangle($image, 0, 0, 99, 19, $white);
imagefilledrectangle($imagearc, 0, 0, 99, 19, $white);

foreach ($numbers as $i=>$number) {
	imagettftext($image, 20, rand(-10, 10), $i*25, 20, $black, $font, $number);
	imagefilledarc($imagearc, $i*25, rand(10, 20), 20, 20, 20, 20, $black, IMG_ARC_PIE);
}

for ($i = 0; $i < 100; $i++) {
	for ($j = 0; $j < 20; $j++) {
		if (getColor($imagearc, $i, $j) == "000" && getColor($image, $i, $j) == "000") {
			imagesetpixel($image, $i, $j, $white);
		} elseif (getColor($imagearc, $i, $j) == "000" && getColor($image, $i, $j) == "255255255") {
			imagesetpixel($image, $i, $j, $black);
		}
	}
}

imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
if (rand(0, 1) == 1) {
	imagefilter($image, IMG_FILTER_NEGATE);
}
imagepng($image);
imagedestroy($image);