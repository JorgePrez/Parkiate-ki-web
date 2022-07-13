
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


//Obtener estado de todos los espacio




$query = "select estado from slots where id_parqueo='$id_parqueo'";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$tuplasaafectadas = pg_affected_rows($result);

$estadogeneral='';
$contador_ocupados=0;



if($tuplasaafectadas>0){


  $estadogeneral='1';

    
    
  while ($row = pg_fetch_row($result)) {
    $estado_variable=$row[0];





/* CONSULTAA FIREBASE PARA VER EL ESTADO DEL PARQUEO

RUTA DE ESTE MANERA: https://parkiate-ki-default-rtdb.firebaseio.com/Parking_Status/-Mq73KmXyn-fx7tlnIQn/-N-t_vx07IoxzsBpIURf/estado.json
*/






if(str_contains($estado_variable, 'S'))
{


}


else {


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


pg_free_result($result);





//Obtener estado de los espacios de reserva


$query = "select estado from slots where id_parqueo='$id_parqueo' and reservas='S'";
//                       $query = "select * from prospectos_template";

$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$tuplasaafectadas2 = pg_affected_rows($result);

$estadogeneral2='';
$contador_ocupados2=0;



if($tuplasaafectadas2>0){


  $estadogeneral2='1';

    
    
  while ($row = pg_fetch_row($result)) {
    $estado_variable2=$row[0];





/* CONSULTAA FIREBASE PARA VER EL ESTADO DEL PARQUEO

RUTA DE ESTE MANERA: https://parkiate-ki-default-rtdb.firebaseio.com/Parking_Status/-Mq73KmXyn-fx7tlnIQn/-N-t_vx07IoxzsBpIURf/estado.json
*/






if(str_contains($estado_variable2, 'S'))
{


}


else {


$contador_ocupados2 = $contador_ocupados2+1;

}



  //FALSO ES OCUPADO
  




}

$proporcion2 = $contador_ocupados2. "/" .$tuplasaafectadas2 ;
  // echo $nombrecompleto;
  
  $porcentaje_number2= ($contador_ocupados2*100)/$tuplasaafectadas2;
  
  //echo $porcentaje_number;
  
  $complemento_porcentaje2= 100-$porcentaje_number2;
  
  //echo $complemento_porcentaje;
  $noDecimalNumber2 = intval($porcentaje_number2);
  $porcentaje2= strval($noDecimalNumber2);
}
else{
$estadogeneral2='0';
}


pg_free_result($result);






$now = new Datetime('now');
//$now = $now->format('d-m-Y');

$month = idate("m");

$anio = $now->format('Y');
$dia = $now->format('d');

$mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
          "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha=$dia." de ". $mesesN[$month] ." de $anio";






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

                
                $day7=Date('d/m', strtotime('-6 days'));
                $day6=Date('d/m', strtotime('-5 days'));
                $day5=Date('d/m', strtotime('-4 days'));
                $day4=Date('d/m', strtotime('-3 days'));
                $day3=Date('d/m', strtotime('-2 days'));
                $day2=Date('d/m', strtotime('-1 days'));
                $day1= date('d/m');



                
                $day7_c=Date('Y-m-d', strtotime('-6 days'));
                $day6_c=Date('Y-m-d', strtotime('-5 days'));
                $day5_c=Date('Y-m-d', strtotime('-4 days'));
                $day4_c=Date('Y-m-d', strtotime('-3 days'));
                $day3_c=Date('Y-m-d', strtotime('-2 days'));
                $day2_c=Date('Y-m-d', strtotime('-1 days'));
                $day1_c= date('Y-m-d');



                $cantidad7=0;
                $cantidad6=0;
                $cantidad5=0;
                $cantidad4=0;
                $cantidad3=0;
                $cantidad2=0;
                $cantidad1=0;


                



$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day7_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad7 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);


$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day6_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad6 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);


$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day5_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad5 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);

$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day4_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad4 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);


$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day3_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad3 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);

$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day2_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad2 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);


$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND DATE(hora_deteccion_entrada)='$day1_c'";
$resultadofecha = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$cantidad1 = pg_affected_rows($resultadofecha);
pg_free_result($resultadofecha);


                //determinar cantidad por dia


                $var7 = (string) $cantidad7; 
                $var6 = (string) $cantidad6; 
                $var5 = (string) $cantidad5; 
                $var4 = (string) $cantidad4;
                $var3 = (string) $cantidad3; 
                $var2 = (string) $cantidad2;
                $var1 = (string) $cantidad1;




                if($cantidad7>100){$per7 = '105';}else{$per7 = (string) $cantidad7;}
                if($cantidad6>100){$per6 = '105';}else{$per6 = (string) $cantidad6;}
                if($cantidad5>100){$per5 = '105';}else{$per5 = (string) $cantidad5;}
                if($cantidad4>100){$per4 = '105';}else{$per4 = (string) $cantidad4;}
                if($cantidad3>100){$per3 = '105';}else{$per3 = (string) $cantidad3;}
                if($cantidad2>100){$per2 = '105';}else{$per2 = (string) $cantidad2;}
                if($cantidad1>100){$per1 = '105';}else{$per1 = (string) $cantidad1;}


