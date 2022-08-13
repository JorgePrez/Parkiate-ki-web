

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


include 'camaras_endpoints.php';




//2CE369: PARQUEO CLUB LA AURORA

//ESTA VARIABLE CAMBIA CONFORME EL PARQUEO QUE SE ESTE MONITOREANDO
//$id_parqueo ='2CE369'; //$_GET['id_parqueo']; //'2CE369'



$id_parqueo_r ='86BE48';



$id_parqueo=$id_parqueo_r;
 

    
$url = $endpoint_image_salida;



/*
  $url = 
//'https://res.cloudinary.com/parkiate-ki/image/upload/v1655505257/autos/entrada/vehiculo/jne4f3z9apldjvtrvt2y.jpg';
'http://192.168.1.3/picture';*/

// Initialize the cURL session
$ch = curl_init($url);

// Initialize directory name where
// file will be save
$dir = './';

// Use basename() function to return
// the base name of file
$file_name = basename('placa_salida_photo.jpeg');

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





//$img = 'placa_salida_p.jpeg';   
//file_put_contents($img, $received);


// CREATE FILE READY TO UPLOAD WITH CURL
$file = realpath('placa_salida_photo.jpeg');  
if (function_exists('curl_file_create')) { // php 5.5+
  $cFile = curl_file_create($file);
} else {
  $cFile = '@' . realpath($file);
}

//ADD PARAMETER IN REQUEST LIKE regions
$data = array(
    'upload' => $cFile,
    'regions' => 'gp', //gt
    'camera_id' => 'camara_salida_photo', // Optional , camara_salida  //
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



$placa_necesita_correccion='S';



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



//configurar algunas cosas....


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






$query="select deteccion_salida from placas_salida where hora_deteccion_salida =(select max(hora_deteccion_salida) from placas_salida WHERE id_parqueo='$id_parqueo')";

$resultadoplacaexiste1 = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$ultimaplaca='';


     while ($row = pg_fetch_row($resultadoplacaexiste1)) {
                    $ultimaplaca=$row[0];
                       
              }

pg_free_result($resultadoplacaexiste1);


$img= $file;

$rutafull='/parqueos/'.$id_parqueo.'/camara_salida/full';
$rutaplaca='/parqueos/'.$id_parqueo.'/camara_salida/placa';
$rutavehiculo='/parqueos/'.$id_parqueo.'/camara_salida/vehiculo';





if(!($placa_detectada==$ultimaplaca)){


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


  $id_placa_salida=$key;
  



$correccion_deteccion='NA';

$query = "INSERT INTO placas_salida VALUES ('$id_placa_salida',  '$now','$imagen_auto', '$placa_detectada','$id_parqueo','$imagen_full','$imagen_placa')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

echo "correcto";

////

/*

    nombre_empresa ILIKE $1 OR direccion ILIKE $1
    `;

    return db.manyOrNone(sql, akeyword);
*/ 

//$query = "select id_placa_entrada,hora_deteccion_entrada,deteccion_entrada,error_entrada,deteccion_entrada_correcion from placas_entrada where hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='$id_parqueo' AND dentro_fuera='D' AND (deteccion_entrada = '$placa_detectada' OR deteccion_entrada_correcion='$placa_detectada'))";

$query = "select id_placa_entrada,hora_deteccion_entrada,deteccion_entrada from placas_entrada where id_parqueo='$id_parqueo' AND dentro_fuera='D' AND (deteccion_entrada = '$placa_detectada')";


//swhere hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='2CE369' AND dentro_fuera='D' AND (deteccion_entrada = 'P629BRS' OR deteccion_entrada_correcion='P629BRS') )


 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_placa_entrada_recibida='';
 $hora_deteccion_entrada='';
 $deteccion_entrada1='';


 
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_placa_entrada_recibida=$row[0];
     $hora_deteccion_entrada=$row[1];
     $deteccion_entrada1=$row[2];


 }

 pg_free_result($resultplaca);

 //sino coincide hacer algo crazy, que creise

 

//modificar en tabla , auto_salida_entrada
if($tuplasaafectadas_placa1>0)

{

echo $id_placa_entrada_recibida;


$datetime1 = new DateTime($hora_deteccion_entrada);//start time
$datetime2 = new DateTime($now);//end time
$interval = $datetime1->diff($datetime2);
$tiempo_total=$interval->format('%d-%H-%i-%s');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds

//actualizar en la tabla entrada_salida





$query= "UPDATE placas_entrada_salida SET id_deteccion_salida='$id_placa_salida', tiempo_total='$tiempo_total' WHERE id_deteccion_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

//actualizar en la tabla auto
$placa_auto_escribir='';


 // TODO: obtener id de placas_entrada_Salida

 $query = "SELECT id_entrada_salida FROM placas_entrada_salida WHERE id_deteccion_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";
 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_placa_entrada_salida_app='';
  

 while ($row = pg_fetch_row($resultplaca)) {
  $id_placa_entrada_salida_app=$row[0];
 }

 pg_free_result($resultplaca);


 ////////////////////////////////////////////

/*if($deteccion_entrada_correcion!='NA'){
 $placa_auto_escribir=$deteccion_entrada_correcion;


}
else {*/
$placa_auto_escribir=$deteccion_entrada1;


//}

//obtener el id_auto,

$query = "select id_auto from placas_entrada_salida where id_parqueo='$id_parqueo' AND id_deteccion_entrada='$id_placa_entrada_recibida'";

 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_auto='';
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_auto=$row[0];


 }

 pg_free_result($resultplaca);




//y con el id del auto ver cual es el campo de visitas y aumentarlo en 1

$query = "select numero_visitas from auto where id_parqueo='$id_parqueo' AND id_auto='$id_auto'";

 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $numerovisitas=0;
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $numerovisitas=$row[0];


 }
 $numerovisitas=$numerovisitas+1;

 pg_free_result($resultplaca);



      //Condicion de ver que placa se actualiza

