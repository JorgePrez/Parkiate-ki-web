
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


if(!isset($_COOKIE["id_parqueo"])){

   //$id_pagina_side_no='1';
   header("Location: Registrar_parqueo_index.php");


}

else{

  $id_parqueo= $_COOKIE["id_parqueo"];


}


//consulta: select * from slots where id_parqueo ='2CE369' PARA VER SI TIENE SLOTS ASOCIADOS SINO

//mostrar otro




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Parkiate-ki (Administrador)</title>

  <!-- Favicons -->
  <link href="img/favicon1.png" rel="icon">

  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" href="lib/xchart/xcharts.css">


  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="css/to-do.css">


  <script src="lib/chart-master/Chart.js"></script>


  
  <style>

<?php


$id_parqueo=$_COOKIE["id_parqueo"];
//ID_FIREBASE


$query ="select id_placa_entrada,foto_auto_entrada,deteccion_entrada,hora_deteccion_entrada
from placas_entrada where id_parqueo='$id_parqueo' and hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada where id_parqueo='$id_parqueo')";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());




$id_placa_entrada='';
$foto_auto_entrada1='';
$deteccion_entrada='';
$hora_deteccion_entrada='';





while ($row = pg_fetch_row($result)) { 
     $id_placa_entrada=$row[0];
     $foto_auto_entrada1=$row[1];
     $deteccion_entrada=$row[2];
     $hora_deteccion_entrada=$row[3];

 
}

$foto_auto_entrada12=$foto_auto_entrada1;


$tuplasaafectadas_placa1 = pg_affected_rows($result);

/*
echo "\n";
echo "hora deteccion entrada:";
echo $hora_deteccion_entrada;
echo "------";
echo $foto_auto_entrada1;
echo "\n";*/

pg_free_result($result);



$query = "select id_placa_salida,foto_auto_salida,deteccion_salida,hora_deteccion_salida from placas_salida where id_parqueo='$id_parqueo' and hora_deteccion_salida = (select max(hora_deteccion_salida) from placas_salida where id_parqueo='$id_parqueo')";


//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_placa_salida='';
$foto_auto_salida1='';
$deteccion_salida='';
$hora_deteccion_salida='';





while ($row = pg_fetch_row($result)) { 
     $id_placa_salida=$row[0];
     $foto_auto_salida1=$row[1];
     $deteccion_salida=$row[2];
     $hora_deteccion_salida=$row[3];

 
}

echo "\n";
echo "hora deteccion salida:";
echo $hora_deteccion_salida;
echo "\n";


$tuplasaafectadas_placa2 = pg_affected_rows($result);


pg_free_result($result);



?>
#spotify1 {
  background: url(<?php echo $foto_auto_salida2?>) no-repeat center top;

  
  /*background:url('https://res.cloudinary.com/parkiate-ki/image/upload/v1653897978/detalles/10-109983_security-camera-icon-png-cctv-icon-transparent-png_mxdo9a.png') no-repeat center top;
  */
  margin-top: -15px;
	background-attachment: relative;
	background-position: center center;
	min-height: 220px;
	width: 100%;
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
#spotify1 .btn-clear-g {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}

#spotify1 .btn-theme04  {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}
#spotify1 .sp-title {
	bottom: 60%;   /*  	bottom: 15%;   left: 25px; */
	left: 75px;
	position: absolute;
	color: #efefef;
}
#spotify1 .sp-title h4 {
	font-weight: 900;
}
#spotify1 .sp-title h3 {
    font-weight: 900;
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    padding:5px;font-size:20px;background-color:black;color:#ffffff;
}

#spotify1 .sp-title h5 {
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    background-color:black;color:#ffffff;
}

#spotify1 .play{
	bottom: 18%;
	right: 25px;
	position: absolute;
	color: #efefef;
	font-size: 20px
}
.followers {
	margin-left: 5px;
	margin-top: 5px;
}


#spotify2 {
	/*background: url(../placa_salida.jpeg) no-repeat center top;*/
    background:url(<?php echo $foto_auto_salida1?>) no-repeat center top;
	margin-top: -15px;
	background-attachment: relative;
	background-position: center center;
	min-height: 220px;
	width: 100%;
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
#spotify2 .btn-clear-g {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}

#spotify2 .btn-theme04  {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}
#spotify2 .sp-title {
	bottom: 60%;
	left: 75px;
	position: absolute;
	color: #efefef;
}
#spotify2 .sp-title h4 {
	font-weight: 900;
}

#spotify2 .sp-title h3 {
    font-weight: 900;
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    padding:5px;font-size:20px;background-color:black;color:#ffffff;
}

#spotify2 .sp-title h5 {
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    background-color:black;color:#ffffff;
}