//mes actual
$month = idate("m");
$mes_actual=$month;


//Obteniendo total de autos registrados en este parqueo
$query = "SELECT * from auto where id_parqueo='$id_parqueo'";
$resultadototales = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$autos_totales = pg_affected_rows($resultadototales);
pg_free_result($resultadototales);
$autos_totales=(string) $autos_totales;

//Obteniendo total de autos registrados en este parqueo este mes
$query = "SELECT * from auto where id_parqueo='$id_parqueo' AND EXTRACT(MONTH FROM fecha_registro_auto)='$mes_actual'";
$resultadototales = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$autos_mes = pg_affected_rows($resultadototales);
pg_free_result($resultadototales);
$autos_mes=(string) $autos_mes;


//obtenieendo visitas del mes actual                
$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo' AND EXTRACT(MONTH FROM hora_deteccion_entrada)='$mes_actual'";
$resultadototales = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$visitas_mes = pg_affected_rows($resultadototales);
pg_free_result($resultadototales);
$visitas_mes=(string) $visitas_mes;



/*Obteniendo visitas totales*/
$query = "SELECT * from placas_entrada where id_parqueo='$id_parqueo'";
$resultadototales = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$visitas_totales = pg_affected_rows($resultadototales);
pg_free_result($resultadototales);
$visitas_totales=(string) $visitas_totales;


             
                  

              
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
              <h3>   <i class="fa fa-bar-chart-o">  VISITAS DE LOS ULTIMOS 7 DÍAS A TU PARQUEO</i> </h3>
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
                <div class="title"><?php echo $day7?></div>
                <div class="value tooltips" data-original-title="<?php echo $var7?>" data-toggle="tooltip" data-placement="top"><?php echo $per7?>%</div>
              </div>
              <div class="bar ">
                <div class="title"><?php echo $day6?></div>
                <div class="value tooltips" data-original-title="<?php echo $var6?>" data-toggle="tooltip" data-placement="top"><?php echo $per6?>%</div>
              </div>
              <div class="bar ">
                <div class="title"><?php echo $day5?></div>
                <div class="value tooltips" data-original-title="<?php echo $var5?>" data-toggle="tooltip" data-placement="top"><?php echo $per5?>%</div>
              </div>
              <div class="bar ">
                <div class="title"><?php echo $day4?></div>
                <div class="value tooltips" data-original-title="<?php echo $var4?>" data-toggle="tooltip" data-placement="top"><?php echo $per4?>%</div>
              </div>
              <div class="bar">
                <div class="title"><?php echo $day3?></div>
                <div class="value tooltips" data-original-title="<?php echo $var3?>" data-toggle="tooltip" data-placement="top"><?php echo $per3?>%</div>
              </div>
              <div class="bar ">
                <div class="title"><?php echo $day2?></div>
                <div class="value tooltips" data-original-title="<?php echo $var2?>" data-toggle="tooltip" data-placement="top"><?php echo $per2?>%</div>
              </div>
              <div class="bar">
                <div class="title"><?php echo $day1?> (HOY)</div>
                <div class="value tooltips" data-original-title="<?php echo $var1?>" data-toggle="tooltip" data-placement="top"><?php echo $per1?>%</div>
              </div>
            </div>
            <!--custom chart end-->


            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->


                <!--  /col-md-4 -->
                <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>AUTOS ATENDIDOS POR TU PARQUEO</h5>
                  </div>
                  <h1 class="mt"><i class="fa fa-car fa-3x"></i></h1>
                  <p>+ <?php echo $autos_mes?> nuevos autos registrados este mes</p>
                  <footer>
                    <div class="centered">
                      <h5><i class="fa fa-car"></i> Total de autos: <?php echo $autos_totales?> </h5>
                    </div>
                  </footer>
                </div>
                <!--  /darkblue panel -->
              </div>
              <!-- /col-md-4 -->


         

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

  


  echo '<h3 style="color:yellow;" >Placa:';

  echo $deteccion_entrada;
  echo '</h3>';

}
else{


}

    
          ?>

                  
                    </div>
                  
                  </div>
                  <p class="followers"><i class="fa fa-arrow-right"></i>
                  <?php
                  if($tuplasaafectadas_placa1>0){

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


              
               <!-- /col-md-4 -->
               <div class="col-md-4 col-sm-4 mb">
                <!-- WHITE PANEL - TOP USER -->
                <div class="grey-panel pn">
                  <div class="grey-header">
                    <h5>VISITAS A TU PARQUEO </h5>
                  </div>
                  <p><img src="https://res.cloudinary.com/parkiate-ki/image/upload/v1656628282/detalles/fe744884-a74d-44f9-a336-fa3c9881954e_dmqvwh.png" class="img-circle" width="110"></p>
                  <div class="row">
                    <div class="col-md-6">
                    
                    <h5>
                      <p class="small mt">VISITAS DE ESTE MES</p>
                      <p><?php echo $visitas_mes?> </p>
                      </h5>
                     
                    </div>
                    <div class="col-md-6">
                 
                    <h5>
                      <p class="small mt">VISITAS TOTALES</p>
                      <p><?php echo $visitas_totales?> </p>

                      </h5>
                    
                     
                     
                    </div>
                  </div>
                </div>
              </div>

             



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
    <p>';
    
    echo $fecha;

    echo '</p>
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





    if(str_contains($estadogeneral2, '0')){


      

echo'

<div class="col-md-4 col-sm-4 mb">
   <div class="grey-panel pn">
     <div class="grey-header">
       <h5>ESPACIOS PARA RESERVAS</h5>
     </div>
     <canvas id="serverstatus01" height="120" width="120"></canvas>
     <script>
       var doughnutData = [{
           value:';           echo "0"; 
           echo',
           color: "#FF6B6B"
         },
         {
           value:';   echo "100"; 
           echo',
           color: "#fdfdfd"
         }
       ];
       var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
     </script>
                       <p>';
                       echo $fecha;
                        echo '</p>

                        <footer>
                        <!--  <div class="pull-left">
                          <h5><i class="fa fa-hdd-o"></i> 0/0</h5>
                        </div> -->
                        <div>
                          <h10> <b>No has registrado ningún espacio(slot) para reservas ve a la pestaña "Slots(libres/ocupados)"
                          </b>
                          </h10>
                        </div>
                      </footer>

   </div>
   <!-- /grey-panel -->
 </div>
 <!-- /col-md-4-->




 
</div>


';


    

             
    }
    else{

    



echo'

             <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn">
                  <div class="grey-header">
                    <h5>ESPACIOS PARA RESERVAS</h5>
                  </div>
                  <canvas id="serverstatus01" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value:';           echo $porcentaje_number2; 
                        echo',
                        color: "#FF6B6B"
                      },
                      {
                        value:';   echo $complemento_porcentaje2; 
                        echo',
                        color: "#fdfdfd"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                  </script>
                                    <p>';
                                    echo $fecha;
                                     echo '</p>

                  <footer>
                    <div class="pull-left">
                      <h5><i class="fa fa-hdd-o"></i>'; echo $proporcion2; echo'</h5>
                    </div>
                    <div class="pull-right">
                      <h5>'; echo $porcentaje2;
                       echo '%
                     Ocupardo</h5>
                    </div>
                  </footer>
            
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->


           
            
              
            </div>

             
';
                  }

            ?>        

            
            
           

        
           
           
          
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

                      <!-- USERS ONLINE SECTION -->

                      <?php

                     
                     $contador_entrada=0; 
                     $E_placanumber1='';
                      $E_image1='';
                       $E_formatofecha1=''; 

                      $E_placanumber2='';
                      $E_image2='';
                      $E_formatofecha2=''; 



                      $E_placanumber3='';
                      $E_image3='';
                      $E_formatofecha3=''; 



                      $E_placanumber4='';
                      $E_image4='';
                      $E_formatofecha4=''; 




                      $contador_salida=0;

                      $S_placanumber1='';
                      $S_image1='';
                      $E_formatofecha1=''; 


                      $S_placanumber2='';
                      $S_image2='';
                      $E_formatofecha2=''; 



                      $S_placanumber3='';
                      $S_image3='';
                      $E_formatofecha3=''; 

                      

                      $S_placanumber4='';
                      $S_image4='';
                      $E_formatofecha1=''; 









$query = "select hora_deteccion_entrada,foto_auto_entrada,deteccion_entrada from placas_entrada where id_parqueo='$id_parqueo' order by hora_deteccion_entrada desc limit 4";
$resultadoentrada = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());



 $contador_entrada = $contador_entrada +1;
  while ($row = pg_fetch_row($resultadoentrada)) {


    if($contador_entrada==1){
      $E_image1=$row[1];
      $E_placanumber1=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    //'Fecha: 26/06 | Hora: 17:18';

    $E_formatofecha1= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }

    if($contador_entrada==2){
      $E_image2=$row[1];
      $E_placanumber2=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    $E_formatofecha2= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }

    if($contador_entrada==3){
      $E_image3=$row[1];
      $E_placanumber3=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    $E_formatofecha3= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 


    }

    if($contador_entrada==4){
      $E_image4=$row[1];
      $E_placanumber4=$row[2];

       
      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1]; 

    $E_formatofecha4= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }



    $contador_entrada = $contador_entrada +1;

    
}
  
