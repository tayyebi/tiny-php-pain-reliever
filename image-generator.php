<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE & ~E_STRICT");
// Set the content-type
include("fagd.php");
// Create the image

// Find the image info
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

// Solve GD problem with Persian and Arabic
function TextFactory($input, $box)
{
   // $first_character = substr($input, 0*2, 1*2);
   if (preg_match('/.*[چجحخهعغفقثصضشسیبلاتنمکگوپدذرزطظژ].*/u', $input)){
       // Persian Text
       $input = fagd($input,'fa','vazir');
       $box->setReverseTextLinesOrder(true);

       /*
       $input_array = preg_split("/\r\n|\n|\r/", $input);
       $input_array = array_reverse($input_array);
       for ($i = -1; $i < sizeof($input_array); $i++)
       {
          $input .= $input_array[$i];
       }
       */

   }
   else {
       // English text
   }

   return $input;
   
}


// Load GDText Library
include_once('gd-text/Struct/Point.php');
include_once('gd-text/Struct/Rectangle.php');
include_once('gd-text/Box.php');
include_once('gd-text/Color.php');
include_once('gd-text/HorizontalAlignment.php');
include_once('gd-text/TextWrapping.php');
include_once('gd-text/VerticalAlignment.php');

use GDText\Box;
use GDText\Color;

// Create Image
// Test GD installation
$testGD = get_extension_funcs("gd");
if (!$testGD){ echo "GD not even installed."; exit; }
// If GD installation was OK
$im = imagecreatetruecolor(500, 500);
$backgroundColor = imagecolorallocate($im, 27, 94, 32);
imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);

$text = TextFactory($string, $box);
$text_author = TextFactory($string_author, $box);
$font = 'static/fonts/Vazir-Bold.ttf';

$box->setFontFace($font);
$box->setFontColor(new Color(244, 233, 185));


// $box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(12);
$box->setLineHeight(1.5);
// $box->enableDebug();
$box->setBox(20, 20, 460, 460);
$box->setTextAlign('right', 'bottom');
$box->draw($text_author);

// $box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize(40);
$box->setStrokeColor(new Color(219, 245, 255)); // Set stroke color
$box->setStrokeSize(0); // Stroke size in pixels
$box->setTextAlign('center', 'center');
$box->setBox(20, 20, 460, 460);
$box->draw($text);


header("Content-type: image/png");
imagepng($im);
?>
