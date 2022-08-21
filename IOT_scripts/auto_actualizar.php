

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$query = "select id_auto from placas_entrada_salida where id_parqueo='$id_parqueo' AND id_deteccion_entrada='$id_placa_entrada_recibida'";

 
 $resultplaca = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_auto='';
 $tuplasaafectadas_placa1 = pg_affected_rows($resultplaca);
 

 while ($row = pg_fetch_row($resultplaca)) {

  $id_auto=$row[0];


 }



 pg_free_result($resultplaca);


 if( (strcmp($id_auto, 'NA')) ==0 ){  }

 else{
  $placa_auto_escribir=$deteccion_entrada1;


  
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


$query= "UPDATE auto SET placa='$placa_auto_escribir',numero_visitas='$numerovisitas',foto_atras='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);








 }



















 


 















?>



