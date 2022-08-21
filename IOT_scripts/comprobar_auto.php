

<?php







   


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query=" select count(*) FROM auto WHERE placa='$placa_detectada' AND id_parqueo='$id_parqueo'";



$resultadoautoexiste = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$cantidad_autos=0;

while ($row = pg_fetch_row($resultadoautoexiste)) {
        $cantidad_autos =$row[0];
      }
      

pg_free_result($resultadoautoexiste);


$condicion_auto='';

if($cantidad_autos==0){ 
        $condicion_auto='N';

}else{
        $condicion_auto='S';

}





?>