#spotify2 .play{
	bottom: 18%;
	right: 25px;
	position: absolute;
	color: #efefef;
	font-size: 20px
}
.followers {
	margin-left: 5px;
	margin-top: 5px;
}




#spotify21 {
	/*background: url(../placa_salida.jpeg) no-repeat center top;*/
    background:url(<?php echo $foto_auto_entrada1?>) no-repeat center top;
	margin-top: -15px;
	background-attachment: relative;
	background-position: center center;
	min-height: 220px;
	width: 100%;
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
#spotify21 .btn-clear-g {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}

#spotify21 .btn-theme04  {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}
#spotify21 .sp-title {
	bottom: 60%;
	left: 75px;
	position: absolute;
	color: #efefef;
}
#spotify21 .sp-title h4 {
	font-weight: 900;
}

#spotify21 .sp-title h3 {
    font-weight: 900;
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    padding:5px;font-size:20px;background-color:black;color:#ffffff;
}

#spotify21 .sp-title h5 {
    display: table; /* keep the background color wrapped tight */
    margin: 0px auto 0px auto; /* keep the table centered */
    background-color:black;color:#ffffff;
}

#spotify21 .play{
	bottom: 18%;
	right: 25px;
	position: absolute;
	color: #efefef;
	font-size: 20px
}
.followers {
	margin-left: 5px;
	margin-top: 5px;
}



#spotify3 {
	/*background: url(../placa_salida.jpeg) no-repeat center top;*/
    background:url('https://res.cloudinary.com/parkiate-ki/image/upload/v1653897978/detalles/10-109983_security-camera-icon-png-cctv-icon-transparent-png_mxdo9a.png') no-repeat center top;
	margin-top: -15px;
	background-attachment: relative;
	background-position: center center;
	min-height: 220px;
	width: 100%;
    -webkit-background-size: 100%;
    -moz-background-size: 100%;
    -o-background-size: 100%;
    background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
#spotify3 .btn-clear-g {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}

#spotify3 .btn-theme04  {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}

#spotify3 .btn-theme03  {
	top: 15%;
	right: 10px;
	position: absolute;
	margin-top: 5px;
}
#spotify3 .sp-title {
	bottom: 15%;
	left: 25px;
	position: absolute;
	color: #efefef;
}
#spotify3 .sp-title h3 {
	font-weight: 900; /* 900*/
}
#spotify3 .play{
	bottom: 18%;
	right: 25px;
	position: absolute;
	color: #efefef;
	font-size: 20px
}
.followers {
	margin-left: 5px;
	margin-top: 5px;
}

</style>


</head>


<?php
$id_parqueo=$_COOKIE["id_parqueo"];
//ID_FIREBASE
$query = "select id_firebase from parqueo where id_parqueo='$id_parqueo'";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_firebase='';


while ($row = pg_fetch_row($result)) { 
     $id_firebase=$row[0];
 
}

pg_free_result($result);
date_default_timezone_set('America/Guatemala');

//////////////////////////////////


$query = "select id_slot,id_firebase_slot from slots where id_parqueo='$id_parqueo'";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$tuplasaafectadas = pg_affected_rows($result);

$estadogeneral='';
$contador_ocupados=0;



if($tuplasaafectadas>0){
  include('formularios/dbcon.php');


  $estadogeneral='1';

    
    
  while ($row = pg_fetch_row($result)) {
    $id_slot=$row[0];
    $id_firebase_slot=$row[1];




/* CONSULTAA FIREBASE PARA VER EL ESTADO DEL PARQUEO

RUTA DE ESTE MANERA: https://parkiate-ki-default-rtdb.firebaseio.com/Parking_Status/-Mq73KmXyn-fx7tlnIQn/-N-t_vx07IoxzsBpIURf/estado.json
*/


$ref_tabla="/Parking_Status/".$id_firebase."/".$id_firebase_slot."/estado";


$status = $database->getReference($ref_tabla)->getValue();


$estado_boolean=true;

if(str_contains($status, '1'))
{
$queriesa= "UPDATE slots SET estado=true WHERE id_slot='$id_slot'";


$resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());

}


else {

$queriesa= "UPDATE slots SET estado=false WHERE id_slot='$id_slot'";


$resultadosa = pg_query($conn, $queriesa) or die('ERROR : ' . pg_last_error());

$contador_ocupados = $contador_ocupados+1;

}



  //FALSO ES OCUPADO
  




}

$proporcion = $contador_ocupados. "/" .$tuplasaafectadas ;
  // echo $nombrecompleto;
  
  $porcentaje_number= ($contador_ocupados*100)/$tuplasaafectadas;
  
  //echo $porcentaje_number;
  
  $complemento_porcentaje= 100-$porcentaje_number;
  
  //echo $complemento_porcentaje;
  $noDecimalNumber = intval($porcentaje_number);
  $porcentaje= strval($noDecimalNumber);
}
else{
$estadogeneral='0';
}

