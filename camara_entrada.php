

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

include 'camaras_endpoints.php';




//2CE369: PARQUEO CLUB LA AURORA

//ESTA VARIABLE CAMBIA CONFORME EL PARQUEO QUE SE ESTE MONITOREANDO
$id_parqueo ='2CE369'; //$_GET['id_parqueo']; //'2CE369'


/////////////////1. VER SI ESTA ACTIVADA LA CAMARA CON ESE ID 
                      //Y SI ESTA ACTIVADA WHILE HASTA QUE SE DESACTIVE




$query12 = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";


$result12 = pg_query($conn, $query12) or die('ERROR : ' . pg_last_error());


$id_firebase='';


while ($row = pg_fetch_row($result12)) {
  $id_firebase=$row[0];
     
}


$ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/activado";


$database->getReference($ref_tabla1)->set(true);



$ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/activado";

    
$activado = $database->getReference($ref_tabla1)->getValue();

echo "CAMARA DE ENTRADA ACTIVADA:";

echo "\n";



while((str_contains($activado, '1')))

{

 // $id_parqueo ='86BE48';
// $id_parqueo_r ='2329C7';


 $id_parqueo ='86BE48';



/*
echo "CAMARA ACTIVADA:";
echo "\n";*/


$ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/activado";

    
$activado = $database->getReference($ref_tabla1)->getValue();


//2. si hay un objeto, tomamos foto, procesamos, y al finalizar de procesar
    //cambiar el estado de la variable "procesando" a falso



    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/objeto";

    
$objeto = $database->getReference($ref_tabla1)->getValue();

if((str_contains($objeto, '1')))


{

  echo "HAY OBJETO PROCESANNDO.......................:";
  echo "\n";

  //sleep(10);

  $success=true;

    
  $url = $endpoint_entrada;

  /*$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.14/picture';*/

// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('placa_entrada.jpeg');

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
//echo $response;


//curl_close($ch);

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

/////////////////////////////////////////////////


/*A	Vehículo de alquiler
C	Vehículo Comercial
CC	Cuerpo Consular
CD	Cuerpo Diplomático
M	Motocicletas y Ciclomotores
(Formato reducido)

MI	Misión Internacional
O	Vehículo Oficial
P	Vehículo Privado
TC	Remolque
U	Bus urbano
*/

$placa_necesita_correccion='S';

/* 1. Comprobar que cumpla con el formato $000AAA siendo $= A | C | M | O | P | U 
   -> Se marca que la placa cumple con formato 
*/


/* 2.Comprobar que cumppla con el formato $$00AAA siendop $= CC | CD | MI | TC 
    -> Se marca que la placa cumple con formato 

*/


/* 3. (ERROR) Que pasa si detecta 6 caracteres , si cumple el formato 000AAA, se le agregara la P por ser más probable
   -> Se marca que la placa cumple con formato 

*/

/* 4. (ERROR)  Que pasa si detecta 5 o menos letras, si el primer caracter es un numero , se le agrega la P por ser más probable
  
   ->Se marca que no cumple con formato

   */

  /* 5. (ERROR) CUALQUIER otro error que suceda debe ser corregido manualmente (es muy poco probable que suceda esto)

   */


   //ANTES DE COMPROBAR ESTO SE HARAN ALGUNAS CORRECIONES RESPECTO A ERRORES DE FORMATO CON RESPECTO A LA CONFUSIÓN DE | 0 con O | 5 con S | 1 con I | ,
   //ESTOS SOLO SE HARÁN SI TIENEN 7 CARACTERES

   //Algunas correciones primer caracter si es 0 se cambiara por una O


  if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
       $placa_detectada= substr($placa_detectada,1);
       $placa_detectada='O'.$placa_detectada; 
      $placa_necesita_correccion='N';
    }
  
  
  if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
    $n_caracter=substr($placa_detectada, 0, 1);
    //A | C | M | O | P | U 
    if(($n_caracter=='A')||
    ($n_caracter=='C')||
    ($n_caracter=='M')||
    ($n_caracter=='O')||
    ($n_caracter=='P')||
    ($n_caracter=='U')
    ){
      $placa_necesita_correccion='N';
    }
    else{
      // P por ser más probable
       $placa_detectada= substr($placa_detectada,1);
       $placa_detectada='P'.$placa_detectada; 
      $placa_necesita_correccion='N';
    }
  }


    if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
      $n_caracter=substr($placa_detectada, 0, 2);
      // CC | CD | MI | TC 
      if(($n_caracter=='CC')||
      ($n_caracter=='CD')||
      ($n_caracter=='MI')||
      ($n_caracter=='TC')
      ){
        $placa_necesita_correccion='N';
      }
      else{
        $placa_necesita_correccion='S';  
      }
  }


  
  if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
      $placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{5}$/',$placa_detectada) and strlen($placa_detectada)==8){
  $placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
  $placa_necesita_correccion='N';
}


