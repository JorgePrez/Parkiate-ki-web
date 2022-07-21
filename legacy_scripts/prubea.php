
 <?php

 
$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

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


   $control = $_GET['optionsRadios'];



   /*
  echo "1: $baños";
  echo "----";
  echo "2: $bajotecho";
  echo "----";
  echo "3: $asfalto";
  echo "----";
  echo "4: $seguridad";
  echo "----";
  echo "5: $furgoneta";
  echo "----";
  echo "6: $lavado";
  echo "----";
  echo "7: $iluminado";
  echo "----";
  echo "8: $puertos";
  echo "----";
  echo "9: $discapacitados";
  echo "----";
  echo "10: $obstaculos";
  echo "----";
  echo "11: $amplioespacio";
  echo "----";
  echo "12: $sotano";
  echo "----";
  echo "13: $vallet";*/

  //$detalles = preg_replace('/\s+/', ' ', $detalles);



  $linkimagen="Pendientex2"  ;

  $detalles=""; 

  $detalles = $detalles.$banios." ".$bajotecho." ".$asfalto." ".$seguridad." ".$furgoneta." ".$lavado." ".$ilumina." ".$puerta." ".$discapacitados." ".$obstaculos." ".$amplioespacio." ".$sotano." ".$vallet;
 





 $detalles = preg_replace('/\s+/', ' ', $detalles);


 $detalles= ltrim($detalles);

 $detalles=rtrim($detalles);

 //echo "$detalles";


// $detalles = preg_replace('/[\s$@_*]+/', ',', $detalles);


   //$url="Location: ./../RegistrarParqueo3.php";
   //header($url);




   
  $query= "UPDATE parqueo SET detalles='$detalles', imagenes='$linkimagen', control_pagos='$control'  WHERE id_parqueo = '$id_parqueo'";

  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);


?>