$now = new Datetime('now');
//$now = $now->format('d-m-Y');


$anio = $now->format('Y');
$mes = $now->format('m');
$dia = $now->format('d');

$mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
          "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha=$dia." de ". $mesesN[2] ." de $anio";






?>


<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b><span>PARK</span>IATE<span>-KI</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
         

    
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
      
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <?php


include 'logout.php';

?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->


        <?php
              
              $query = "select nombre_empresa from parqueo where id_parqueo='$id_parqueo'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }


              $domingo2='';
              $sabado2='';
              $viernes2='';
              $jueves2='';
              $miercoles2='';
              $martes2='';
              $lunes2='';
       

              $domingo2_c=0;
              $sabado2_c=0;
              $viernes2_c=0;
              $jueves2_c=0;
              $miercoles2_c=0;
              $martes2_c=0;
              $lunes2_c=0;
     

              $domingo=false;

              $sabado=true;
              $viernes=false;
              $jueves=false;
              $miercoles=false;
              $martes=false;
              $lunes=false;

              if($domingo==true){
                $domingo2=date('y-m-d');
                $domingo2_c=40;
                $sabado2=Date('y-m-d', strtotime('-1 days'));  
                $sabado2_c=20;
                
                $viernes2=Date('y-m-d', strtotime('-2 days'));    
                $viernes2_c=20;

                $jueves2=Date('y-m-d', strtotime('-3 days'));
                $jueves2_c=20;

                $miercoles2=Date('y-m-d', strtotime('-4 days'));
                $miercoles2_c=20;


                $martes2=Date('y-m-d', strtotime('-5 days'));
                $martes2_c=20;

                $lunes2=Date('y-m-d', strtotime('-6 days'));
                $lunes2_c=20;
              }

              else if( $sabado==true){
                $domingo2=Date('y-m-d', strtotime('+1 days'));                ;
                $sabado2=date('y-m-d');;
                $viernes2=Date('y-m-d', strtotime('-1 days'));    ;
                $jueves2=Date('y-m-d', strtotime('-2 days'));;
                $miercoles2=Date('y-m-d', strtotime('-3 days'));;
                $martes2=Date('y-m-d', strtotime('-4 days'));;
                $lunes2=Date('y-m-d', strtotime('-5 days'));;
           

                $domingo2_c=0;
                $sabado2_c=40;
                
                $viernes2_c=20;

                $jueves2_c=20;

                $miercoles2_c=20;


                $martes2_c=20;

                $lunes2_c=20;


              }

              else if( $viernes==true){
                $domingo2=Date('y-m-d', strtotime('+2 days'));                ;
                $sabado2=Date('y-m-d', strtotime('+1 days'));  ;
                $viernes2=date('y-m-d');;    ;
                $jueves2=Date('y-m-d', strtotime('-1 days'));;
                $miercoles2=Date('y-m-d', strtotime('-2 days'));;
                $martes2=Date('y-m-d', strtotime('-3 days'));;
                $lunes2=Date('y-m-d', strtotime('-4 days'));;


                $domingo2_c=0;
                $sabado2_c=00;
                
                $viernes2_c=40;

                $jueves2_c=20;

                $miercoles2_c=20;


                $martes2_c=20;

                $lunes2_c=20;
            

           


              }

              else if( $jueves==true){
                $domingo2=Date('y-m-d', strtotime('+3 days'));                ;
                $sabado2=Date('y-m-d', strtotime('+2 days'));  ;
                $viernes2=Date('y-m-d', strtotime('+1 days'));  ;   ;
                $jueves2=date('y-m-d');;    ;
                $miercoles2=Date('y-m-d', strtotime('-1 days'));;
                $martes2=Date('y-m-d', strtotime('-2 days'));;
                $lunes2=Date('y-m-d', strtotime('-3 days'));;


                $domingo2_c=0;
                $sabado2_c=00;
                
                $viernes2_c=0;

                $jueves2_c=40;

                $miercoles2_c=20;


                $martes2_c=20;

                $lunes2_c=20;
     


              }

              else if( $miercoles==true){
                $domingo2=Date('y-m-d', strtotime('+4 days'));                ;
                $sabado2=Date('y-m-d', strtotime('+3 days'));  ;
                $viernes2=Date('y-m-d', strtotime('+2 days'));  ;   ;
                $jueves2= Date('y-m-d', strtotime('+1 days')); ;
                $miercoles2=date('y-m-d');  
                $martes2=Date('y-m-d', strtotime('-1 days'));;
                $lunes2=Date('y-m-d', strtotime('-2 days'));;

               
                $domingo2_c=0;
                $sabado2_c=00;
                
                $viernes2_c=0;

                $jueves2_c=0;

                $miercoles2_c=40;


                $martes2_c=20;

                $lunes2_c=20; 
    


              }

              else if( $martes==true){
                $domingo2=Date('y-m-d', strtotime('+5 days'));                ;
                $sabado2=Date('y-m-d', strtotime('+4 days'));  ;
                $viernes2=Date('y-m-d', strtotime('+3 days'));  ;   ;
                $jueves2= Date('y-m-d', strtotime('+2 days'));
                $miercoles2=Date('y-m-d', strtotime('+1 days')); 
                $martes2=date('y-m-d'); 
                $lunes2=Date('y-m-d', strtotime('-1 days'));

                $domingo2_c=0;
                $sabado2_c=0;
                
                $viernes2_c=0;

                $jueves2_c=0;

                $miercoles2_c=0;


                $martes2_c=40;

                $lunes2_c=20; 
    
          

           


              } 
              else{

                $domingo2=Date('y-m-d', strtotime('+6 days'));                ;
                $sabado2=Date('y-m-d', strtotime('+5 days'));  ;
                $viernes2=Date('y-m-d', strtotime('+4 days'));  ;   ;
                $jueves2= Date('y-m-d', strtotime('+3 days'));
                $miercoles2=Date('y-m-d', strtotime('+2 days')); 
                $martes2=Date('y-m-d', strtotime('+1 days'));  
                $lunes2=date('y-m-d');
   
                $domingo2_c=0;
                $sabado2_c=0;
                
                $viernes2_c=0;

                $jueves2_c=0;

                $miercoles2_c=0;


                $martes2_c=0;

                $lunes2_c=40; 
           

              }



