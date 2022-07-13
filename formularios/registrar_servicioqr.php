<?php


include('dbcon.php');


date_default_timezone_set('America/Guatemala');

 
  
$preid_servicio=$_GET['id_servicio'];

//print_r($preid_servicio);



$variable =explode(":",$preid_servicio);

//$id_servicio = $variable[1];

//print_r($variable[1]);


if($variable[0]=='new'){

  $id_servicio= $variable[1]; 


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
  if (!$conn){
      die("PostgreSQL connection failed");
     
  }

$valor='N/A';
            
$query = "Insert into servicios_admin ( id_servicio ,id_parqueo,direccion,nombre_parqueo,imagenes, id_usuario,nombre_usuario,telefono,modelo_auto,placa_auto,fecha,hora_deentrada,hora_desalida,precio,parqueo_control_pagos) values ('$id_servicio','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor','$valor') RETURNING id";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



  $url = "Location: ./../escanearQR2start.php";

  header($url);






}else if($variable[0]=='final'){

  $id_servicio= $variable[1]; 


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
  if (!$conn){
      die("PostgreSQL connection failed");
     
  }
  
  
    
  $query = "select * from servicios_admin where Id_servicio='$id_servicio'";   
  
  
  
  
  $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
  $id_servicio='';
  $id_parqueo='';
  $direccion = '';
  $nombre_parqueo= '';
  $imagenes='';
  $id_usuario = '';
  $nombre_usuario = ''; 
  $telefono='';
  $modelo_auto='';
  $placa_auto='';
  $fecha='';
  $hora_deentrada='';
  $hora_desalida='';
  $precio='';
  $parqueo_control_pagos='';
  //$media_hora='';
  //$hora='';
  
             
  
  while ($row = pg_fetch_row($result)) {
   $id_servicio=$row[1];
   $id_parqueo=$row[2];
   $direccion = $row[3];
   $nombre_parqueo= $row[4];
   $imagenes=$row[5];
   $id_usuario = $row[6];
   $nombre_usuario = $row[7]; 
   $telefono=$row[8];
   $modelo_auto=$row[9];
   $placa_auto=$row[10];
   $fecha=$row[11];
   $hora_deentrada=$row[12];
   $hora_desalida=$row[13];
   $precio=$row[14];
   $parqueo_control_pagos=$row[15];
  }
  
  
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);
  //print($tuplasaafectadas);
  
  
  
  //////////OBTENER precio de hora y de media hora
  
  
  $query2 = "select media_hora,hora from parqueo where id_parqueo ='$id_parqueo'";  
  $result2 = pg_query($conn, $query2) or die('ERROR : ' . pg_last_error());
  $media_hora='';
  $hora='';
  
  
  while ($row2 = pg_fetch_row($result2)) {
    $media_hora=$row2[0];
    $hora=$row2[1];
  
   }
   
   
   $tuplasaafectadas = pg_affected_rows($result2);
   pg_free_result($result2);
  
            
  
  
  
    $hora2 = date("H:i");
  
  
  
  
  $precioporhora =  $hora  ;
  $preciopormediahora= $media_hora;
  
  $start_date = new DateTime($hora_deentrada);
  
  
  $since_start = $start_date->diff(new DateTime($hora2));
  $totalhoras=  $since_start->h;
   $totalminutos=  $since_start->i;
  
   echo $totalhoras;
  
   echo '----';
   echo $totalminutos;
  
   //Obteniendo cantidad cobrada
  
  
    $preciototal = 0;
  
   if ($totalhoras > 0) {
     $preciototal = $precioporhora * $totalhoras;
  
     if ($totalminutos < 30) {
       $preciototal = $preciototal + $preciopormediahora;
     } else {
       $preciototal = $preciototal + $precioporhora;
     }
   } else {
     if ($totalminutos < 30) {
       $preciototal = $preciopormediahora;
     } else {
       $preciototal = $precioporhora;
     }
   }
   echo '----';
  
   echo $preciototal;
  
  
   //UPDATE EN LA BASE DE DATOS
  
  
   $query= "UPDATE servicios_admin SET hora_desalida='$hora2', precio='$preciototal' WHERE id_servicio = '$id_servicio'";
  
   $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
   $tuplasaafectadas = pg_affected_rows($result);
   pg_free_result($result);
  
  
  
  
  
  
  
   $url = "Location: ./../MisServicios.php?"."id_parqueo=".$id_parqueo;
  
  
  header($url);






}
else{

  $url = "Location: ./../escanearQRfailed.php";


  header($url);


}




 /*
 
 

*/

  

?>
