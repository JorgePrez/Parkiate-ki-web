

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


  $id_auto=$key;

  $query = "INSERT INTO auto(
     id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app,fecha_registro_auto)
    VALUES ('$id_auto', '$placa_detectada', 0, '$imagen_auto', 'Pendiente', '$id_parqueo', 'Por definir', '$now');";

    //TODO: afecta que en lugar de por definir sea NA
   
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);






?>



