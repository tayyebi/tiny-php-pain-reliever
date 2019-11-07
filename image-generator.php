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
        "SELECT Title, Publisher FROM Posts WHERE Id = " . $_GET['id'] . " LIMIT 1"
    );
    $values = $result->fetch_array();
    $string = $values['Title'];
    $string_author = $values['Publisher'];
    
}

// The text to draw
$text = fagd($string,'fa','vazir');
$text_author = fagd($string_author,'fa','vazir');
$font = 'static/fonts/Vazir-Bold.ttf';

include_once('gd-text/Struct/Point.php');
include_once('gd-text/Struct/Rectangle.php');
include_once('gd-text/Box.php');
include_once('gd-text/Color.php');
include_once('gd-text/HorizontalAlignment.php');
include_once('gd-text/TextWrapping.php');
include_once('gd-text/VerticalAlignment.php');

use GDText\Box;
use GDText\Color;

$im = imagecreatetruecolor(500, 500);
$backgroundColor = imagecolorallocate($im, 0, 18, 64);
imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);

$box->setFontFace('../Sariab-V2/static/fonts/Vazir-Bold.ttf'); // http://www.dafont.com/franchise.font
$box->setFontColor(new Color(255, 75, 140));
$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(12);
$box->setLineHeight(1.5);
// $box->enableDebug();
$box->setBox(20, 20, 460, 460);
$box->setTextAlign('right', 'bottom');
$box->draw($text_author);

$box->setFontColor(new Color(255, 75, 140));
$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(40);
$box->setStrokeColor(new Color(255, 75, 140)); // Set stroke color
$box->setStrokeSize(3); // Stroke size in pixels
$box->setFontColor(new Color(255, 255, 255));
$box->setTextAlign('center', 'center');
$box->setBox(20, 20, 460, 460);
$box->draw($text);


header("Content-type: image/png");
imagepng($im);





?>