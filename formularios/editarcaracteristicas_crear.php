<?php


include('dbcon.php');


 
 


  $id_parqueo = $_GET['id_parqueo'];

  
 
  $banios=" ";
  $banios = $_GET['banios'];

  $bajotecho=" ";
  $bajotecho = $_GET['bajotecho'];



  $asfalto=" ";

  $asfalto = $_GET['asfalto']; 


  $seguridad=" "; 
  $seguridad = $_GET['seguridad'];
  
  $furgoneta=" ";
   $furgoneta = $_GET['furgoneta'];


  $lavado=" "; 
   $lavado = $_GET['lavado'];

   $ilumina=" ";
   $ilumina = $_GET['ilumina'];

   $puerta=" ";
   $puerta = $_GET['puerta'];


   $discapacitados=" ";
   $discapacitados = $_GET['discapacitados'];

   $obstaculos=" ";
   $obstaculos = $_GET['obstaculos'];


   $amplioespacio=" ";
   $amplioespacio = $_GET['amplioespacio'];

   $sotano=" ";
   $sotano = $_GET['sotano'];

   $vallet=" ";

   $vallet = $_GET['vallet'];


   $control = 'S';





  $detalles=""; 

  $detalles = $detalles.$banios." ".$bajotecho." ".$asfalto." ".$seguridad." ".$furgoneta." ".$lavado." ".$ilumina." ".$puerta." ".$discapacitados." ".$obstaculos." ".$amplioespacio." ".$sotano." ".$vallet;
 

 $detalles = preg_replace('/\s+/', ' ', $detalles);


 $detalles= ltrim($detalles);

 $detalles=rtrim($detalles);

 print_r($detalles);

 print_r($control);


 $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
 if (!$conn){
     die("PostgreSQL connection failed");
    
 }




  $query= "UPDATE parqueo SET detalles='$detalles', control_pagos='$control'   WHERE id_parqueo = '$id_parqueo'";

  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  print_r($tuplasaafectadas);
  pg_free_result($result);



 

 

  $url="Location: ./../Registrar_parqueo_index.php";
   header($url);




  

?>
