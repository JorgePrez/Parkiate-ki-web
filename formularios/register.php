<?php




 
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id=$key;
  
  
 

  $contrasenia= $_POST['password']; 
  $correo=  $_POST['email'];

//  $correo= 'uncorreo.gmail.com';

  $contrasenia_hash=md5($contrasenia);


//  $correo1= urldecode($correo);

  $id_parqueo ="N";



//var_dump( explode( '@', $correo1 ) );





  // base de datols


  $conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


$query = "Insert into duenio values ('$id','$correo','$contrasenia_hash','$id_parqueo')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

//echo '$tuplasaafectadas'


setcookie("id_usuario",$id,time()+(60*60*24*31),"/");


$url="Location: ./../index.php";

header($url);





  //Redirecccionr  a index,html  (probablemente que envir el usurio (cookie)  )   



  //header("Location: ./../index.html");


 // $url="Location: ./../index.php";

//header($url);


  

?>
