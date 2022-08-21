

<?php


   


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$query=" select count(*) from placas_entrada where id_parqueo='$id_parqueo' 
AND dentro_fuera='D'  AND deteccion_entrada='$placa_detectada'"; 


$resultadoplacaexiste = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$cantidad_autos_adentro_misma_placa=0;

while ($row = pg_fetch_row($resultadoplacaexiste)) {
        $cantidad_autos_adentro_misma_placa =$row[0];
      }
      

pg_free_result($resultadoplacaexiste);


$resultado_ultima_placa='';

if($cantidad_autos_adentro_misma_placa==0){ 
        $resultado_ultima_placa='S';

}else{
        $resultado_ultima_placa='N';

}

/*echo $resultado_ultima_placa;
echo "\n";
echo "cantidad de autos: ";
echo $cantidad_autos_adentro_misma_placa;
*/


?>



