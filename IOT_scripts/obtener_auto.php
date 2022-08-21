

<?php



$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query=" select id_auto FROM auto WHERE placa='$placa_detectada' AND id_parqueo='$id_parqueo'";



$resultadoautoid = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$id_auto='';

while ($row = pg_fetch_row($resultadoautoid)) {
        $id_auto =$row[0];
      }
      

pg_free_result($resultadoautoid);



$query= "UPDATE auto SET foto_delante='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$resultadoupdatecar = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
pg_free_result($resultadoupdatecar);




?>



