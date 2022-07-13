
<?php



 
$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



$correo=$_POST['correo'];

$contrasenia_recibida=$_POST['password'];


$correo1= urldecode($correo);

$contrasenia_hash=md5($contrasenia_recibida);



$query = "SELECT * from DUENIO WHERE email= '$correo1'";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);


echo "numero: $tuplasaafectadas lo  ";
echo "\n";

$id_usuario="";
$correoo="";
$contrasenia="";
$id_parqueo="";


if($tuplasaafectadas>0){


while ($row = pg_fetch_row($result)) {
 $id_usuario= $row[0]; 
$correoo=$row[1];
$contrasenia=$row[2];
$id_parqueo=$row[3];  
}


if (str_contains($contrasenia, $contrasenia_hash)) {
echo "Contraseñia coincide";


setcookie("id_usuario",$id_usuario,time()+(60*60*24*31),"/");






if(strlen($id_parqueo) >1){
  $query2 = "SELECT id_firebase from parqueo WHERE id_parqueo= '$id_parqueo'";
$result2 = pg_query($conn, $query2) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());

$id_firebase="";

while ($row = pg_fetch_row($result2)) {
  $id_firebase= $row[0]; 
 }


if(!(is_null($id_firebase))){
  setcookie("id_parqueo",$id_parqueo,time()+(60*60*24*31),"/");

}



}
else{

}

//session_start();  session_destroy()

$url="Location: ./../index.php";

header($url);

}
else {

  
  $url="Location: ./../login.php?resultado=2";
  

   header($url);



}


}

else{


  $url="Location: ./../login.php?resultado=1";

   header($url);


}


//

//echo '$tuplasaafectadas'

/*
setcookie("id_usuario",$id,time()+(60*60*24*31),"/");






  //Redirecccionr  a index,html  (probablemente que envir el usurio (cookie)  )   



  //header("Location: ./../index.html");


  $url="Location: ./../index.html";

header($url);
*/

  

?>
