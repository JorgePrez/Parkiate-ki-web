<?php






  $id_parqueo = $_GET['id_parqueo'];



  $latitude=$_GET['latitude'];;

  $longitude=$_GET['longitude'];;



  // base de datols


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

//actualizar en la base de datos de POstgre

$query= "UPDATE parqueo SET latitude =$latitude,longitude =$longitude WHERE id_parqueo = '$id_parqueo'";  

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);





 

 $url="Location: ./../Registrar_parqueo_index.php";
 header($url);






  

?>
