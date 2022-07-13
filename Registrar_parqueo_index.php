


<?php




$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}




if(!isset($_COOKIE["id_usuario"])){
  header("Location: login.php");

}

else{    
  $id_usuario= $_COOKIE["id_usuario"];

}  


//Consulta para ver si el usuario tiene ID de parqueo


$query = "SELECT id_parqueo from DUENIO WHERE id_duenio= '$id_usuario'";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());


$id_parqueo_recibido="";


while ($row = pg_fetch_row($result)) {
  $id_parqueo_recibido= $row[0]; 
 }




if(strlen($id_parqueo_recibido) >1){

  setcookie("id_parqueo_registrando",$id_parqueo_recibido,time()+(60*60*24*31),"/");


    //retornar todos los cambios, y en base a los que esten definidos mandar a la pantalla correspondiente



    $query = "SELECT * from parqueo WHERE id_parqueo= '$id_parqueo_recibido'";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$idduenio='';
$nombreparqueo='';
$direccion= '';
$capacidad= '';
$tarifa1='';
$tarifa2='';
$tarifa3='';
$tarifa4='';
$lunes_entrada='';
$lunes_salida='';
$domingo_entrada='';
$domingo_salida=''; 
$detalles='';
$imagenes='';
$latitude='';
$longitude='';
$martes_entrada='';
$martes_salida='';
$miercoles_entrada='';
$miercoles_salida='';
$jueves_entrada='';
$jueves_salida='';
$viernes_entrada='';
$viernes_salida='';
$sabado_entrada='';
$sabado_salida='';
           


while ($row = pg_fetch_row($result)) {
        $idduenio=$row[1];
        $nombreparqueo=$row[2];
        $direccion= $row[3];
        $capacidad= $row[4];
        $tarifa1=$row[5];
        $tarifa2=$row[6];
        $tarifa3=$row[7];
        $tarifa4=$row[8];
        $lunes_entrada=$row[9];
        $lunes_salida=$row[10];
        $domingo_entrada=$row[11];
        $domingo_salida=$row[12]; 
        $detalles=$row[13];
        $imagenes=$row[14];
        $latitude=$row[15];
        $longitude=$row[16];
        $martes_entrada=$row[17];
        $martes_salida=$row[18];
        $miercoles_entrada=$row[19];
        $miercoles_salida=$row[20];
        $jueves_entrada=$row[21];
        $jueves_salida=$row[22];
        $viernes_entrada=$row[23];
        $viernes_salida=$row[24];
        $sabado_entrada=$row[25];
        $sabado_salida=$row[26];
        $control_pagos=$row[27];
        $id_firebase=$row[28];
        $reservas=$row[29];

}

if($martes_entrada!='00:00:00'){


  if(($martes_entrada!='00:00:00')&&($latitude!=0)){

    if(!($detalles=='Pendiente')){


      if(!($imagenes=='Pendiente')){

        header("Location: index.php");


      }else{
        header("Location: 5RegistrarImagen.php");

      }


    }
    else{
      header("Location: 4RegistrarCaracteristicas.php");


    }


  }
  else{
    header("Location: 3RegistrarUbicacion.php");

  }
  }



else {
  header("Location: 2RegistrarHorarios.php");

}

  //

}

else{
  header("Location: 1RegistrarPrincipales.php");


}




/*

if(!isset($_COOKIE["id_parqueo"])){}
  $id_parqueo='N';
  $id_pagina_side_no='1';



  if(){
    header("Location: 1RegistrarPrincipales.php");


  }
  else{
    //comprobar en que pantalla deberia estar

    

  }
  }
*/







?>

