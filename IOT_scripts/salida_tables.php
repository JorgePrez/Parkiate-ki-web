

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


$query = "select id_placa_entrada,hora_deteccion_entrada,deteccion_entrada 
from placas_entrada where id_parqueo='$id_parqueo' AND dentro_fuera='D' AND (deteccion_entrada = '$placa_detectada')";


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


 
$datetime1 = new DateTime($hora_deteccion_entrada);//start time
$datetime2 = new DateTime($now);//end time
$interval = $datetime1->diff($datetime2);
$tiempo_total=$interval->format('%d-%H-%i-%s');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds

//actualizar en la tabla entrada_salida





$query= "UPDATE placas_entrada_salida SET id_deteccion_salida='$id_placa_salida', tiempo_total='$tiempo_total' WHERE id_deteccion_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$query= "UPDATE placas_entrada SET dentro_fuera='F' WHERE id_placa_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$query = "SELECT id_entrada_salida FROM placas_entrada_salida WHERE id_deteccion_entrada='$id_placa_entrada_recibida' AND id_parqueo='$id_parqueo'";
 
$resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_placa_entrada_salida_app='';
 

while ($row = pg_fetch_row($resultplaca)) {
 $id_placa_entrada_salida_app=$row[0];
}

pg_free_result($resultplaca);















?>



