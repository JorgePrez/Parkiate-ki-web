<?php


 
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id=$key; 
  $id_duenio=   $_COOKIE["id_usuario"];
 
 
  $nombre= $_GET['nombre_empresa'];
  $direccion= $_GET['direccion'];
  $capacidad_maxima = $_GET['capacidad_maxima'];


  $media_hora = $_GET['media_hora'];

  $hora = $_GET['hora'];

  $dia = $_GET['dia'];

  $mes = $_GET['mes'];

  $semana_apertura= $_GET['semana_apertura'];

  $semana_cierre= $_GET['semana_cierre'];

  $fin_apertura= $_GET['fin_apertura'];

  $fin_cierre= $_GET['fin_cierre'];

  // base de datols


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query = "Insert into parqueo values ('$id','$id_duenio','$nombre','$direccion','$capacidad_maxima','$media_hora','$hora','$dia','$mes','$semana_apertura','$semana_cierre','$fin_apertura','$fin_cierre','EXID','EXID')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


  

?>
