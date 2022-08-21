

<?php


   


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query=" select count(*) from placas_entrada where id_parqueo='$id_parqueo' 
AND dentro_fuera='D'"; 


$resultadoautosdentro = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$cantidad_autos_adentro=0;

while ($row = pg_fetch_row($resultadoautosdentro)) {
        $cantidad_autos_adentro=$row[0];
      }
      

pg_free_result($resultadoautosdentro);


$resultado_autosdentro='';

if($cantidad_autos_adentro>0){ 
        $resultado_autosdentro='S';

}else{
        $resultado_autosdentro='N';

}



?>



