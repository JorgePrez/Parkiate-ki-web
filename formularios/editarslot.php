<?php


include('dbcon.php');


 
 


  $id_slot = $_GET['id_slot'];



  $codigo = $_GET['codigo'];

  $reservas = $_GET['reservas'];

  

  
  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

//actualizar en la base de datos de POstgre

$query= "UPDATE slots SET codigo ='$codigo',reservas ='$reservas' WHERE id_slot = '$id_slot'";  

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

//obtener todos los datos del slot



$query = "select * from slots where id_slot='$id_slot'";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$id_slot='';
$codigoE='';
$id_parqueo = '';
$estado= '';
$reservasE='';
$id_firebase_slot='';


while ($row = pg_fetch_row($result)) {
 $id_slot=$row[0];
 $codigoE=$row[1];
 $id_parqueo=$row[2];
 $estado= $row[3];
 $reservasE= $row[4];
 $id_firebase_slot=$row[5];


}

pg_free_result($result);

print_r($id_firebase_slot);

print_r("----");




//OBTENER id de parqueo


$query = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_firebase='';





while ($row = pg_fetch_row($result)) {
    $id_firebase=$row[0];

 
}




//actualizar en realtime database

print_r($id_firebase);

print_r("----");




$ref_tabla="/Parking_Status/".$id_firebase;

$ref_tabla =$ref_tabla."/".$id_firebase_slot."/";

print_r($ref_tabla);




if((str_contains($estado, 'f'))){
$estado_boolean = false;

}else{

  $estado_boolean = true;


}




$postData = ['id_slot'=>$id_slot,
'codigo'=>$codigoE,
'estado' => $estado_boolean,
'reservas'=> $reservasE  
];



// editar en ParkingStatus/-id_parqueo/-id_slot/






///////////MUY IMPORTANTE
 $postRef_result = $database->getReference($ref_tabla)->set($postData);



$url="Location: ./../Slots.php?id_parqueo=".$id_parqueo;

header($url);






  

?>