//Porcentaje para cada valor

$porcentaje_lunes=0;


if (($lunes2_c > 0) && ($lunes2_c <= 20)) {

                $porcentaje_lunes=20;
        
               }
        
        
             else  if (($lunes2_c >= 21) && ($lunes2_c <= 40)) {
                $porcentaje_lunes=40;
                 
              }   
              
              else if (($lunes2_c >= 41) && ($num <= 60)) {
                $porcentaje_lunes=60;
                 
              }  
              else  if (($lunes2_c >= 61) && ($num <= 80)) {
                $porcentaje_lunes=80;
                 
              }   else{
                $porcentaje_lunes=100;
              }


              $porcentaje_martes=0;


if (($martes2_c > 0) && ($martes2_c <= 20)) {

                $porcentaje_martes=20;
        
               }
        
        
             else  if (($martes2_c >= 21) && ($martes2_c <= 40)) {
                $porcentaje_martes=40;
                 
              }   
              
              else if (($martes2_c >= 41) && ($num <= 60)) {
                $porcentaje_martes=60;
                 
              }  
              else  if (($martes2_c >= 61) && ($num <= 80)) {
                $porcentaje_martes=80;
                 
              }   else{
                $porcentaje_martes=100;
              }


              $porcentaje_miercoles=0;


if (($miercoles2_c > 0) && ($miercoles2_c <= 20)) {

                $porcentaje_miercoles=20;
        
               }
        
        
             else  if (($miercoles2_c >= 21) && ($miercoles2_c <= 40)) {
                $porcentaje_miercoles=40;
                 
              }   
              
              else if (($miercoles2_c >= 41) && ($num <= 60)) {
                $porcentaje_miercoles=60;
                 
              }  
              else  if (($miercoles2_c >= 61) && ($num <= 80)) {
                $porcentaje_miercoles=80;
                 
              }   else{
                $porcentaje_miercoles=100;
              }


              $porcentaje_jueves=0;


if (($jueves2_c > 0) && ($jueves2_c <= 20)) {

                $porcentaje_jueves=20;
        
               }
        
        
             else  if (($jueves2_c >= 21) && ($jueves2_c <= 40)) {
                $porcentaje_jueves=40;
                 
              }   
              
              else if (($jueves2_c >= 41) && ($num <= 60)) {
                $porcentaje_jueves=60;
                 
              }  
              else  if (($jueves2_c >= 61) && ($num <= 80)) {
                $porcentaje_jueves=80;
                 
              }   else{
                $porcentaje_jueves=100;
              }


              $porcentaje_viernes=0;


