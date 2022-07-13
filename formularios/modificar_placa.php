
<?php

  $id_placa_corr = $_GET['id_placa_corr'];

  //=P678TYC&id_placa_corr=CH87H0

$placa_corr1=$_GET['placa_corr'];


$searchString = " ";
$replaceString = "";
 
$placa_corr= str_replace($searchString, $replaceString, $placa_corr1); 

$id_parqueo=$_COOKIE["id_parqueo"];          //'2CE369'; // TODO: DEBE SER UNA :  $_COOKIE["id_parqueo"];

$id_placa_entrada=$id_placa_corr;


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
  die("PostgreSQL connection failed");
 }

echo "llego aqui";




$query = "select * from placas_entrada_salida where id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
   //                       $query = "select * from prospectos_template";


   $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
   $id_deteccion_entrada='';
   $id_deteccion_salida='';
   $id_auto='';
   $id_parqueo='';
   $id_servicio_app='';
   $tiempo_total='';
   $deteccion_entrada_salida='';
   $existe_error='';


   while ($row = pg_fetch_row($result)) {
   // $id_deteccion_entrada=$row[0];

    $id_deteccion_entrada=$row[1];
    $id_deteccion_salida=$row[2];
    $id_auto=$row[3];
    $id_parqueo=$row[4];
    $id_servicio_app=$row[5];
    $tiempo_total=$row[6];
    $deteccion_entrada_salida=$row[7];
    $existe_error=$row[8];
   }


   pg_free_result($result);



   //SOLO HACER TODO ESTO SI ES DIFERENTE A LA QUE YA ESTA ANTES

   if (!($placa_corr == $deteccion_entrada_salida)) {

    


   //-1. corregir en la tabla placas_entrada (con el id_deteccion_entrada)


   $query= "UPDATE placas_entrada SET deteccion_entrada='$placa_corr' WHERE id_placa_entrada='$id_deteccion_entrada' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


//-2 corregir en la tabla placas_salida 

$query= "UPDATE placas_salida SET deteccion_salida='$placa_corr' WHERE id_placa_salida='$id_deteccion_salida' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


//Actualizar en la tabla actual , la deteccion y poner que no existe error
$query= "UPDATE placas_entrada_salida SET deteccion_entrada_salida='$placa_corr',existe_error='N' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


//Obtener los datos del auto con misma placa, 


$query = "select id_auto,numero_visitas from auto where id_parqueo='$id_parqueo' AND placa='$placa_corr'";

 
 $resultauto = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

 $id_auto_existente='';
$numero_visitas=0;
 $tuplasaafectadas_auto = pg_affected_rows($resultauto);
 

 while ($row = pg_fetch_row($resultauto)) {

  $id_auto_existente=$row[0];
  $numero_visitas=$row[1];

 }

 pg_free_result($resultauto);



if($tuplasaafectadas_auto ==0){

  //Sino existe solo corregimos el actual


  $query= "UPDATE auto SET placa='$placa_corr' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



}

else{


  //si existe le sumamos 1 visita al existente, y eliminamos, el auto que tenia el id_anterior

  $numero_visitas = $numero_visitas+1;


  $query= "UPDATE auto SET numero_visitas='$numero_visitas' WHERE id_auto='$id_auto_existente' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$query = "DELETE FROM auto WHERE id_parqueo='$id_parqueo' AND id_auto='$id_auto'";
if($resultadoeliminar = pg_query($query)){
  echo "Data Deleted Successfully.";
}
else{
  echo "Error.";
}

pg_free_result($resultadoeliminar);



}



}

else{

  echo "existente no se hace nada";
}


$url="Location: ./../flujo_autos.php";
header($url);







//5051,240
//ACTUALIZAR DETECCION ENTRADA_














?>
