

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

$id_parqueo =$id_parqueo_actual;


  $objeto = '1';

    if((str_contains($objeto, '1')))
    {
    echo "HAY OBJETO PROCESANNDO.......................:";echo "\n";
    $success=true;

    //OBTENER IMAGEN DE CÁMARA
    $url = $endpoint_image_salida; $ch = curl_init($url);
    $dir = './';$file_name = basename('placa_salida_p.jpeg');
    $save_file_loc = $dir . $file_name;
    $fp = fopen($save_file_loc, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);curl_setopt($ch, CURLOPT_HEADER, 0);curl_exec($ch);fclose($fp);

    //ENVIAR IMAGEN A API Y OBTENER RESPUESTA
    $file = realpath('placa_salida_p.jpeg');  
    if (function_exists('curl_file_create')) { $cFile = curl_file_create($file);} // php 5.5+
    else {$cFile = '@' . realpath($file);}
    $data = array(
    'upload' => $cFile,
    'regions' => 'gp', //gt
    'camera_id' => 'camara_salida', // Optional , camara_salida  
     );

    $ch = curl_init('https://api.platerecognizer.com/v1/plate-reader/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);curl_setopt($ch, CURLINFO_HEADER_OUT, true);curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2TLS);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Token 222f6c6970669f844c36f2b342a45cae3d88f73c"  //API KEY
    ));

    $now = new Datetime('now');$now = $now->format('Y-m-d H:i:s');
    $result = curl_exec($ch);$response = json_decode($result);
    print_r($response);

    //PROCESANO RESPUESTA DE API

    //¿RESPUESTA ES VÁLIDA?
    if(($response->results[0]===null)){
            echo "\n";echo "warning: en la foto no hay ninguna placa";$success=false;
    }

    else{
      
        $xmin_placa =$response->results[0]->box->xmin;  $ymin_placa =$response->results[0]->box->ymin;
        $xmax_placa =$response->results[0]->box->xmax;  $ymax_placa=$response->results[0]->box->ymax;
        $x=$xmin_placa; $y= $ymin_placa;  $w= $xmax_placa-$xmin_placa;  $h= $ymax_placa-$ymin_placa;

        $placa_detectada=$response->results[0]->plate;
        $placa_detectada = strtoupper($placa_detectada);

        include('IOT_scripts/placa_procesando.php');

        $xmin_auto =$response->results[0]->vehicle->box->xmin;  $ymin_auto =$response->results[0]->vehicle->box->ymin;
        $xmax_auto =$response->results[0]->vehicle->box->xmax;  $ymax_auto=$response->results[0]->vehicle->box->ymax;
        $x_a=$xmin_auto;  $y_a= $ymin_auto; $w_a= $xmax_auto-$xmin_auto; $h_a= $ymax_auto-$ymin_auto;
        
    //    echo "\n";  echo $placa_detectada;  echo "-->"; echo $placa_necesita_correccion;


        $img= $file;          $rutafull='/parqueos/'.$id_parqueo.'/camara_salida/full';
        $rutaplaca='/parqueos/'.$id_parqueo.'/camara_salida/placa'; $rutavehiculo='/parqueos/'.$id_parqueo.'/camara_salida/vehiculo';

        $response_full=json_encode($uploader->upload($img,['folder' => $rutafull]));
        $response_placa=json_encode($uploader->upload($img,['folder' => $rutaplaca,'width' => $w, 'height' => $h, 'crop' => 'crop' , 'x' => $x, 'y' => $y]));

        if($xmin_auto > 0 && $ymin_auto > 0 && $xmax_auto > 0 && $ymax_auto > 0){
            $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo,'width' => $w_a, 'height' => $h_a, 'crop' => 'crop' , 'x' => $x_a, 'y' => $y_a]));}
        else{
             $response_auto=json_encode($uploader->upload($img,['folder' => $rutavehiculo]));}

        $imagen_full = json_decode($response_full);   $imagen_full=$imagen_full->secure_url;
        $imagen_placa = json_decode($response_placa); $imagen_placa=$imagen_placa->secure_url;
        $imagen_auto = json_decode($response_auto);   $imagen_auto =$imagen_auto->secure_url;


        include('IOT_scripts/autosdentro.php');


        if($resultado_autosdentro=='N'){
          echo "\n";echo "warning: Nada que registrar";$success=false;
        }

        else{

          include('IOT_scripts/ultima_placa_salida.php');



          if( $resultado_ultima_salida=='N'){
            echo "\n";echo "warning: Imagen repetida";$success=false;
          }
  
          else{


            include('IOT_scripts/placas_autos_dentro.php');


            
                  if( $resultado_placa_dentro=='N'){
                    echo "\n";echo "warning: No hay placa dentro que coincida";$success=false;
                  }

                  else{  
                      include('IOT_scripts/salida_register.php');
                      include('IOT_scripts/salida_tables.php');
                      include('IOT_scripts/finalizar_usuario_app.php');
                      include('IOT_scripts/auto_actualizar.php');
                        echo "\n";echo "Success: camara_salida registrando";$success=true;
                        echo "\n";  echo $placa_detectada;  echo "-->"; echo $placa_necesita_correccion; 
                  }

          }

     
            }

    }

  

    }



  


?>