pg_free_result($resultadoentrada);













$query = "select hora_deteccion_salida,foto_auto_salida,deteccion_salida from placas_salida where id_parqueo='$id_parqueo' order by hora_deteccion_salida desc limit 4";
$resultadosalida = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());



 $contador_salida = $contador_salida +1;
  while ($row = pg_fetch_row($resultadosalida)) {


    if($contador_salida==1){
      $S_image1=$row[1];
      $S_placanumber1=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    //'Fecha: 26/06 | Hora: 17:18';

    $S_formatofecha1= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }

    if($contador_salida==2){
      $S_image2=$row[1];
      $S_placanumber2=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    $S_formatofecha2= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }

    if($contador_salida==3){
      $S_image3=$row[1];
      $S_placanumber3=$row[2];

      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1];

    $S_formatofecha3= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 


    }

    if($contador_salida==4){
      $S_image4=$row[1];
      $S_placanumber4=$row[2];

       
      $separada = explode(' ', $row[0]);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min_salida = $separada3[0]. ':'.$separada3[1];

    $fecha_formato_salida = $separada2[2].'/'.$separada2[1]; 

    $S_formatofecha4= 'Fecha: '.$fecha_formato_entrada. ' | Hora: '.$hora_min_salida ; 



    }



    $contador_salida = $contador_salida +1;

    
}
  