if (($viernes2_c > 0) && ($viernes2_c <= 20)) {

                $porcentaje_viernes=20;
        
               }
        
        
             else  if (($viernes2_c >= 21) && ($viernes2_c <= 40)) {
                $porcentaje_viernes=40;
                 
              }   
              
              else if (($viernes2_c >= 41) && ($num <= 60)) {
                $porcentaje_viernes=60;
                 
              }  
              else  if (($viernes2_c >= 61) && ($num <= 80)) {
                $porcentaje_viernes=80;
                 
              }   else{
                $porcentaje_viernes=100;
              }
         


              

            
              //Obtener timestamps para grafico

              /*
              1.Obtener fecha de hoy
              2.Ver que dia es hoy (de la semana), determinar fecha de inicio y fin

               Si es domingo, hoy - ultimos 14 dias
               Si es sabado, hoy + ultimos 12 dias
               Si es viernes , hoy + ultimos 11 dias
               Si es jueves, hoy + ultimos 10 dias
               Si es miercoles, hoy + ultimos 9 dias
               Si es martes, hoy + ultimos 8 dias
               Si es lunes, hoy + ultimos 7 dias

              */


              
              ?>
              
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><img src="img/park_icon2.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">
        
          
    <?php
     
      echo $nombrecompleto;
 
          ?>
        
        </h5> 
        
     

<li class="mt">
<a class="active" href="index.php">
  <i class="fa fa-dashboard"></i>
  <span>Dashboard</span>
  </a>
</li>

<li class="mt">
<a href="micuenta.php">
  <i class="fa fa-desktop"></i>
  <span>Mi cuenta</span>
  </a>

</li>

<li class="mt">
<a href="Detalles_Parqueo.php">
  <i class="fa fa-edit"></i>
  <span>Editar datos de parqueo</span>
  </a>
</li>

<li class="mt">
<a href="Slots.php">
  <i class="fa fa-th-large"></i>
  <span>Slots(libres/ocupados)</span>
  </a>
</li>


<li class="mt">
            <a href="javascript:;">
              <i class="fa fa-camera"></i>
              <span>Flujo de autos(placas)</span>
              </a>
            <ul class="sub">
            <li><a href="entrada.php">Registro de Autos Entrada</a></li>
              <li><a href="salida.php">Registro de Autos Salida</a></li>
              <li><a href="flujo_autos.php">Entrada y Salida por Placa</a></li>
              <li><a href="autos.php">Registro por auto</a></li>
            </ul>
          </li>

<li class="mt">
<a href="RegistrarParqueo1.php">
  <i class="fa fa-external-link"></i>
  <span>Registro de Servicios(App)</span>
  </a>

</li>

<li class="mt">
<a href="RegistrarParqueo1.php">
  <i class="fa fa-book"></i>
  <span>Reservas</span>
  </a>

</li>



    


        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->

      

            <div class="border-head">
              <h3>   <i class="fa fa-bar-chart-o">  VISITAS DE LA SEMANA ACTUAL A TU PARQUEO</i> </h3>
            </div>
            <div class="custom-bar-chart">
              <ul class="y-axis">
                <li><span>+100</span></li>
                <li><span>80</span></li>
                <li><span>60</span></li>
                <li><span>40</span></li>
                <li><span>20</span></li>
                <li><span>0</span></li>
              </ul>
              <div class="bar">
                <div class="title">LUNES</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $lunes2_c; ?>" data-toggle="tooltip" data-placement="top">
                
                <?php  
                
                if($lunes2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $porcentaje_lunes;
                  echo "%";

                }
                ?>
                </div>
              </div>
              <div class="bar ">
                <div class="title">MARTES</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $martes2_c; ?>" data-toggle="tooltip" data-placement="top">
                
                <?php  
                
                if($martes2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $martes_porcentaje;
                  echo "%";

                }
                ?>
                </div>
              </div>
              <div class="bar ">
                <div class="title">MIERCOLES</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $miercoles2_c; ?>" data-toggle="tooltip" data-placement="top">   
                <?php  
                
                if($miercoles2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $miercoles_porcentaje;
                  echo "%";

                }
                ?></div>
              </div>
              <div class="bar ">
                <div class="title">JUEVES</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $jueves2_c; ?>" data-toggle="tooltip" data-placement="top">    
                 <?php  
                if($jueves2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $jueves_porcentaje;
                  echo "%";

                }
                ?></div>
              </div>
              <div class="bar">
                <div class="title">VIERNES</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $viernes2_c; ?>" data-toggle="tooltip" data-placement="top">
                  <?php  
                if($viernes2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $viernes_porcentaje;
                  echo "%";

                }
                ?></div>
              </div>
            < <div class="bar ">
                <div class="title">SABADO</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $sabado2_c; ?>" data-toggle="tooltip" data-placement="top">
                
                <?php  
                if($sabado2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $sabado_porcentaje;
                  echo "%";

                }
                ?> </div>
              </div> 
              <div class="bar">
                <div class="title">DOMINGO</div>
                <div class="value tooltips" data-original-title="<?php  echo  
                $domingo2_c; ?>" data-toggle="tooltip" data-placement="top">40%
                  <?php  
            /*    if($domingo2_c>100){
                  echo "100%";
                }
                else{
                  echo  
                  $domingo_porcentaje;
                  echo "%";

                }*/
                ?></div>
              </div>
            </div>
            <!--custom chart end-->


            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->
              <?php

              if(str_contains($estadogeneral, '0')){
     
        echo '<div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>ESTADO GENERAL</h5>
                  </div>
                  <canvas id="serverstatus02" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 100,
                        color: "#1c9ca7"
                      },
                      {
                        value: 0,
                        color: "#f68275"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                  </script>
               <p>';  
     
     echo $fecha;

   

      echo     '</p>
                  <footer>
                    <!--  <div class="pull-left">
                      <h5><i class="fa fa-hdd-o"></i> 0/0</h5>
                    </div> -->
                    <div>
                      <h10> <b>No has registrado ningún slot (espacio) ve a la pestaña "Slots(libres/ocupados)"
                      </b>
                      </h10>
                    </div>
                  </footer>
                </div>
           <!--     /darkblue panel -->
              </div>';

                  }

                  else { 
 
         echo  '<div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>ESTADO GENERAL</h5>
                  </div>
                  <canvas id="serverstatus02" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value:  ';
                        echo $complemento_porcentaje; 
                        echo ',
                        color: "#1c9ca7"
                      },
                      {
                        value: ';
                        echo $porcentaje_number;
                        echo ',
                        color: "#f68275"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                  </script>
                  <p>23 de Marzo, 2022</p>
                  <footer>
                    <div class="pull-left">
                      <h5><i class="fa fa-hdd-o"></i> 
                    ';
                   

     echo $proporcion;
  

echo                             '</h5>
                    </div>
                    <div class="pull-right">
                      <h5>
                      ';
                      echo $porcentaje;
                            echo '%
                      Ocupado</h5>
                    </div>
                  </footer>
                </div>
              </div>'; 
                  }

                  
              ?>  

              <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">


                  <?php