if(preg_match('/^[A-Z]{2}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==5){
  $placa_necesita_correccion='N';
}



  if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
    $placa_detectada='P'.$placa_detectada; 
   $placa_necesita_correccion='N';
  }


  

  if((strlen($placa_detectada)<=5)&&($placa_necesita_correccion=='S')){
    $n_caracter=substr($placa_detectada, 0, 1);

  if(is_numeric($n_caracter)){
    $placa_detectada='P'.$placa_detectada;
  }

   $placa_necesita_correccion='S';



  }


  if((strlen($placa_detectada)==8)&&($placa_necesita_correccion=='S')){


                                                $placa_detectada= substr($placa_detectada,1);


                                                
                                              if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                                $placa_detectada= substr($placa_detectada,1);
                                                $placa_detectada='O'.$placa_detectada; 
                                              $placa_necesita_correccion='N';
                                            }


                                            if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                            $n_caracter=substr($placa_detectada, 0, 1);
                                            //A | C | M | O | P | U 
                                            if(($n_caracter=='A')||
                                            ($n_caracter=='C')||
                                            ($n_caracter=='M')||
                                            ($n_caracter=='O')||
                                            ($n_caracter=='P')||
                                            ($n_caracter=='U')
                                            ){
                                              $placa_necesita_correccion='N';
                                            }
                                            else{
                                              // P por ser más probable
                                                $placa_detectada= substr($placa_detectada,1);
                                                $placa_detectada='P'.$placa_detectada; 
                                              $placa_necesita_correccion='N';
                                            }
                                            }


                                            if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                              $n_caracter=substr($placa_detectada, 0, 2);
                                              // CC | CD | MI | TC 
                                              if(($n_caracter=='CC')||
                                              ($n_caracter=='CD')||
                                              ($n_caracter=='MI')||
                                              ($n_caracter=='TC')
                                              ){
                                                $placa_necesita_correccion='N';
                                              }
                                              else{
                                                $placa_necesita_correccion='S';  
                                              }
                                            }





 


                   }


//SI PARA ESTE PUNTO SIGUE necesotamdp correcion pasamos a ver los candidatos
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

   
$placa_necesita_correccion_interno='S';


if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
  $placa_detectada_interno= substr($placa_detectada_interno,1);
  $placa_detectada_interno='O'.$placa_detectada_interno; 
 $placa_necesita_correccion_interno='N';
}


if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
$n_caracter=substr($placa_detectada_interno, 0, 1);
//A | C | M | O | P | U 
if(($n_caracter=='A')||
($n_caracter=='C')||
($n_caracter=='M')||
($n_caracter=='O')||
($n_caracter=='P')||
($n_caracter=='U')
){
 $placa_necesita_correccion_interno='N';
}

else{
 // P por ser más probable
  $placa_detectada_interno= substr($placa_detectada_interno,1);
  $placa_detectada_interno='P'.$placa_detectada_interno; 
 $placa_necesita_correccion_interno='N';
}
}


if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
 $n_caracter=substr($placa_detectada_interno, 0, 2);
 // CC | CD | MI | TC 
 if(($n_caracter=='CC')||
 ($n_caracter=='CD')||
 ($n_caracter=='MI')||
 ($n_caracter=='TC')
 ){
   $placa_necesita_correccion_interno='N';
 }

 else{
   $placa_necesita_correccion_interno='S';
 }

}



if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
 $placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{3}\d{5}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==8){
$placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
$placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{2}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==5){
  $placa_necesita_correccion_interno='N';
  }


if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
$placa_detectada_interno='P'.$placa_detectada_interno; 
$placa_necesita_correccion_interno='N';
}

if((strlen($placa_detectada_interno)<=5)&&($placa_necesita_correccion_interno=='S')){
$n_caracter=substr($placa_detectada_interno, 0, 1);

if(is_numeric($n_caracter)){
$placa_detectada_interno='P'.$placa_detectada_interno;
}

$placa_necesita_correccion_interno='S';
}