$query= "UPDATE auto SET placa='$placa_auto_escribir',numero_visitas='$numerovisitas',foto_atras='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$query= "UPDATE placas_entrada SET dentro_fuera='F' WHERE id_placa_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



//TODO: /////////////////////////

$query = "SELECT id_usuario_app from placas_entrada_salida WHERE  id_entrada_salida='$id_placa_entrada_salida_app' and id_parqueo='$id_parqueo'";
 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_usuario_app_actual='';
  

 while ($row = pg_fetch_row($resultplaca)) {
  $id_usuario_app_actual=$row[0];
 }

 pg_free_result($resultplaca);



 if( (strcmp($id_usuario_app_actual, 'NA')) ==0 ){  }

 else{
  $query= "UPDATE usuarios_app set id_visita_actual='N' WHERE id=$id_usuario_app_actual";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



 }

 //////////////////




echo "\n";
echo "Success: camara_salida registrando";
echo "\n";

$success=true;





 
}
else {  //////
  echo 'Warning: Ninguna placa coincide exactamente, buscando la placa más parecida';


  //RECORRER TODAS LAS PLACAS DE ADENTRO Y HACER COINCIDIR CON LA QUE MAS SE PAREZCA,




  
  $query12 = "select deteccion_entrada from placas_entrada where id_parqueo='$id_parqueo' AND dentro_fuera='D'";
$result123 = pg_query($conn, $query12) or die('ERROR : ' . pg_last_error());
$porcentajemayor=0.0;
  //$placa_detectada //esta variable sera editada con el mayor

$placaprovisional="";


     while ($row = pg_fetch_row($result123)) {
                    $deteccion_entrada_coincidencia=$row[0];

                    similar_text($deteccion_entrada_coincidencia,$placa_detectada,$percent1);




                    if($percent1>$porcentajemayor){
                      $porcentajemayor=$percent1;
                      $placaprovisional =$deteccion_entrada_coincidencia;

                    }

             
                       
              }

  $placa_detectada=$placaprovisional;
  echo "\n";
  echo "nueva placa";
  echo $placa_detectada;
  echo "\n";


  pg_free_result($result123);
  

//YA TENIENDO LA NUMERO REPETIR TODO LO ANTERIOR


$query = "select id_placa_entrada,hora_deteccion_entrada,deteccion_entrada from placas_entrada where hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='$id_parqueo' AND dentro_fuera='D' AND (deteccion_entrada = '$placa_detectada'))";

//swhere hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='2CE369' AND dentro_fuera='D' AND (deteccion_entrada = 'P629BRS' OR deteccion_entrada_correcion='P629BRS') )


 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_placa_entrada_recibida='';
 $hora_deteccion_entrada='';
 $deteccion_entrada1='';


 
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_placa_entrada_recibida=$row[0];
     $hora_deteccion_entrada=$row[1];
     $deteccion_entrada1=$row[2];


 }

 pg_free_result($resultplaca);

 //sino coincide hacer algo crazy, que creise

 


