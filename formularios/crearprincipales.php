<?php


include('dbcon.php');


 

 




 ///

 $key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id=$key; 
  $id_duenio=   $_COOKIE["id_usuario"];

  
  $nombre= $_GET['nombre_empresa'];
  $direccion= $_GET['direccion'];
  $capacidad_maxima = $_GET['capacidad_maxima'];




  $media_hora = $_GET['media_hora'];

  $hora = $_GET['hora'];

  $dia = $_GET['dia'];

  $mes = $_GET['mes'];


  
  $lunes_entrada='00:00:00';

  $lunes_salida='00:00:00';

  $domingo_entrada='00:00:00';

  $domingo_salida='00:00:00'; 

  $detalles='Pendiente';
  $imagenes='Pendiente';
  $latitude=0;
  $longitude=0;

  $martes_entrada='00:00:00';
  $martes_salida='00:00:00';
  $miercoles_entrada='00:00:00';
  $miercoles_salida='00:00:00';
  $jueves_entrada='00:00:00';
  $jueves_salida='00:00:00';
  $viernes_entrada='00:00:00';
  $viernes_salida='00:00:00';
  $sabado_entrada='00:00:00';
  $sabado_salida='00:00:00';
  $control_pagos='Pendiente';

 

  // base de datols


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

//actualizar en la base de datos de POstgre


  // base de datols
          
  $query = "Insert into parqueo values ('$id','$id_duenio','$nombre','$direccion','$capacidad_maxima','$media_hora','$hora','$dia','$mes','$lunes_entrada','$lunes_salida','$domingo_entrada','$domingo_salida','$detalles','$imagenes','$latitude','$longitude','$martes_entrada','$martes_salida','$miercoles_entrada','$miercoles_salida','$jueves_entrada','$jueves_salida','$viernes_entrada','$viernes_salida','$sabado_entrada','$sabado_salida','$control_pagos')";
  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);


  $query= "UPDATE duenio SET id_parqueo= '$id' WHERE id_duenio = '$id_duenio'";
  
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



 

 $url="Location: ./../Registrar_parqueo_index.php";
 header($url);






  

?>
