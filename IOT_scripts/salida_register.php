

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 15;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 

  $id_placa_salida=$key;
  $correccion_deteccion='NA';



$query = "INSERT INTO placas_salida VALUES ('$id_placa_salida',  '$now','$imagen_auto', '$placa_detectada','$id_parqueo','$imagen_full','$imagen_placa')";
$result3 = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result3);
pg_free_result($result3);








?>



