

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
{
/*
$received = file_get_contents('http://192.168.1.13/picture'); 


$img = 'placa_entrada_p.jpeg';   
file_put_contents($img, $received);*/



$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.13/picture';
// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('placa_entrada_p.jpeg');

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
curl_close($ch);

// Close file
fclose($fp);






// CREATE FILE READY TO UPLOAD WITH CURL
$file = realpath('placa_entrada_p.jpeg');  
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
//echo $response;


curl_close($ch);

//print_r($response->results[0]);
//DEL RESPONSE NECESITO: 
  //1. BOUNDIX BOX DE LA PLACA , PARA EDITAR LA IMAGEN
  //2. LA DETECCION QUE HIZO DE LA IMAGEN, NUMERO DE PLACA 
  //3. BOUNDIX BOX DEL AUTO , PARA EDITAR 
   // OTROS PARAMETROS : score ,candidates 

print_r($response);

//variable del boundix box de la placa 

if(!($response->results[0]===null)){
 
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
  }else{
   // $placa_detectada= substr($placa_detectada,1);
  }

  $placa_necesita_correccion='S';
}

if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){

  $placa_necesita_correccion='N';


  $primer_caracter=substr($placa_detectada, 0, 1);

  if($primer_caracter=='D'){
    $placa_detectada= substr($placa_detectada,1);
    $placa_detectada='P'.$placa_detectada;
  }

}

//SI PARA ESTE PUNTO SIGUE SI DETECTAR TODAS LAS LETRAS, VAMOS A USAR LOS OTROS RESULTADOS SI HAY
 if($placa_necesita_correccion=='S'){


  $nuevo_resultado="";
  $encontrenuevaplaca="";

  $arreglo_candidatos=$response->results[0]->candidates;

  $arrLength = count($arreglo_candidatos);


  for($i = 1; $i < $arrLength; $i++) {

    $placa_detectada_interno= $response->results[0]->candidates[$i]->plate;

    //print_r($posible_candidato);
    $placa_detectada_interno = strtoupper($placa_detectada_interno);
    
    //////////////////////////////////////////////////
    //echo $posible_candidato;

   // echo "\n";

   
$placa_necesita_correccion_interno='';


if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){

  $placa_necesita_correccion_interno='N';

}

else if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/', $placa_detectada_interno) and strlen($placa_detectada_interno)==6)
{
  $string='paso con 6';

  $placa_detectada_interno='P'.$placa_detectada_interno;
  $placa_necesita_correccion_interno='N';


}
else{
  $primer_caracter=substr($placa_detectada_interno, 0, 1);

  //TODO: WHAT TO DO WITH PP

  if(is_numeric($primer_caracter)){
    $placa_detectada_interno='P'.$placa_detectada_interno;
  }else{
   // $placa_detectada_interno= substr($placa_detectada_interno,1);
  }

  $placa_necesita_correccion_interno='S';
}

if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){

  $placa_necesita_correccion_interno='N';
  $primer_caracter=substr($placa_detectada_interno, 0, 1);

  if($primer_caracter=='D'){
    $placa_detectada_interno= substr($placa_detectada_interno,1);
    $placa_detectada_interno='P'.$placa_detectada_interno;
  }


}

if( $placa_necesita_correccion_interno=='N'){
  $placa_detectada=$placa_detectada_interno;

  $placa_necesita_correccion='N';

  
  
  break;
}


/////////////////////////////////////////////////////////////////////////////


    

}
/*echo "\n";
echo "Longitud: ";
  echo $arrLength;

*/


 }










//$bounding_box_placa = $xmin_placa + $ymin_placa + $xmax_placa + $ymax_placa;



//consultar si existe un auto adentro con la misma placa o correción




$query="select * from placas_entrada where id_parqueo='$id_parqueo' AND dentro_fuera='D'  AND (deteccion_entrada='$placa_detectada' OR (position('$placa_detectada' in deteccion_entrada)>0))"; 



$resultadoplacaexiste = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad_autos_adentro_misma_placa = pg_affected_rows($resultadoplacaexiste);

pg_free_result($resultadoplacaexiste);



if(($cantidad_autos_adentro_misma_placa==0)){ 


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


//referecnia para transformaciones
//https://cloudinary.com/documentation/transformations_on_upload

$img= $file;


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





$query = "INSERT INTO placas_entrada VALUES ('$id_placa_entrada',  '$now','$imagen_auto', '$placa_detectada','$id_parqueo','$imagen_full','$imagen_placa','D')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


//sino tiene error hara lo sigueinte

//////if($placa_necesita_correccion=='N'){ 
// AUTO 
$query = "Select  * FROM auto WHERE placa='$placa_detectada' AND id_parqueo='$id_parqueo'";
$resultadoauto = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas4 = pg_affected_rows($resultadoauto);


$id_auto='';


 

if($tuplasaafectadas4>0){
  while ($row = pg_fetch_row($resultadoauto)) {
    $id_auto=$row[0];
}
  
pg_free_result($resultadoauto);
echo "\n";

echo "id existrente: ";
echo $id_auto;

//UPDATEIMAGEN

$query= "UPDATE auto SET foto_delante='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


}else{


  pg_free_result($resultadoauto);

$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_auto=$key;

  $query = "INSERT INTO auto(
    id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app)
    VALUES ('$id_auto', '$placa_detectada', 0, '$imagen_auto', 'Pendiente', '$id_parqueo', 'Por definir');";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);
echo "\n";

echo "Registrando nuevo auto";
  }



$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_entrada_salida=$key;

$query="INSERT INTO placas_entrada_salida(
	id_entrada_salida, id_deteccion_entrada, id_deteccion_salida, id_auto, id_parqueo, id_servicio_app,tiempo_total,deteccion_entrada_salida,existe_error)
	VALUES ('$id_entrada_salida', '$id_placa_entrada', 'NA', '$id_auto', '$id_parqueo', 'NA','NA','$placa_detectada','$placa_necesita_correccion');";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);
echo "\n";

echo "Success: camara_entrada registrando";
/*
}
else{
  echo "\n";

  echo "warning: presente no se registro ni auto ni entrada_salida";
}*/



}
else{
  echo "\n";

  echo "warning: imagen repetida";

  echo "\n";
echo $placa_detectada;
echo "-->";
echo $placa_necesita_correccion;

}





//Comprobar si existe un auto con la placa detectada, sino crear uno
}
else{
  echo "\n";

  echo "warning: en la foto no hay ninguna placa";

}


}
else {

  echo "warning: No hay nada en la imagen";



}


//p567a0ahttps://res.cloudinary.com/parkiate-ki/image/upload/v1653182389/autos/entrada/placa/zxjygwpqbd5q9wadxfw5.jpg

//https://res.cloudinary.com/parkiate-ki/image/upload/v1653182390/autos/entrada/vehiculo/ewrypv9irsp1akim1xxc.jpg

//$bounding_box_auto = $xmin_auto + $ymin_auto + $xmax_auto + $ymax_auto;

//echo $bounding_box_auto;




//print_r($result);
//exit;

?>





