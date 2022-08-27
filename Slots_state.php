
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


include 'camaras_endpoints.php';

$id_park_slot= $id_parqueo_actual; //'86BE48'; //'2CE369'; 

$existen_camaras=$existen_camaras_slot;





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

  



$query = "select id_firebase_slot,estado_anterior,w_a,h_a,x_a,y_a from slots where id_parqueo='$id_park_slot' order by codigo";


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$tuplasaafectadas = pg_affected_rows($result);


$id_firebase_slot='';
$estado_anterior='';
$w_a='';
$h_a='';
$x_a='';
$y_a='';
$estado_anterior='';
$id_firebase_slot='';
$estado_anterior='';




if(($tuplasaafectadas>0)) {

/*
  if((strlen($w_a))>1){
    $existen_camaras='1';

    echo "Si hay camaras\n";



  }
  else{
    $existen_camaras='0';

    echo "No existen camaras\n";


  }

*/



  /* Si existen camaras se utilizara el ip de la camara para obtener foto de los slots*/

 /* if(str_contains($existen_camaras, '1')){

  

                        $url = 
                      'http://192.168.1.19/picture';
                      //$endpoint_parqueo1_3;
                      $ch = curl_init($url);
                      $dir = './';
                      $file_name = basename('foto_area_parqueo.jpeg');
                      $save_file_loc = $dir . $file_name;
                      $fp = fopen($save_file_loc, 'wb');
                      curl_setopt($ch, CURLOPT_FILE, $fp);
                      curl_setopt($ch, CURLOPT_HEADER, 0);
                      curl_exec($ch);

                      fclose($fp);

                      $file = realpath('foto_area_parqueo.jpeg');  

                       $img=$file;


  }*/



  include('dbcon.php');

  while ($row = pg_fetch_row($result)) {

    $id_firebase_slot=$row[0];
    $estado_anterior=$row[1];
    $w_a=$row[2];
    $h_a=$row[3];
    $x_a=$row[4];
     $y_a=$row[5];

    $now = new Datetime('now');
$now = $now->format('Y-m-d H:i:s');



 $ref_tabla_codigo="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/codigo";
 $ref_tabla_estado="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/estado";
 $ref_tabla_id_slot="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/id_slot";
 $ref_tabla_reservas="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/reservas";

 $ref_tabla_img_slot="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/img_slot";




 




  $codigo = $database->getReference($ref_tabla_codigo)->getValue();
  $status = $database->getReference($ref_tabla_estado)->getValue();
  $id_slot = $database->getReference($ref_tabla_id_slot)->getValue();
  $reservas = $database->getReference($ref_tabla_reservas)->getValue();

  //Para editar
  //$postRef_result = $database->getReference($ref_tabla_img_slot)->set('New name');


  

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


        //SI EXISTEN CÁMARAS SE ACTUALIZARÁ LA IMAGEN YA QUE HUBO CAMBIO

        if(str_contains($existen_camaras, '1')){


          echo "ACTUALIZANDO IMAGEN\n";


                                    $url = 
                                   // 'http://192.168.1.19/picture';
                                    $endpoint_parqueo;
                                    $ch = curl_init($url);
                                    $dir = './';
                                    $file_name = basename('foto_area_parqueo.jpeg');
                                    $save_file_loc = $dir . $file_name;
                                    $fp = fopen($save_file_loc, 'wb');
                                    curl_setopt($ch, CURLOPT_FILE, $fp);
                                    curl_setopt($ch, CURLOPT_HEADER, 0);
                                    curl_exec($ch);

                                    fclose($fp);

                                    $file = realpath('foto_area_parqueo.jpeg');  

                                    $img=$file;


                                    $rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/'.$codigo.'';
                                    $response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
                                    $imagen_auto = json_decode($response_auto);
                                    $imagen_auto =$imagen_auto->secure_url;
                                    echo "\n";echo "slot:";echo $codigo;echo "\n";echo $imagen_auto;echo "\n";

                                    $queriesa= "UPDATE slots SET img_slot='$imagen_auto' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
                                    $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
                                    pg_free_result($resultadosa);      

                                     //Actualizar imagen en Realtime Database
                                    $postRef_result = $database->getReference($ref_tabla_img_slot)->set($imagen_auto);                        

                                     }
    
        
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





     
          echo "HUBO CAMBIO VACIO->OCUPADO\n";
          $queriesa= "UPDATE slots SET timestamp_cambio_ocupado='$now' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
          $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
          pg_free_result($resultadosa);

                          //SI EXISTEN CÁMARAS SE ACTUALIZARÁ LA IMAGEN YA QUE HUBO CAMBIO


                          if(str_contains($existen_camaras, '1')){

                            echo "ACTUALIZANDO IMAGEN\n";



                            $url = 
                            // 'http://192.168.1.19/picture';
                            $endpoint_parqueo;
                            $ch = curl_init($url);
                            $dir = './';
                            $file_name = basename('foto_area_parqueo.jpeg');
                            $save_file_loc = $dir . $file_name;
                            $fp = fopen($save_file_loc, 'wb');
                            curl_setopt($ch, CURLOPT_FILE, $fp);
                            curl_setopt($ch, CURLOPT_HEADER, 0);
                            curl_exec($ch);

                            fclose($fp);

                            $file = realpath('foto_area_parqueo.jpeg');  

                            $img=$file;


                            $rutafull='/parqueos/'.$id_park_slot.'/camara_parqueo/'.$codigo.'';
                            $response_auto=json_encode($uploader->upload($img,['folder' => $rutafull,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));
                            $imagen_auto = json_decode($response_auto);
                            $imagen_auto =$imagen_auto->secure_url;
                            echo "\n";echo "slot:";echo $codigo;echo "\n";echo $imagen_auto;echo "\n";

                            $queriesa= "UPDATE slots SET img_slot='$imagen_auto' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
                            $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
                            pg_free_result($resultadosa);

                            //Actualizar imagen en Realtime Database

                            $postRef_result = $database->getReference($ref_tabla_img_slot)->set($imagen_auto);

                      
                                      }

  


        }


        $queriesa= "UPDATE slots SET estado_anterior='N' WHERE id_slot='$id_slot' AND id_parqueo='$id_park_slot'";
        $resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());
        pg_free_result($resultadosa);
    
        
      }


  }

 





 // echo "id_slot:".$id_slot ."\n";




}
else{
  break;
}






  echo "\n";


sleep(10);


}

                   
}







          ?>
        
      