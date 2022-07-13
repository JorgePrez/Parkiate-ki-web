
<?php
date_default_timezone_set('America/Guatemala');


$id_placa_corr = $_GET['id_placa_corr'];
$id_placa_salida=$id_placa_corr;

$placa_corr= $_GET['placa_corr'];
$id_parqueo=  $_COOKIE["id_parqueo"];          //'2CE369'; // TODO: DEBE SER UNA :  $_COOKIE["id_parqueo"];




$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
die("PostgreSQL connection failed");
}



/*
Obtener valor actual de placa
1.Si es la misma, no hacer nada
2. Si es diferente cambiar error_de_entrada a N y escribir en deteccion_entrada_correcion

*/ 


$query = "select deteccion_salida,foto_auto_salida from placas_salida where id_placa_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
 //                       $query = "select * from prospectos_template";


 $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$deteccion_original='';
$imagen_auto='';

 while ($row = pg_fetch_row($result)) {
     $deteccion_original=$row[0];
     $imagen_auto=$row[1];
 }

 if($deteccion_original == $placa_corr){
  $query= "UPDATE placas_salida SET error_salida='N',deteccion_salida_correcion='NA' WHERE id_placa_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";

  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);
 }
 else{
//actualizar en la base de datos de POstgre

$query= "UPDATE placas_salida SET error_salida='N',deteccion_salida_correcion='$placa_corr' WHERE id_placa_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);
 }

 //HACER TODO LO QUE SE HACE EN LA CAMARA DE SALIDA

 $query = "select id_placa_entrada,hora_deteccion_entrada,deteccion_entrada,error_entrada,deteccion_entrada_correcion from placas_entrada where hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='$id_parqueo' AND dentro_fuera='D' AND (deteccion_entrada = '$placa_corr' OR deteccion_entrada_correcion='$placa_corr'))";

//swhere hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='2CE369' AND dentro_fuera='D' AND (deteccion_entrada = 'P629BRS' OR deteccion_entrada_correcion='P629BRS') )


 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_placa_entrada_recibida='';
 $hora_deteccion_entrada='';
 $deteccion_entrada1='';
 $error_entrada='';
 $deteccion_entrada_correcion='';

 
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_placa_entrada_recibida=$row[0];
     $hora_deteccion_entrada=$row[1];
     $deteccion_entrada1=$row[2];
 $error_entrada=$row[3];
 $deteccion_entrada_correcion=$row[4];

 }

 pg_free_result($resultplaca);


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

if($deteccion_entrada_correcion!='NA'){
 $placa_auto_escribir=$deteccion_entrada_correcion;


}
else {
$placa_auto_escribir=$deteccion_entrada1;


}

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
 

 echo "correcto";

$url="Location: ./../salida.php";
header($url);







?>