pg_free_result($resultadosalida);






echo   '<h4 class="centered mt">ÚLTIMAS FOTOS DE  <a>CÁMARA DE ENTRADA<a/> </h4>';




if(strlen($E_placanumber1)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $E_image1;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=entrada.php>';

  echo
                    $E_formatofecha1;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $E_placanumber1; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}
else{

echo ' 
  <div class="desc">
  <div class="thumb">
    <img src="https://res.cloudinary.com/parkiate-ki/image/upload/v1653897978/detalles/10-109983_security-camera-icon-png-cctv-icon-transparent-png_mxdo9a.png" width="75px" height="auto" align="">
  </div>
  <div class="details">
  <p>
          
       
          <br/>
        <b> NO HAY NINGUN AUTO REGISTRADO 
        <br/>
          
        POR LA CAMARA DE ENTRADA.</b>  
        </p>
  </div>
</div>
';



}



if(strlen($E_placanumber2)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $E_image2;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=entrada.php>';

  echo
                    $E_formatofecha2;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $E_placanumber2; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}


if(strlen($E_placanumber3)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $E_image3;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=entrada.php>';

  echo
                    $E_formatofecha3;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $E_placanumber3; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}





if(strlen($E_placanumber4)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $E_image4;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=entrada.php>';

  echo
                    $E_formatofecha4;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $E_placanumber4; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';


}

echo   '<h4 class="centered mt">ÚLTIMAS FOTOS DE  <a>CÁMARA DE SALIDA<a/> </h4>';


            
           

           

if(strlen($S_placanumber1)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $S_image1;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=salida.php>';

  echo
                    $S_formatofecha1;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $S_placanumber1; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}
else{

echo ' 
  <div class="desc">
  <div class="thumb">
    <img src="https://res.cloudinary.com/parkiate-ki/image/upload/v1653897978/detalles/10-109983_security-camera-icon-png-cctv-icon-transparent-png_mxdo9a.png" width="75px" height="auto" align="">
  </div>
  <div class="details">
  <p>
          
       
          <br/>
        <b> NO HAY NINGUN AUTO REGISTRADO 
        <br/>
          
        POR LA CAMARA DE SALIDA.</b>  
        </p>
  </div>
</div>
';



}



if(strlen($S_placanumber2)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $S_image2;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=salida.php>';

  echo
                    $S_formatofecha2;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $S_placanumber2; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}


if(strlen($S_placanumber3)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $S_image3;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=salida.php>';

  echo
                    $S_formatofecha3;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $S_placanumber3; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';

}





if(strlen($S_placanumber4)>0 )

{

echo '<div class="desc">
             <div class="thumb">
                <img src="';
                
                
                echo $S_image4;
                
echo                   '" width="75px" height="auto" align="">
              </div>
              <div class="details">
              <p>
                      
                   <b>  <a href=salida.php>';

  echo
                    $S_formatofecha4;
                        
  echo                                                 '</a> </b> <br/>
                      <br/>
                    <b> PLACA: ';
                            
                               echo  $S_placanumber4; 
                            
                            echo '.</b>  <br/>
                    </p>
              </div>
            </div>

            ';


}



if ((strlen($S_placanumber1)==0) && (strlen($E_placanumber1)==0) )

{

echo '<div id="calendar" class="mb">
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
 
</div>   
';


}
 
         

                      ?>




            
             
             


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