if($tuplasaafectadas_placa1>0){
  echo '<div id="spotify21">';

}
else{
 echo '<div id="spotify3">';

}


                  ?>  

                  <div class="col-xs-4 col-xs-offset-8">
                  <form action="entrada.php" method="get">


      
                  
                  <?php
if($tuplasaafectadas_placa1>0){
  echo '
  <input type="hidden" name="id_placa_entrada" value=';
 echo $id_placa_entrada;

  echo '>
<input type="hidden" name="entrada_salida" value="E">

              <button class="btn btn-sm btn-theme04">VER FOTOS DE ENTRADA</button>
              </form>
              ';

}


?>

                    </div>
                 
                    <div class="sp-title">

                      <?php

if($tuplasaafectadas_placa1>0){

  
/*
  if($deteccion_entrada_correcion!='NA'){
    echo '<h3 style="color:yellow;" >Placa:';
    echo  $deteccion_entrada_correcion;
    echo '</h3>';


  }
  else if($error_entrada!='S'){
    echo '<h3 style="color:yellow;" >Placa:';

    echo $deteccion_entrada;
    echo '</h3>';


  }
  else{
    echo '<h3 style="color:red;" >Placa:';
    echo $deteccion_entrada;
    echo '</h3>';

    echo '<h5 style="color:red;" >';
    echo 'Posiblemente hay un ERROR';
    echo '</h5>';

    echo '<h5 style="color:red;" >';
    echo 'en esta placa';
    echo '</h5>';



  }*/

  echo '<h3 style="color:yellow;" >Placa:';

  echo $deteccion_entrada;
  echo '</h3>';

}
else{


}
/*
echo '<h5 style="color:red;" >Placa:';

 
echo 'Esta placa puede tener errores, presione el boton para rojo para corregir';

 echo '</h5>';*/
    
          ?>

                  
                    </div>
                  
                  </div>
                  <p class="followers"><i class="fa fa-arrow-right"></i>
                  <?php
                  if($tuplasaafectadas_placa2>0){

               //     echo   'Último auto en llegar';

                    $separada = explode(' ', $hora_deteccion_entrada);

                    $separada2 = explode('-', $separada[0]);
            
                    $separada3 = explode(':', $separada[1]);
            
                    $hora_min_entrada = $separada3[0]. ':'.$separada3[1];
            
                  $fecha_formato_entrada = $separada2[2].'/'.$separada2[1];

                    $mensajeE='Último auto en llegar ';
                    $timestamp_entrada = '('.$fecha_formato_entrada. ' a las ' . $hora_min_entrada. ')';
                    $mensajeEntrada= $mensajeE . $timestamp_entrada;
                    
                    echo $mensajeEntrada;


                    //Obtener timestamp


}
else{
  echo 'No existen fotos registradas'; 


}
?>
                 </p>
                </div>
              </div>

              
              <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">


                <?php
if($tuplasaafectadas_placa2>0){
  echo '<div id="spotify2">';

}
else{
 echo '<div id="spotify3">';

}

?>  

                  <div class="col-xs-4 col-xs-offset-8">



               
                  
                  <?php
