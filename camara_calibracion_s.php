

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

//TODO: VALOR QUEMADO POR CUESTION DE PRUEBAS Y HARDWARE, CORRESPONDE A SENSORES DE MOVIMIENTO DE ENTRADAS Y SALIDAS

$id_parqueo ='2CE369'; //$_GET['id_parqueo']; //'2CE369'


/////////////////1. VER SI ESTA ACTIVADA LA CAMARA CON ESE ID 
                      //Y SI ESTA ACTIVADA WHILE HASTA QUE SE DESACTIVE




$query12 = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";


$result12 = pg_query($conn, $query12) or die('ERROR : ' . pg_last_error());


$id_firebase='';


while ($row = pg_fetch_row($result12)) {
  $id_firebase=$row[0];
     
}


$ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/activado";


$database->getReference($ref_tabla1)->set(true);



$ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/activado";

    
$activado = $database->getReference($ref_tabla1)->getValue();

echo "CAMARA DE ENTRADA/SALIDA ACTIVADA:";

echo "\n";



while((str_contains($activado, '1')))

{

 // $id_parqueo ='86BE48';
// $id_parqueo_r ='2329C7';


 $id_parqueo =$id_parqueo_actual;



/*
echo "CAMARA ACTIVADA:";
echo "\n";*/


$ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/activado";

    
$activado = $database->getReference($ref_tabla1)->getValue();


//2. si hay un objeto, tomamos foto, procesamos, y al finalizar de procesar
    //cambiar el estado de la variable "procesando" a falso



    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/objeto";

    
$objeto = $database->getReference($ref_tabla1)->getValue();

if((str_contains($objeto, '1')))


{

  echo "HAY OBJETO PROCESANNDO.......................:";
  echo "\n";

  //sleep(10);

  $success=true;

    
  $url = $endpoint_salida;

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



include('placa_procesando.php');











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


include('placa_comprobando2.php');


//EJEMPLO DE CROPPING CON TRANSFORMACIONS DE CLOUDINARY
//https://res.cloudinary.com/demo/image/upload/c_crop,h_200,w_300,x_355,y_410/brown_sheep.jpg

//$uploader->upload($img,['folder' => 'autos/salida/'],['public_id'=>'blackberry']);

//referencia para transformaciones
//https://cloudinary.com/documentation/transformations_on_upload

$img= $file;
//rutas: /parqueos/ID_PARQUEO/camara_entrada/ (full | placa | vehiculo)

$rutafull='/parqueos/'.$id_parqueo.'/camara_salida/full';
$rutaplaca='/parqueos/'.$id_parqueo.'/camara_salida/placa';
$rutavehiculo='/parqueos/'.$id_parqueo.'/camara_salida/vehiculo';

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








echo "\n";

echo "Success: camara_salida registrando";

$success=true;

/*
}
else{
  echo "\n";

  echo "warning: presente no se registro ni auto ni entrada_salida";
}*/






//Comprobar si existe un auto con la placa detectada, sino crear uno
}
else{
  echo "\n";

  echo "warning: en la foto no hay ninguna placa";
  $success=false;

}



  //TERMINANDO DE PROCESAR Y CAMBIANDO VARIABLE
      $ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/procesando";


$database->getReference($ref_tabla1)->set(false);


echo "\n";

  echo "termino de procesar, mostrando resultado";
  echo "\n";


    //CON EL RESULTADO DEBEMOS MOSTRAR SI FUE BUEN PROCESAdO O MAL PROCESADO

//$success=false;

  if($success){
    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/success";


    $database->getReference($ref_tabla1)->set(true);

  }
  else{

    $ref_tabla1="/Parking_Status/".$id_firebase."/camara_salida/success";


    $database->getReference($ref_tabla1)->set(false);


  }
  
  sleep(10);

}

}

echo "---------------------CAMARA ENTRADA DESACTIVADA ,FINALIZANDO SCRIPT-----------------";

/*
TODO:QUE SE DEBE HACER PARA REGISTRAR


SENSOR DETECTA?

   NO
        NADA

  
  SI
       ENVIA IMAGEN A API
                         RESULTADO VALIDA?

                                            NO
                                                LUZ AMARILLA->MENSAJE: NO HAY PLACA EN LA IMAGEN
                                                


                                            SI
                                               EXISTEN AUTOS DENTRO?
                                                    
                                                 NO
                                                      LUZ AMARILLA->MENSAJE: NADA QUE REGISTRAR                          
                                

                                                

                                                 SI

                                                    ES IGUAL A LA ULTIMA PLACA (CON UN TIMESTAMP MENOR A 3 MIN)

                                                                                NO
                                                                                      REGISTRAR EN SALIDA
                                                                                      COINCIDE CON ALGUNA PLACA?

                                                                                                                NO
                                                                                                                        ELIMINAR TUPLA DE SALIDA
                                                                                                                        LUZ AMARILLA->MENSAJE: NO COINCIDE

                                                                                                                        




                                                                                                                SI
                                                                                                                        ASIGNAR ID A placas_entrada_salida + editar los campos correspondientes(ENTRADA)

                                                                                                                        EXISTE USUARIO
                                                                                                                                        NO
                                                                                                                                              NO SE HACE NADA

                                                                                                                                        SI


                                                                                                                                              ACTUALIZAR EL CAMPO ID_VISITA_actual de usuario a N





                                                                                                                        
                                                                                                                        
                                                                                                                        AUTO EXISTE?

                                                                                                                                    NO
                                                                                                                                       
                                                                                                                                        NO SE HACE NADA



                                                                                                                                    SI
                                                                                                                                        ACTUALIZAR auto, con placa+ id_parqueo , numeros de visitas+1


                                                                              
                                                                                                                                                        
 

                                                                                                                                        




                                                                                                                          






                                                                                SI

                                                                                      LUZ AMARILLA->MENSAJE: IMAGEN REPETIDA
                                                                               
                                              

                                                                          






 */


?>