echo $id_placa_entrada_recibida;


$datetime1 = new DateTime($hora_deteccion_entrada);//start time
$datetime2 = new DateTime($now);//end time
$interval = $datetime1->diff($datetime2);
$tiempo_total=$interval->format('%d-%H-%i-%s');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds

//actualizar en la tabla entrada_salida

$query= "UPDATE placas_entrada_salida SET id_deteccion_salida='$id_placa_salida', tiempo_total='$tiempo_total' WHERE id_deteccion_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);




//TODO: SI EN USUARIO APP, EXISTE UN Id de placas_entrada_salida, actualizarlo a 'N'


$query = "SELECT id_usuario_app from placas_entrada_salida WHERE  id_entrada_salida='$id_placa_entrada_recibida' and id_parqueo='$id_parqueo'";
 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_usuario_app_actual='';
  

 while ($row = pg_fetch_row($resultplaca)) {
  $id_usuario_app_actual=$row[0];
 }

 pg_free_result($resultplaca);



 if( (strcmp($id_usuario_app_actual, 'NA')) ==0 ){  }

 else{
  $query= "UPDATE usuarios_app set id_visita_actual='N' WHERE id=$id_usuario_app_actual";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



 }

















/////////////////////////////////////////////////////////



//actualizar en la tabla auto
$placa_auto_escribir='';

/*if($deteccion_entrada_correcion!='NA'){
 $placa_auto_escribir=$deteccion_entrada_correcion;


}
else {*/
$placa_auto_escribir=$deteccion_entrada1;


//}

//obtener el id_auto,

$query = "select id_auto from placas_entrada_salida where id_parqueo='$id_parqueo' AND id_deteccion_entrada='$id_placa_entrada_recibida'";

 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_auto='';
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_auto=$row[0];


 }

 pg_free_result($resultplaca);




//y con el id del auto ver cual es el campo de visitas y aumentarlo en 1

$query = "select numero_visitas from auto where id_parqueo='$id_parqueo' AND id_auto='$id_auto'";

 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $numerovisitas=0;
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $numerovisitas=$row[0];


 }
 $numerovisitas=$numerovisitas+1;

 pg_free_result($resultplaca);



      //Condicion de ver que placa se actualiza



$query= "UPDATE auto SET placa='$placa_auto_escribir',numero_visitas='$numerovisitas',foto_atras='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$query= "UPDATE placas_entrada SET dentro_fuera='F' WHERE id_placa_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

//ACTUALIZAR SALIDA


$query= "UPDATE placas_salida SET deteccion_salida='$placa_detectada' WHERE id_placa_salida='$id_placa_salida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);
 

//SI NINGUNA PLACA COINCIDE (EN OTRAS PALABRAS PARQUEO VACIO POR EJEMPLO)

if(!(strlen($placaprovisional)>0)){

  echo 'Warning: No hay placa que coincida';

  //Borrar la que ya existe....
  $query = "DELETE FROM placas_salida WHERE id_parqueo='$id_parqueo' AND id_placa_salida='$id_placa_salida'";
  if($resultadoeliminar = pg_query($query)){
    echo "Data Deleted Successfully.";
  }
  else{
    echo "Error.";
  }
  
  pg_free_result($resultadoeliminar);

  $success=false;
  

}
else{
  
  echo "\n";
  echo "Success: camara_salida registrando";
  $success=true;




}




}


}
else{
  echo "\n";

  echo 'Warning: Foto repetida';
  $success=false;


}



//Comprobar si existe un auto con la placa detectada, sino crear uno
}
else{
  echo "\n";

  echo "Warning: en la foto no hay ninguna placa";
  $success=false;


}



?>



