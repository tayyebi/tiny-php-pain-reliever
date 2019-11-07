<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
// Set the content-type
include("fagd.php");
// Create the image

if(!$_GET['id']) {
	exit; // TODO: Return 404
} else {

    require_once 'config.pass.php';
    require_once 'config.php';
    $result= mysqli_query($conn, 
        "SELECT Title FROM Posts WHERE Id = " . $_GET['id'] . " LIMIT 1"
    );
    $values = $result->fetch_array();
    $string = $values['Title'];
    
}

// The text to draw
$text = fagd($string,'fa','vazir');
// Replace path by your own font path

// $font = dirname(__FILE__).'/Nastaligh.ttf';
$font = 'static/fonts/Vazir-Bold.ttf';













header("Content-type: image/png");
$img_width = 800;
$img_height = 600;
 
$img = imagecreatetruecolor($img_width, $img_height);
 
$black = imagecolorallocate($img, 0, 0, 0);
$white = imagecolorallocate($img, 255, 255, 255);
$red   = imagecolorallocate($img, 255, 0, 0);
$green = imagecolorallocate($img, 0, 255, 0);
$blue  = imagecolorallocate($img, 0, 200, 250);
$orange = imagecolorallocate($img, 255, 200, 0);
$brown = imagecolorallocate($img, 220, 110, 0);
 
imagefill($img, 0, 0, $white);
 
imagestringup($img, 5, $img_width*19/20, $img_height*19/20, 'http://google.com', $blue);
imagestring($img, 5, $img_width/20, $img_height/20, 'SARIAB', $red);

$fontSize = 20;
$dimensions = imagettfbbox($fontSize, $angle, $font, $text);
$textWidth = abs($dimensions[4] - $dimensions[0]);
$x = imagesx($img) - $textWidth;
imagettftext($img, 32, 0, $x, $img_height*2/10, $black, $font, $text);


imagepng($img);








?>