
<?php





require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

use Cloudinary\Transformation\Resize;

use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\Crop;
use Cloudinary\Transformation\Quality;
use Cloudinary\Transformation\Format;








date_default_timezone_set('America/Guatemala');



 $cloudinary = new Cloudinary(
    [
        "cloud" =>
            [
                'cloud_name' => 'parkiate-ki',
                'api_key'    => '794241658481217',
                'api_secret' => 'qRQnXnrfL-xqXug4sfFlMgGfeAY',
            ],
            'url' => [
                       'secure' => true //default
            ]
    ]
);

$uploader = $cloudinary->uploadApi();


                   

$url = 
'http://192.168.1.19/picture';
//$endpoint_parqueo1_3;
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('foto_area_parqueo.jpeg');

// Save file into file location
$save_file_loc = $dir . $file_name;

// Open file
$fp = fopen($save_file_loc, 'wb');

// It set an option for a cURL transfer
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

// Perform a cURL session
curl_exec($ch);

// Closes a cURL session and frees all resources
//curl_close($ch);

// Close file
fclose($fp);



$id_park_slot='pruebas_slot';

//SLOTS 1

//109	251	602	566


/*
$xmin_auto=89;
$ymin_auto=231;
$xmax_auto=602;
$ymax_auto=566;*/


/////////////////////////////////////////////// SLOT 1

$w_a= 224;  // all bounding boxes width
$h_a= 224; // all bounding boxes height
$x_a=0;   //solo este cambia por cada slot -  Position X(px)
$y_a= 360; // all bounding boxes Position Y(px)

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/1';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:1";
echo "\n";
echo $imagen_auto;
echo "\n";

//////////////////////////////////////////// SLOT 2


$x_a=170; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/2';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:2";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 3


$x_a=350; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/3';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:3";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 4


$x_a=530; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/4';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:4";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 5

$x_a=700; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/5';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:5";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 6


$x_a=870; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/6';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:6";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 7

$x_a=1050; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/7';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:7";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 8


$x_a=1200; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/8';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:8";
echo "\n";
echo $imagen_auto;
echo "\n";


//////////////////////////////////////////// SLOT 9


$x_a=1370; 

$file = realpath('foto_area_parqueo.jpeg');  

$img=$file;


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/9';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:9";
echo "\n";
echo $imagen_auto;
echo "\n";












          ?>
        
      