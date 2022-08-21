

<?php


   


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


$query="  select deteccion_salida,hora_deteccion_salida 
from placas_salida 
where hora_deteccion_salida =(select max(hora_deteccion_salida) 
                              from placas_salida 
                              WHERE id_parqueo='$id_parqueo')
"; 


$resultadoplacasalida = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$deteccion_salida_ultima='';
$hora_ultima_salida='';

while ($row = pg_fetch_row($resultadoplacasalida)) {
        $deteccion_salida_ultima=$row[0];
        $hora_ultima_salida=$row[1];
      }
      

pg_free_result($resultadoplacasalida);


$datetime1 = new DateTime($hora_ultima_salida);//start time
$datetime2 = new DateTime($now);//end time
$interval = $datetime1->diff($datetime2);

$otravariable=$interval->i;

//$cantidad_minutos=3;// int($interval->i);

if($otravariable>=3){
  $rango_aceptable=false;

}
else{
  $rango_aceptable=true;
}



$resultado_ultima_salida='N';


if(($rango_aceptable==true)&&($placa_detectada==$deteccion_salida_ultima)){ 
        $resultado_ultima_salida='N';

        

}else{
        $resultado_ultima_salida='S';

}

/*echo $resultado_ultima_placa;
echo "\n";
echo "cantidad de autos: ";
echo $cantidad_autos_adentro_misma_placa;
*/


?>