if((strlen($placa_detectada_interno)==8)&&($placa_necesita_correccion_interno=='S')){


                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);


                                                  
                                                if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);
                                                  $placa_detectada_interno='O'.$placa_detectada_interno; 
                                                $placa_necesita_correccion_interno='N';
                                                }


                                                if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                $n_caracter=substr($placa_detectada_interno, 0, 1);
                                                //A | C | M | O | P | U 
                                                if(($n_caracter=='A')||
                                                ($n_caracter=='C')||
                                                ($n_caracter=='M')||
                                                ($n_caracter=='O')||
                                                ($n_caracter=='P')||
                                                ($n_caracter=='U')
                                                ){
                                                $placa_necesita_correccion_interno='N';
                                                }
                                                else{
                                                // P por ser más probable
                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);
                                                  $placa_detectada_interno='P'.$placa_detectada_interno; 
                                                $placa_necesita_correccion_interno='N';
                                                }
                                                }


                                                if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                $n_caracter=substr($placa_detectada_interno, 0, 2);
                                                // CC | CD | MI | TC 
                                                if(($n_caracter=='CC')||
                                                ($n_caracter=='CD')||
                                                ($n_caracter=='MI')||
                                                ($n_caracter=='TC')
                                                ){
                                                  $placa_necesita_correccion_interno='N';
                                                }
                                                else{
                                                  $placa_necesita_correccion_interno='S';  
                                                }
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


//consultar si existe un auto adentro con la misma placa 
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

//referencia para transformaciones
//https://cloudinary.com/documentation/transformations_on_upload

$img= $file;
//rutas: /parqueos/ID_PARQUEO/camara_entrada/ (full | placa | vehiculo)

$rutafull='/parqueos/'.$id_parqueo.'/camara_entrada/full';
$rutaplaca='/parqueos/'.$id_parqueo.'/camara_entrada/placa';
$rutavehiculo='/parqueos/'.$id_parqueo.'/camara_entrada/vehiculo';

/*
$response_full=json_encode($uploader->upload($img,['folder' => 'autos/entrada/full']));
$response_placa=json_encode($uploader->upload($img,['folder' => 'autos/entrada/placa','width' => $w, 'height' => $h, 'crop' => 'crop' , 'x' => $x, 'y' => $y]));
$response_auto=json_encode($uploader->upload($img,['folder' => 'autos/entrada/vehiculo','width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
*/

$response_full=json_encode($uploader->upload($img,['folder' => $rutafull]));
$response_placa=json_encode($uploader->upload($img,['folder' => $rutaplaca,'width' => $w, 'height' => $h, 'crop' => 'crop' , 'x' => $x, 'y' => $y]));

if($xmin_auto > 0 && $ymin_auto > 0 && $xmax_auto > 0 && $ymax_auto > 0){
  $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));

}
else{
  $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo]));

}



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




/*INSERTAR EN LA "COLA" DE los registros "por_asignar_espacios" */
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_asignar=$key;


  $query = "INSERT INTO por_asignar_espacio VALUES ('$id_asignar', '$now','$id_placa_entrada','$id_parqueo')";
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
    id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app,fecha_registro_auto)
    VALUES ('$id_auto', '$placa_detectada', 0, '$imagen_auto', 'Pendiente', '$id_parqueo', 'Por definir', '$now');";
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

$success=true;

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

$success=false;

}





//Comprobar si existe un auto con la placa detectada, sino crear uno
}
else{
  echo "\n";

  echo "warning: en la foto no hay ninguna placa";
  $success=false;

}



  //TERMINANDO DE PROCESAR Y CAMBIANDO VARIABLE
      $ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/procesando";


$database->getReference($ref_tabla1)->set(false);



  echo "termino de procesar, mostrando resultado";
  echo "\n";


    //CON EL RESULTADO DEBEMOS MOSTRAR SI FUE BUEN PROCESAdO O MAL PROCESADO

//$success=false;

  if($success){
    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/success";


    $database->getReference($ref_tabla1)->set(true);

  }
  else{

    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_entrada/success";


    $database->getReference($ref_tabla1)->set(false);


  }
  
  sleep(3);

}

}

echo "---------------------CAMARA ENTRADA DESACTIVADA ,FINALIZANDO SCRIPT-----------------";



?>



