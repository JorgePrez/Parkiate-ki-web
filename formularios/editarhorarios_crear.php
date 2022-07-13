<?php


include('dbcon.php');




  $id_parqueo = $_GET['id_parqueo'];



  $lunes_apertura=$_GET['lunes_apertura'];;

  $lunes_cierre=$_GET['lunes_cierre'];;

  $domingo_apertura=$_GET['domingo_apertura'];;

  $domingo_cierre=$_GET['domingo_cierre'];; 


  $martes_apertura=$_GET['martes_apertura'];;
  $martes_cierre=$_GET['martes_cierre'];;
  $miercoles_apertura=$_GET['miercoles_apertura'];;
  $miercoles_cierre=$_GET['miercoles_cierre'];;
  $jueves_apertura=$_GET['jueves_apertura'];;
  $jueves_cierre=$_GET['jueves_cierre'];;
  $viernes_apertura=$_GET['viernes_apertura'];;
  $viernes_cierre=$_GET['viernes_cierre'];;
  $sabado_apertura=$_GET['sabado_apertura'];;
  $sabado_cierre=$_GET['sabado_cierre'];;
 

  // base de datols


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

//actualizar en la base de datos de POstgre

$query= "UPDATE parqueo SET lunes_apertura='$lunes_apertura', lunes_cierre='$lunes_cierre',martes_apertura ='$martes_apertura',martes_cierre ='$martes_cierre',miercoles_apertura ='$miercoles_apertura',miercoles_cierre ='$miercoles_cierre',jueves_apertura ='$jueves_apertura',jueves_cierre ='$jueves_cierre',viernes_apertura ='$viernes_apertura',viernes_cierre ='$viernes_cierre',sabado_apertura ='$sabado_apertura',sabado_cierre ='$sabado_cierre',domingo_apertura ='$domingo_apertura',domingo_cierre ='$domingo_cierre' WHERE id_parqueo = '$id_parqueo'";  

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



print_r($tuplasaafectadas);


 $url="Location: ./../Registrar_parqueo_index.php";
 header($url);






  

?>