if($tuplasaafectadas_placa2>0){
  echo'<form action="salida.php" method="get">


  <input type="hidden" name="id_placa_entrada" value=';
  
  echo $id_placa_salida; 
  echo '>
  <input type="hidden" name="entrada_salida" value="S">
  <button class="btn btn-sm btn-theme04">VER FOTOS DE SALIDA</button>

  </form>';

}
else{  
  
  

  
  
  
  
  
  

}

?>



                    </div>
              
                    <div class="sp-title">


                    <?php
                    if($tuplasaafectadas_placa2>0){
                 
/*
  if($deteccion_salida_correcion!='NA'){
    echo '<h3 style="color:yellow;" >Placa:';
    echo  $deteccion_salida_correcion;
    echo '</h3>';


  }
  else if($error_salida!='S'){
    echo '<h3 style="color:yellow;" >Placa:';

    echo $deteccion_salida;
    echo '</h3>';


  }
  else{
    echo '<h3 style="color:red;" >Placa:';
    echo $deteccion_salida;
    echo '</h3>';

    echo '<h5 style="color:red;" >';
    echo 'Posiblemente hay un ERROR';
    echo '</h5>';

    echo '<h5 style="color:red;" >';
    echo 'en esta placa';
    echo '</h5>';



  }
*/


echo '<h3 style="color:yellow;" >Placa:';

echo $deteccion_salida;
echo '</h3>';




}
else{
  

}
?>
                  
         

                      </h3>
                    </div>
                  
                  </div>
                  <p class="followers"><i class="fa fa-arrow-left"></i> 
                  <?php
                  if($tuplasaafectadas_placa2>0){
                   

                    $separada = explode(' ', $hora_deteccion_salida);

                    $separada2 = explode('-', $separada[0]);
            
                    $separada3 = explode(':', $separada[1]);
            
                    $hora_min_salida = $separada3[0]. ':'.$separada3[1];
            
                  $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

                    $mensajeE='Último auto en Irse ';
                    $timestamp_salida= '('.$fecha_formato_salida. ' a las ' . $hora_min_salida. ')';
                    $mensajeSalida= $mensajeE . $timestamp_salida;
                    
                    echo $mensajeSalida;
                


}
else{
  echo 'No existen fotos registradas'; 


}
?>
                </p>
                </div>
              </div>
            
              
             
            </div>
            <!-- /row -->


             <!--custom chart end-->
          
             <div class="row mt">
              <!-- SERVER STATUS PANELS -->

              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>ESPACIOS PARA RESERVAS</h5>
                  </div>
                  <canvas id="serverstatus01" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 70,
                        color: "#FF6B6B"
                      },
                      {
                        value: 30,
                        color: "#fdfdfd"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                  </script>
                  <div class="row">
                    <div class="col-sm-6 col-xs-6 goleft">
                      <p><br/>
                      <h5><i class="fa fa-hdd-o"></i> 2/10</h5>
                    </p>

                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <h2>20%</h2>
                    </div>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->

               <!-- /col-md-4 -->
               <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="green-panel pn">
                  <div class="green-header">
                    <h5>INGRESOS</h5>
                  </div>
                  <div class="chart mt">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                  </div>
                  <p class="mt"><b>Q 10,000</b><br/>Mes actual</p>
                </div>
              </div>
              <!-- /col-md-4 -->
            
            
            
           

               <!--  /col-md-4 -->
               <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>SITE STATICS</h5>
                  </div>
                  <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
                  <p>+ 1,789 NEW VISITS</p>
                  <footer>
                    <div class="centered">
                      <h5><i class="fa fa-trophy"></i> 17,988</h5>
                    </div>
                  </footer>
                </div>
                <!--  /darkblue panel -->
              </div>
              <!-- /col-md-4 -->
              
            </div>
            <!-- /row -->
           
           
          
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
               *********************************************************************************************************************************************************** -->
           
               <div class="col-lg-3 ds"> 

                
                <!--COMPLETED ACTIONS DONUTS CHART
                <div class="donut-main">
                  <h4>COMPLETED ACTIONS & PROGRESS</h4>
                  <canvas id="newchart" height="130" width="130"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 70,
                        color: "#4ECDC4"
                      },
                      {
                        value: 30,
                        color: "#fdfdfd"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
                  </script>
                </div> -->
                <!--NEW EARNING STATS 
                <div class="panel terques-chart">
                  <div class="panel-body">
                    <div class="chart">
                      <div class="centered">
                        <span>TODAY EARNINGS</span>
                        <strong>$ 890,00 | 15%</strong>
                      </div>
                      <br>
                      <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                    </div>
                  </div>
                </div> -->
                <!--new earning end-->

                <h4 class="centered mt">Actvidad Reciente</h4>
                <!-- First Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Justo Ahora</muted>
                      <br/>
                      <a href="#"> Javier Escobar</a> llego al parqueo y comenzo su servicio.<br/>
                    </p>
                  </div>
                </div>
                <!-- Second Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 2 minutos </muted>
                      <br/>
                      <a href="#">Huening Bahiyyih</a> Realizo una reserva para el día 26/03.<br/>
                    </p>
                  </div>
                </div>
                <!-- Third Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 3 horas</muted>
                      <br/>
                      <a href="#">Jorge Pérez</a> Finalizo su servicio.<br/>
                    </p>
                  </div>
                </div>
                <!-- Fourth Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 1 día</muted>
                      <br/>
                      <a href="#">Jenson Button</a> Realizo una reserva para el día de mañana .<br/>
                    </p>
                  </div>
                </div>


            
             
                <!-- CALENDAR-->
                <div id="calendar" class="mb">
                  <div class="panel green-panel no-margin">
                    <div class="panel-body">
                      <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="disadding: none;"></h3>
                        <div id="date-popover-content" class="popover-content"></div>
                      </div>
                      <div id="my-calendar"></div>
                    </div>
                  </div>
                </div>
                <!-- / calendar -->
              </div>   


          <!-- /col-lg-3 -->
        </div>   
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <!--footer start-->
   
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>

  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>

  <script src="lib/xchart/d3.v3.min.js"></script>
  <script src="lib/xchart/xcharts.min.js"></script>
  <script>
    (function() {
      var data = [{
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": "<?php  echo   $lunes2_c; ?>",
            "x": "2012-11-19T00:00:00"
          }, {
            "y": "<?php  echo $martes2_c; ?>",
            "x": "2012-11-20T00:00:00"
          }, {
            "y": "<?php  echo  $miercoles2_c;?>",
            "x": "2012-11-21T00:00:00"
          }, {
            "y": "<?php  echo $jueves2_c;?>",
            "x": "2012-11-22T00:00:00"
          }, {
            "y": "<?php  echo $viernes2_c;
            ?>",
            "x": "2012-11-23T00:00:00"
          }, {
            "y": "<?php  echo $sabado2_c; ?>",
            "x": "2012-11-24T00:00:00"
          }, {
            "y": "<?php  echo  
                $domingo2_c;
           ?>",
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": "<?php  echo  
                $domingo1_c; ?>",
            "x": "2012-11-19T00:00:00"
          }, {
            "y": "<?php  echo   
                $lunes1_c; ?>",
            "x": "2012-11-20T00:00:00"
          }, {
            "y": "<?php  echo   
                $martes1_c; ?>",
            "x": "2012-11-21T00:00:00"
          }, {
            "y": "<?php  echo   
                $miercoles1_c; ?>",
            "x": "2012-11-22T00:00:00"
          }, {
            "y": "<?php  echo $jueves1_c; ?>",
            "x": "2012-11-23T00:00:00"
          }, {
            "y": "<?php  echo $sabado1_c; ?>",
            "x": "2012-11-24T00:00:00"
          }, {
            "y": "<?php  echo $domingo1_c; ?>",
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "line-dotted",
        "yScale": "linear"
      }, {
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "cumulative",
        "yScale": "linear"
      }, {
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "bar",
        "yScale": "linear"
      }];
      var order = [0, 1, 0, 2],
        i = 0,
        xFormat = d3.time.format('%A'),
        chart = new xChart('line-dotted', data[order[i]], '#chart', {
          axisPaddingTop: 5,
          dataFormatX: function(x) {
            return new Date(x);
          },
          tickFormatX: function(x) {
            return xFormat(x);
          },
          timing: 1250
        }),
        rotateTimer,
        toggles = d3.selectAll('.multi button'),
        t = 3500;

     /* function updateChart(i) {
        var d = data[i];
        chart.setData(d);
        toggles.classed('toggled', function() {
          return (d3.select(this).attr('data-type') === d.type);
        });
        return d;
      }

      toggles.on('click', function(d, i) {
        clearTimeout(rotateTimer);
        updateChart(i);
      });

      function rotateChart() {
        i += 1;
        i = (i >= order.length) ? 0 : i;
        var d = updateChart(order[i]);
        rotateTimer = setTimeout(rotateChart, t);
      }
      rotateTimer = setTimeout(rotateChart, t);*/
    }());
  </script>



  <script type="text/javascript">
    /*$(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenido a Parkiate-ki estimado usuario administrador:',
        // (string | mandatory) the text inside the notification
        text: 'Estamos aquí para servirle en lo que necesite',
        // (string | optional) the image to display on the left
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });*/
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>

	
<script>
    $(document).ready(function() {
        // auto refresh page after 1 second
        setInterval('refreshPage()', 30000);
    });
 
    function refreshPage() { 
        location.reload(); 
    }
</script>

</body>

</html>
