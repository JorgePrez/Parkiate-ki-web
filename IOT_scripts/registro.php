

<?php


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 8;$i++){ //6
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_entrada_salida=$key;


  $query="INSERT INTO placas_entrada_salida(
	id_entrada_salida, id_deteccion_entrada, id_deteccion_salida, id_auto, id_parqueo, id_usuario_app,tiempo_total,deteccion_entrada_salida,existe_error)
	VALUES ('$id_entrada_salida', '$id_placa_entrada', 'NA', 'NA', '$id_parqueo', 'NA','NA','$placa_detectada','$placa_necesita_correccion');";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


?>



