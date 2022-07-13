

<?php


require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

use Cloudinary\Transformation\Resize;

use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\Crop;
use Cloudinary\Transformation\Quality;
use Cloudinary\Transformation\Format;







$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

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

include('dbcon.php');


//ID del parqueo actual ,ass


//COPIAR LA IMAGEN A FILESYSTEM


$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.8/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('parqueo1_3.jpeg');

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



$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.6/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('parqueo4_6.jpeg');

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



$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.5/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('parqueo7_9.jpeg');

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


//SLOTS 1

//109	251	602	566



$xmin_auto=89;
$ymin_auto=231;
$xmax_auto=602;
$ymax_auto=566;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo1_3.jpeg');  

$img=$file;


//rutas: /parqueos/ID_PARQUEO/camara_entrada/ (full | placa | vehiculo)

/*$id_parqueo="SADASDASvg";


$rutafull='/parqueos/'.$id_parqueo.'/camara_entrada/full';
$rutaplaca='/parqueos/'.$id_parqueo.'/camara_entrada/placa';
$rutavehiculo='/parqueos/'.$id_parqueo.'/camara_entrada/vehiculo';*/



$response_auto=json_encode($uploader->upload($img,['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));


//$response_auto=json_encode($uploader->upload($img,['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:1";
echo "\n";
echo $imagen_auto;
echo "\n";

/*

TODO: Con este bloque de codigo podemos reajustar el tamaño de una imagen
que ya esta registrada en cloudinry, se debe ver si se reajusta el tamaño
aqui o si se hace en la tabla a la hora de mostrar la imagen....

$url = $imagen_auto;
$ch = curl_init($url);
$dir = './';
$file_name = basename('slot1_resize.jpeg');
$save_file_loc = $dir . $file_name;
$fp = fopen($save_file_loc, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
fclose($fp);


$file = realpath('slot1_resize.jpeg');  

$img=$file;


$response_auto=json_encode($uploader->upload($img,['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/1','crop' => 'scale' , 'width' => 250]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:1";
echo "\n";
echo $imagen_auto;
echo "\n";

*/


//SLOTS 2

//634	233	1052	564



$xmin_auto=614;
$ymin_auto=213;
$xmax_auto=1052;
$ymax_auto=564;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo1_3.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,

['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/2','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:2";
echo "\n";
echo $imagen_auto;
echo "\n";

//SLOTS 3

//982	217	1581	562


$xmin_auto=962;
$ymin_auto=197;
$xmax_auto=1581;
$ymax_auto=562;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo1_3.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/3',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:3";
echo "\n";
echo $imagen_auto;
echo "\n";



//SLOTS 4

//42	335	538	639


$xmin_auto=22;
$ymin_auto=315;
$xmax_auto=538;
$ymax_auto=639;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo4_6.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/4',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:4";
echo "\n";
echo $imagen_auto;
echo "\n";





//SLOTS 5

//555	353	939	647


$xmin_auto=535;
$ymin_auto=333;
$xmax_auto=939;
$ymax_auto=647;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo4_6.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/5',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:5";
echo "\n";
echo $imagen_auto;
echo "\n";



//SLOTS 6

//907	356	1457	639


$xmin_auto=877;
$ymin_auto=336;
$xmax_auto=1457;
$ymax_auto=639;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo4_6.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/6',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:6";
echo "\n";
echo $imagen_auto;
echo "\n";




//SLOTS 7

//55	253	610	566


$xmin_auto=35;
$ymin_auto=233;
$xmax_auto=610;
$ymax_auto=566;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo7_9.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/7',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:7";
echo "\n";
echo $imagen_auto;
echo "\n";


//SLOTS 8

//570	247	989	573


$xmin_auto=550;
$ymin_auto=227;
$xmax_auto=989;
$ymax_auto=573;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo7_9.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/8',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:8";
echo "\n";
echo $imagen_auto;
echo "\n";



//SLOTS 9
//978	256	1475	564




$xmin_auto=958;
$ymin_auto=236;
$xmax_auto=1475;
$ymax_auto=564;


$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

$file = realpath('parqueo7_9.jpeg');  

$img=$file;

//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => 'autos/parqueo/MNEIADA2434J235609jquiw/slot/9',
'width' => $w_a, 'height' => $h_a, 
'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
//print_r ($imagen_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:9";
echo "\n";
echo $imagen_auto;
echo "\n";













?>





