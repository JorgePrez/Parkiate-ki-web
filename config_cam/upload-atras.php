<?php
require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

// Config with Constructor

// Provide credentials in script
// $cloudinary = new Cloudinary(
//   [
//       'cloud' => [
//         'cloud_name' => 'CLOUD_NAME', 
//         'api_key' => 'API_KEY', 
//         'api_secret' => 'API_SECRET'
//       ],
//       'url' => [
//         'secure' => true //default
//       ]
//   ]
// );


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


// export credentials
//$cloudinary = new Cloudinary();
//$cloudinary->configuration->url->analytics(false);


//echo $cloudinary->configuration->cloud->cloudName . "\n";


# Reference the upload API
$uploader = $cloudinary->uploadApi();

# Upload

// Upload an image and supply a public id of 20 random characters
// image is the default

//

//$url =  'http://192.168.1.15/picture';


date_default_timezone_set('America/Guatemala');

$id_parqueo =$_GET['id_parqueo'];




$received = file_get_contents('http://192.168.1.15/picture');


$img = 'camaratrasera.jpeg';
file_put_contents($img, $received);



//$imagen->attachData($received, 'nombre.jpeg');



$response = json_encode($uploader->upload($img, ['folder' => 'autos/salida/']));


//print_r( $uploader->upload('./assets/cheesecake.jpg', ['folder' => 'autos/entrada/']));

//$response_array= array_values($response);

//echo $response;


//print_r($interest);

$imagen_subida = json_decode($response);
echo $imagen_subida->secure_url;
//https://stackhowto.com/how-to-save-an-image-from-a-url-in-php/


//INDEPENDIENTE(APLICACION MOVIL) - DEPENDETE(APLICACION MOVIL-ID SERVICIO )

//APLICACION WEB, TODAS SON DEPENDIENTES DE ESTA , esta debe incluir ambas 

// Guardar en base de datos

// 1 TABLA: numero de placa- hora de entrada - hora de salida, id servicio

// 2 TABLA: entrada -> numero placa , hora de deteccion ,link de la foto  //ultima foto tomada -> detectar la placa 
        //:salida -> numero placa , hora de deteccion  , link de la foto   //ultimo auto que se fue 

 //3 USUARIOS , TABLA DE AUTOS - PRARA LA APLICACION
    
      // FOTO , PLACA,  (CAMPO POR DEFINIR)  POSILIBIEDAD MARCA DETECTAR
  

 // PROPOSITO QUE TENGA LA POSIBILIDAD DE SER INDEPENDEITEN 


 $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
 if (!$conn){
     die("PostgreSQL connection failed");
    
 }

 //IMPORTANTE PARA OBTENER LA RESPUESTA 


// select * from users order by actualizado desc

//select imagen from users where actualizado = (select max(actualizado) from users)


 
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_placa_salida=$key;
  

$link_salida=$imagen_subida->secure_url; 

$now = new Datetime('now');



// Output the date with microseconds.
$now = $now->format('Y-m-d H:i:s.u');





//$query = "Insert into placas_entrada values ('$id','$id_duenio','$nombre','$direccion','$capacidad_maxima','$media_hora','$hora','$dia','$mes','$lunes_entrada','$lunes_salida','$domingo_entrada','$domingo_salida','$detalles','$imagenes','$latitude','$longitude','$martes_entrada','$martes_salida','$miercoles_entrada','$miercoles_salida','$jueves_entrada','$jueves_salida','$viernes_entrada','$viernes_salida','$sabado_entrada','$sabado_salida','$control_pagos')";

$query = "INSERT INTO placas_salida(id_placa_salida, hora_deteccion_salida, link_salida, deteccion_salida,id_parqueo) VALUES ('$id_placa_salida',  '$now','$link_salida', 'Por definir','$id_parqueo')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

//select link_entrada from placas_entrada where hora_deteccion_entrada = (select max(hora_deteccion_entrada) from placas_entrada)


