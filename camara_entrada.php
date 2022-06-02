

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


$id_parqueo ='2CE369'; //$_GET['id_parqueo']; //'2CE369'





$query12 = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";


$result12 = pg_query($conn, $query12) or die('ERROR : ' . pg_last_error());


$id_firebase='';


              
           


                                  
                      
    
     while ($row = pg_fetch_row($result12)) {
                    $id_firebase=$row[0];
                       
              }


    $ref_tabla="/Parking_Status/".$id_firebase."/"."entrada"."/estado";

    
    $status = $database->getReference($ref_tabla)->getValue();


if(str_contains($status, '1'))
{

$received = file_get_contents('http://192.168.1.10/picture');


$img = 'placa_entrada.jpeg';
file_put_contents($img, $received);


// CREATE FILE READY TO UPLOAD WITH CURL
$file = realpath('placa_entrada.jpeg');
if (function_exists('curl_file_create')) { // php 5.5+
  $cFile = curl_file_create($file);
} else {
  $cFile = '@' . realpath($file);
}

//ADD PARAMETER IN REQUEST LIKE regions
$data = array(
    'upload' => $cFile,
    'regions' => 'gp', //gt
    'camera_id' => 'camara_entrada', // Optional , camara_salida
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


curl_close($ch);

//print_r($response->results[0]);
//DEL RESPONSE NECESITO: 
  //1. BOUNDIX BOX DE LA PLACA , PARA EDITAR LA IMAGEN
  //2. LA DETECCION QUE HIZO DE LA IMAGEN, NUMERO DE PLACA 
  //3. BOUNDIX BOX DEL AUTO , PARA EDITAR 
   // OTROS PARAMETROS : score ,candidates 


//variable del boundix box de la placa 
 
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


//1.Comprar longitud , si es 6 pasar al punto 2 sino pasar al punto 3
//2.COMPARAR CON si sigue la expresion regular "000AAA" , SI ES ASI AGREGAR "P" ELSE QUE SIGA IGUAL y pasar al punto 3
//3DESPUES COMPARAR CANTIDAD DE CARACTERES , si es 7 agregar en correccion N , sino agregar S


//[A-Z]{3}|[0-9]{5}

$placa_necesita_correccion='';


if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){

  $placa_necesita_correccion='N';

}

else if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/', $placa_detectada) and strlen($placa_detectada)==6)
{
  $string='paso con 6';

  $placa_detectada='P'.$placa_detectada;
  $placa_necesita_correccion='N';


}
else{
  $primer_caracter=substr($placa_detectada, 0, 1);

  if(is_numeric($primer_caracter)){
    $placa_detectada='P'.$placa_detectada;
  }

  $placa_necesita_correccion='S';
}




//$bounding_box_placa = $xmin_placa + $ymin_placa + $xmax_placa + $ymax_placa;



//configurar algunas cosas....


$xmin_auto =$response->results[0]->vehicle->box->xmin;
$ymin_auto =$response->results[0]->vehicle->box->ymin;
$xmax_auto =$response->results[0]->vehicle->box->xmax;
$ymax_auto=$response->results[0]->vehicle->box->ymax;



$x_a=$xmin_auto; 
$y_a= $ymin_auto;
$w_a= $xmax_auto-$xmin_auto;
$h_a= $ymax_auto-$ymin_auto;

//EJEMPLO DE CROPPING CON TRANSFORMACIONS DE CLOUDINARY
//https://res.cloudinary.com/demo/image/upload/c_crop,h_200,w_300,x_355,y_410/brown_sheep.jpg





//$uploader->upload($img,['folder' => 'autos/salida/'],['public_id'=>'blackberry']);


//referecnia para transformaciones
//https://cloudinary.com/documentation/transformations_on_upload


$response_full=json_encode($uploader->upload($img,['folder' => 'autos/entrada/full']));
$response_placa=json_encode($uploader->upload($img,['folder' => 'autos/entrada/placa','width' => $w, 'height' => $h, 'crop' => 'crop' , 'x' => $x, 'y' => $y]));
$response_auto=json_encode($uploader->upload($img,['folder' => 'autos/entrada/vehiculo','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));


$imagen_full = json_decode($response_full);
$imagen_full=$imagen_full->secure_url;


$imagen_placa = json_decode($response_placa);
$imagen_placa=$imagen_placa->secure_url;



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;


 
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_placa_entrada=$key;
  
  $correccion_deteccion='NA';





$query = "INSERT INTO placas_entrada VALUES ('$id_placa_entrada',  '$now','$imagen_auto', '$placa_detectada','$id_parqueo','$imagen_full','$placa_necesita_correccion','$correccion_deteccion','$imagen_placa')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


echo "camara_entrada registrando";

}
else {

  echo "no hay NADA en la entrada";



}


//p567a0ahttps://res.cloudinary.com/parkiate-ki/image/upload/v1653182389/autos/entrada/placa/zxjygwpqbd5q9wadxfw5.jpg

//https://res.cloudinary.com/parkiate-ki/image/upload/v1653182390/autos/entrada/vehiculo/ewrypv9irsp1akim1xxc.jpg

//$bounding_box_auto = $xmin_auto + $ymin_auto + $xmax_auto + $ymax_auto;

//echo $bounding_box_auto;




//print_r($result);
//exit;

?>



