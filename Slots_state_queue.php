
<?php





require __DIR__ . '/vendor/autoload.php';

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

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


$id_park_slot='86BE48'; 



$query = "select id_firebase from parqueo where id_parqueo='$id_park_slot'";
//                       $query = "select * from prospectos_template";


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_firebase='';





while ($row = pg_fetch_row($result)) {
  
     $id_firebase=$row[0];

 
}

pg_free_result($result);
if(strlen($id_firebase)>0 ){


while(true){


//$arreglo_candidatos=$response->results[0]->candidates;


$query = "select id_firebase_slot,estado_anterior from slots where id_parqueo='$id_park_slot' order by codigo";


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$tuplasaafectadas = pg_affected_rows($result);


$id_firebase_slot='';
$estado_anterior='';


if($tuplasaafectadas>0) {

  include('dbcon.php');

  while ($row = pg_fetch_row($result)) {

    $id_firebase_slot=$row[0];
    $estado_anterior=$row[1];

    $now = new Datetime('now');
$now = $now->format('Y-m-d H:i:s');

//Obtener el más antiguo (cola)

$query = "select id_asignar,id_placa_entrada from por_asignar_espacio where id_parqueo='$id_park_slot' AND timestamp_asignado=(select min(timestamp_asignado) from por_asignar_espacio where id_parqueo='$id_park_slot')";


$numero_de_placa_asignar='';
$fotografia_entrada='';


$result1 = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$tuplasaafectadas2 = pg_affected_rows($result1);

$id_asignar='';
$id_placa_entrada='';



while ($row = pg_fetch_row($result1)) {
  
     $id_asignar=$row[0];
     $id_placa_entrada=$row[1];

 
}

pg_free_result($result1);


if($tuplasaafectadas2>0) {

  $query = "  select foto_auto_entrada,deteccion_entrada from placas_entrada where id_parqueo='$id_park_slot' AND id_placa_entrada='$id_placa_entrada'";


$result2 = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$foto_auto_entrada='';
$deteccion_entrada='';




while ($row = pg_fetch_row($result2)) {
  
     $foto_auto_entrada=$row[0];
     $deteccion_entrada=$row[1];

 
}

pg_free_result($result2);

$numero_de_placa_asignar=$deteccion_entrada;
$fotografia_entrada=$foto_auto_entrada;

}

echo "placa:".$numero_de_placa_asignar ."\n";
echo "foto:".$fotografia_entrada ."\n";







    



 $ref_tabla_codigo="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/codigo";
 $ref_tabla_estado="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/estado";
 $ref_tabla_id_slot="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/id_slot";
 $ref_tabla_reservas="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/reservas";




  $codigo = $database->getReference($ref_tabla_codigo)->getValue();
  $status = $database->getReference($ref_tabla_estado)->getValue();
  $id_slot = $database->getReference($ref_tabla_id_slot)->getValue();
  $reservas = $database->getReference($ref_tabla_reservas)->getValue();

  

  echo "-----------------\n";
  echo "estado anterior:".$estado_anterior ."\n";
  echo "codigo:".$codigo ."\n";
  if(str_contains($status, '1'))
  {
      $estado_actual='S';
      echo "estado:"."VACIO"." --> ";
      $queriesa= "UPDATE slots SET estado='S' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
      $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
      pg_free_result($resultadosa);

      if($estado_actual==$estado_anterior){
        echo "NO CAMBIO\n";
      }
      else{
        echo "HUBO CAMBIO OCUPADO->VACIO\n";
        $queriesa= "UPDATE slots SET timestamp_cambio_vacio='$now' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
        $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
        pg_free_result($resultadosa);
    
        
      }
      $queriesa= "UPDATE slots SET estado_anterior='S' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
      $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
      pg_free_result($resultadosa);

      


  }else{
      $estado_actual='N';
      echo "estado:"."OCUPADO" ." --> ";
      $queriesa= "UPDATE slots SET estado='N' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
      $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
      pg_free_result($resultadosa);

      if($estado_actual==$estado_anterior){
        echo "NO CAMBIO\n";
      }
      else{

        //Si hubo este cambio se debe revisar si hay un auto en "espera" si lo esta entonces este se debe asignar a este espacio


        if((strlen($numero_de_placa_asignar))>0){

          echo "HUBO CAMBIO VACIO->OCUPADO + HAY AUTO PARA ASIGNAR\n";

          //asginar correspondiente 

          $queriesa= "UPDATE slots SET timestamp_cambio_ocupado='$now',auto_img='$fotografia_entrada',placa_slot='$numero_de_placa_asignar' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
          $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
          pg_free_result($resultadosa);

          //eliminar

          
          //Borrar la que ya existe....
          $query = "DELETE FROM  por_asignar_espacio WHERE id_parqueo='$id_park_slot' AND id_asignar='$id_asignar'";
          if($resultadoeliminar = pg_query($query)){
            echo "Data Deleted Successfully.";
          }
          else{
            echo "Error.";
          }
          
          pg_free_result($resultadoeliminar);
  

        }
        else{
          echo "HUBO CAMBIO VACIO->OCUPADO\n";
          $queriesa= "UPDATE slots SET timestamp_cambio_ocupado='$now' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
          $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
          pg_free_result($resultadosa);
  


        }


 
    
        
      }

      $queriesa= "UPDATE slots SET estado_anterior='N' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
      $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
      pg_free_result($resultadosa);
  }

 





  echo "id_slot:".$id_slot ."\n";
  echo "reservas:".$reservas ."\n";






}



  





}
else{
  break;
}






  echo "\n";




  //OBTENER IMAGENES DE SLOTS


  ////////////////////////////////////////////////////////////////////PENDIENTE

  /*

  include 'camaras_endpoints.php';




  
if((strlen($endpoint_parqueo1_3>0))&& (strlen($endpoint_parqueo4_6>0)) && (strlen($endpoint_parqueo7_9>0))){



  
//COPIAR LA IMAGEN A FILESYSTEM


$url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
$endpoint_parqueo1_3;
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
$endpoint_parqueo4_6;
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
$endpoint_parqueo7_9;
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


$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/1';



$response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



$imagen_auto = json_decode($response_auto);
$imagen_auto =$imagen_auto->secure_url;

echo "\n";
echo "slot:1";
echo "\n";
echo $imagen_auto;
echo "\n";



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

$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/2';


$response_auto=json_encode($uploader->upload($img,

['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));



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



$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/3';





//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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

$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/4';



$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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

$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/5';


//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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
$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/6';


//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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
$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/7';


//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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
$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/8';


//TODO: mejor registrar con ID DE PARQUEO EN LA CARPETA....

//TODO: DESPUES DE TENER TODOS LOS ESPACIOS HACER RESIZE

$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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

$rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/9';




$response_auto=json_encode($uploader->upload($img,
['folder' => $rutafull,
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







}











  

  sleep(5);
*/  ////////////////////////////////////////////////////////////////////PENDIENTE



sleep(5);


}

                   
}







          ?>
        
      