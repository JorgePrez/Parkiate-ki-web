<?php


include('dbcon.php');


 
 


  $id_parqueo = $_GET['id_parqueo'];



  $codigo = $_GET['codigo'];

  $reservas = 'N';

  

   
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id_slot=$key;

  $estado='f';

  

 

  // crear en base de datos


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

$img_slot='NA';
//actualizar en la base de datos de POstgre

$query = "Insert into slots values ('$id_slot','$codigo','$id_parqueo','$estado','$reservas','$id_firebase','$img_slot')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


//Obtener ID de firebase del parqueo



$query = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";
//                       $query = "select * from prospectos_template";


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_firebase='';





while ($row = pg_fetch_row($result)) {
    $id_firebase=$row[0];

 
}




//crear en fireBase 
 /*  ParkingStatus/-id_parqueo/-id_slot
 */ 


$postData = ['id_slot'=>$id_slot,
'codigo'=>$codigo,
'estado' => true,
'reservas'=> $reservas ,
'img_slot'=> $img_slot 

];

$ref_tabla="/Parking_Status/".$id_firebase."/";


// ESTA LINEA PERMITE EDITAR $postRef_result = $database->getReference('/parqueos/-N-imtkQJtXmGswIev8Q')->set($postData);

$id_firebase_slot = $database->getReference($ref_tabla)->push($postData)->getKey();




if($id_firebase_slot){

 


   
$query= "UPDATE slots SET id_firebase_slot='$id_firebase_slot' WHERE id_parqueo = '$id_parqueo' AND id_slot='$id_slot'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);




 echo "Correcto";
}
else{

 echo "Incorrecto";

}





$url="Location: ./../Slots.php";

header($url);




  

?>
