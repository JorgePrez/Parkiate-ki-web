

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

/*
//$id_parqueo ='F7B816'; // '2CE369'; //$_GET['id_parqueo']; //'2CE369'


$id_parqueo ='2CE369'; //$_GET['id_parqueo']; //'2CE369'



$query12 = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";


$result12 = pg_query($conn, $query12) or die('ERROR : ' . pg_last_error());


$id_firebase='';


              
           


                                  
                      
    
     while ($row = pg_fetch_row($result12)) {
                    $id_firebase=$row[0];
                       
              }


    $ref_tabla="/Parking_Status/".$id_firebase."/"."sensor2"."/estado"; 

    
    $status = $database->getReference($ref_tabla)->getValue();

    $id_parqueo ='F7B816';


if(str_contains($status, '1'))
{*/
/*
$received = file_get_contents('http://192.168.1.15/picture'); 


$img = 'placa_p1.jpeg';   
file_put_contents($img, $received);

////////////////////////////*
// CREATE FILE READY TO UPLOAD WITH CURL
$file = realpath('placa_p1.jpeg');  
if (function_exists('curl_file_create')) { // php 5.5+
  $cFile = curl_file_create($file);
} else {
  $cFile = '@' . realpath($file);
}


//ADD PARAMETER IN REQUEST LIKE regions
$data = array(
    'upload' => $cFile,
    'regions' => 'gp', //gt
    'camera_id' => 'camara_parqueo2', // Optional , camara_salida 
    'config' => '{"detection_mode":"vehicle"}',
//    'config' => '"{\"region\":\"strict\"}"',
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

//print_r($response);
//echo $response;


curl_close($ch);

//print_r($response->results[0]);
//DEL RESPONSE NECESITO: 
  //1. BOUNDIX BOX DE LA PLACA , PARA EDITAR LA IMAGEN
  //2. LA DETECCION QUE HIZO DE LA IMAGEN, NUMERO DE PLACA 
  //3. BOUNDIX BOX DEL AUTO , PARA EDITAR 
   // OTROS PARAMETROS : score ,candidates 

print_r($response);


$arreglo_autos=$response->results;

$arrLength = count($arreglo_autos);

echo "\n";
echo $arrLength;


for($i = 0; $i < $arrLength; $i++) {


  echo "------------------------------------------------------------";
  echo "\n";
  print_r($response->results[$i]->vehicle->box);
  echo "\n";


  $xmin_auto =$response->results[$i]->vehicle->box->xmin;
  $ymin_auto =$response->results[$i]->vehicle->box->ymin;
  $xmax_auto =$response->results[$i]->vehicle->box->xmax;
  $ymax_auto=$response->results[$i]->vehicle->box->ymax;
  
  
  
  $x_a=$xmin_auto; 
  $y_a= $ymin_auto;
  $w_a= $xmax_auto-$xmin_auto;
  $h_a= $ymax_auto-$ymin_auto;
  
  
  $response_auto=json_encode($uploader->upload($img,['folder' => 'autos/parqueo/1/prueba1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
  
  
  
  $imagen_auto = json_decode($response_auto);
  $imagen_auto =$imagen_auto->secure_url;
  
  echo "\n";
  echo $imagen_auto;
  
  echo "------------------------------------------------------------";

  
  }
*/




$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.30/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('img1.jpeg');

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
'http://192.168.1.30/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('img2.jpeg');

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
'http://192.168.1.15/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('img2.jpeg');

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
'http://192.168.1.18/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('img3.jpeg');

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
  



//TODAS:
//1172	525	1589	703
//842	487	1170	715

//485	500	795	712

//34	533	460	726

//1108	605	1513	799

//809	573	1106	800

//455	593	724	790

//29	582	417	780


//////////////////// lAS DE ESTA CAMARA



//1108	605	1513	799

//809	573	1106	800

//455	593	724	790

//29	582	417	780

$img1="img1.jpeg";
$img2="img2.jpeg";
$img3="img3.jpeg";




$arrays = [[1005,	291,	1431,568], [594,	291	,955,	568], [87,	303,	600,	565]];
 
foreach ($arrays as list($xmin_auto, $ymin_auto,$xmax_auto,$ymax_auto)) {
  $x_a=$xmin_auto; 
  $y_a= $ymin_auto;
  $w_a= $xmax_auto-$xmin_auto;
  $h_a= $ymax_auto-$ymin_auto;
  
  
  $response_auto=json_encode($uploader->upload($img1,['folder' => 'autos/parqueo/megapruebas/todas/1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
  
  
  
  $imagen_auto = json_decode($response_auto);
  $imagen_auto =$imagen_auto->secure_url;
  
  echo "\n";
  echo $imagen_auto;
  
  echo "------------------------------------------------------------";
}


$arrays2= [[927	,392	,1436	,636], [597	,362	,950,	646], [98	,369,	538	,645]];
 
foreach ($arrays2 as list($xmin_auto, $ymin_auto,$xmax_auto,$ymax_auto)) {
  $x_a=$xmin_auto; 
  $y_a= $ymin_auto;
  $w_a= $xmax_auto-$xmin_auto;
  $h_a= $ymax_auto-$ymin_auto;
  
  
  $response_auto=json_encode($uploader->upload($img2,['folder' => 'autos/parqueo/megapruebas/todas/1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
  
  
  
  $imagen_auto = json_decode($response_auto);
  $imagen_auto =$imagen_auto->secure_url;
  
  echo "\n";
  echo $imagen_auto;
  
  echo "------------------------------------------------------------";
}







$arrays3 = [[985,	279	,1519	,548], [677	,271,	1034,	557], [161	,269	,580	,557]];
 
foreach ($arrays3 as list($xmin_auto, $ymin_auto,$xmax_auto,$ymax_auto)) {
  $x_a=$xmin_auto; 
  $y_a= $ymin_auto;
  $w_a= $xmax_auto-$xmin_auto;
  $h_a= $ymax_auto-$ymin_auto;
  
  
  $response_auto=json_encode($uploader->upload($img3,['folder' => 'autos/parqueo/megapruebas/todas/1','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
  
  
  
  $imagen_auto = json_decode($response_auto);
  $imagen_auto =$imagen_auto->secure_url;
  
  echo "\n";
  echo $imagen_auto;
  
  echo "------------------------------------------------------------";
}










?>





