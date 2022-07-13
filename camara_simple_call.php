

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


  // Initialize a file URL to the variable
  $url = 
  //'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
  'https://res.cloudinary.com/parkiate-ki/image/upload/v1657176252/parqueos/86BE48/camara_entrada/vehiculo/thwym9zp8huowemdf7r2.jpg';
  // Initialize the cURL session
  $ch = curl_init($url);
  
  // Initialize directory name where
  // file will be save
  $dir = './';
  
  // Use basename() function to return
  // the base name of file
  $file_name = basename('archivito.jpeg');
  
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







// CREATE FILE READY TO UPLOAD WITH CURL
$file = realpath('archivito.jpeg');
if (function_exists('curl_file_create')) { // php 5.5+
  $cFile = curl_file_create($file);
} else {
  $cFile = '@' . realpath($file);
}

//ADD PARAMETER IN REQUEST LIKE regions
$data = array(
    'upload' => $cFile,
    'regions' => 'gp', //gt
    'camera_id' => 'camara_salida', // Optional , camara_salida
    'config' => '{"detection_mode":"vehicle"}',

   // 'config' => '{"mode":"redaction"}',

);

// Prepare new cURL resource
$ch = curl_init('https://api.platerecognizer.com/v1/plate-reader/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);

// Set HTTP Header for POST request
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Token 222f6c6970669f844c36f2b342a45cae3d88f73c"  //API KEY
    )
);

$now = new Datetime('now');
$now = $now->format('Y-m-d H:i:s');





//pasarla a json encode , 

//regreso a json decode- objecto de php 



// Submit the POST request and close cURL session handle
$result = curl_exec($ch);



$response = json_decode($result);
print_r($response);

/*
$xmin_placa =$response->results[0]->box->xmin;
$ymin_placa =$response->results[0]->box->ymin;
$xmax_placa =$response->results[0]->box->xmax;
$ymax_placa=$response->results[0]->box->ymax;


$x=$xmin_placa; 
$y= $ymin_placa;
$w= $xmax_placa-$xmin_placa;
$h= $ymax_placa-$ymin_placa;


//PLACA DETECTADA
$placa_detectada=$response->results[0]->plate;
$placa_detectada = strtoupper($placa_detectada);

$xmin_auto =$response->results[0]->vehicle->box->xmin;
$ymin_auto =$response->results[0]->vehicle->box->ymin;
$xmax_auto =$response->results[0]->vehicle->box->xmax;
$ymax_auto=$response->results[0]->vehicle->box->ymax;



$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

echo "\n";
echo $placa_detectada;
echo "-->";
echo $placa_necesita_correccion;

//EJEMPLO DE CROPPING CON TRANSFORMACIONS DE CLOUDINARY
//https://res.cloudinary.com/demo/image/upload/c_crop,h_200,w_300,x_355,y_410/brown_sheep.jpg

//$uploader->upload($img,['folder' => 'autos/salida/'],['public_id'=>'blackberry']);

//referencia para transformaciones
//https://cloudinary.com/documentation/transformations_on_upload

$img= $file;
//rutas: /parqueos/ID_PARQUEO/camara_entrada/ (full | placa | vehiculo)

$rutafull='/parqueos/'."PRUEBAS".'/camara_entrada/full';
$rutaplaca='/parqueos/'."PRUEBAS".'/camara_entrada/placa';
$rutavehiculo='/parqueos/'."PRUEBAS".'/camara_entrada/vehiculo';



$response_full=json_encode($uploader->upload($img,['folder' => $rutafull]));
$response_placa=json_encode($uploader->upload($img,['folder' => $rutaplaca,'width' => $w, 'height' => $h, 'crop' => 'crop' , 'x' => $x, 'y' => $y]));

if($xmin_auto > 0 && $ymin_auto > 0 && $xmax_auto > 0 && $ymax_auto > 0){
  $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));

}
else{
  $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo]));

}

print_r($response);
*/



?>



