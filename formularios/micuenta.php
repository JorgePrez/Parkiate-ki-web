<?php

$id_usuario= $_COOKIE["id_usuario"];
 

  $nombre= $_GET['nombre'];

  $telefono= $_GET['telefono'];




  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$query= "UPDATE duenio SET nombre = '$nombre', telefono='$telefono' WHERE id_duenio = '$id_usuario'";

                     $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                     $tuplasaafectadas = pg_affected_rows($result);
                     pg_free_result($result);
            
$url="Location: ./../index.php";
header($url);



?>
