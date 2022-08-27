

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



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


 















?>



