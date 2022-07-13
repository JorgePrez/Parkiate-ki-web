
<?php

  $id_placa_corr = $_GET['id_placa_corr'];

  //=P678TYC&id_placa_corr=CH87H0

$placa_corr=$_GET['placa_corr'];

$id_parqueo=$_COOKIE["id_parqueo"];          //'2CE369'; // TODO: DEBE SER UNA :  $_COOKIE["id_parqueo"];

$id_placa_entrada=$id_placa_corr;


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
  die("PostgreSQL connection failed");
 }



/*
Obtener valor actual de placa
1.Si es la misma, no hacer nada
2. Si es diferente cambiar error_de_entrada a N y escribir en deteccion_entrada_correcion

*/ 


$query="select * from placas_entrada where id_parqueo='$id_parqueo' AND dentro_fuera='D'  AND (deteccion_entrada='$placa_corr' OR deteccion_entrada_correcion='$placa_corr')";


$resultadoplacaexiste = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$autos_dentro_misma_placa = pg_affected_rows($resultadoplacaexiste);

pg_free_result($resultadoplacaexiste);


//Si existe se borra el actual
if(!($autos_dentro_misma_placa==0)){

  //eliminar adentro

  $query = "DELETE FROM placas_entrada WHERE id_parqueo='$id_parqueo' AND id_placa_entrada='$id_placa_corr'";
	if($resultadoeliminar = pg_query($query)){
		echo "Data Deleted Successfully.";
	}
	else{
		echo "Error.";
	}

  pg_free_result($resultadoeliminar);

  echo "warning: este camara_entrada se eliminara";

  //$url="Location: ./../entrada.php";
//header($url);



}
else{ 

//sino existe un AUTO DENTRO que corresponde con la correcion se hace normal



$query = "select deteccion_entrada,foto_auto_entrada from placas_entrada where id_placa_entrada='$id_placa_corr' AND id_parqueo='$id_parqueo'";
   //                       $query = "select * from prospectos_template";


   $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $deteccion_original='';
 $imagen_auto='';


   while ($row = pg_fetch_row($result)) {
       $deteccion_original=$row[0];

       if($deteccion_original == $placa_corr){
        $query= "UPDATE placas_entrada SET error_entrada='N',deteccion_entrada_correcion='NA' WHERE id_placa_entrada='$id_placa_corr' AND id_parqueo='$id_parqueo'";
    
        $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $tuplasaafectadas = pg_affected_rows($result);
        pg_free_result($result);
       }
       else{
    //actualizar en la base de datos de POstgre
    
    $query= "UPDATE placas_entrada SET error_entrada='N',deteccion_entrada_correcion='$placa_corr' WHERE id_placa_entrada='$id_placa_corr' AND id_parqueo='$id_parqueo'";
    
    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    $tuplasaafectadas = pg_affected_rows($result);
    pg_free_result($result);
       }
   }

 


   $placa_detectada=$deteccion_original;
   //HACER DE NUEVO TODO LO DE LA ENTRADA

   $query = "Select  * FROM auto WHERE placa='$placa_detectada' AND id_parqueo='$id_parqueo'";
$resultadoauto = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas4 = pg_affected_rows($resultadoauto);


$id_auto='';


 

if($tuplasaafectadas4>0){
  while ($row = pg_fetch_row($resultadoauto)) {
    $id_auto=$row[0];
}
  
pg_free_result($resultadoauto);

echo "id existrente";
echo $id_auto;

//UPDATEIMAGEN

$query= "UPDATE auto SET foto_delante='$imagen_auto' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


}else{


  pg_free_result($resultadoauto);

$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_auto=$key;

  $query = "INSERT INTO auto(
    id_auto, placa, numero_visitas, modelo_auto, foto_delante, foto_atras, id_parqueo, id_usuario_app)
    VALUES ('$id_auto', '$placa_detectada', 0, 'Por Definir', '$imagen_auto', 'Pendiente', '$id_parqueo', 'Por definir');";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

echo "Registrando nuevo auto";
  }



$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_entrada_salida=$key;

$query="INSERT INTO placas_entrada_salida(
	id_entrada_salida, id_deteccion_entrada, id_deteccion_salida, id_auto, id_parqueo, id_servicio_app,tiempo_total)
	VALUES ('$id_entrada_salida', '$id_placa_entrada', 'NA', '$id_auto', '$id_parqueo', 'NA','NA');";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

echo "camara_entrada registrando";


//$url="Location: ./../entrada.php";
//header($url);
   
}









?>
