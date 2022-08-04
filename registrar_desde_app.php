<?php






  $id_parqueo = $_GET['id_parqueo'];// 86BE48 

 // $id_parqueo = '86BE48';
  $id_usuario= $_GET['id_usuario']; //8


  //$id_usuario= '8';





$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   }


   $registro_exitoso='';
   $mensaje1='';
   $mensaje2='';

   
  $query = "select id_visita_actual from usuarios_app where id='$id_usuario'";   



  $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
  $condicion='';

            
 while ($row = pg_fetch_row($result)) {

    
 
   $condicion=$row[0];

 }

 pg_free_result($result);


 if(strlen($condicion)<=1){






  $query = "select id_placa_entrada,hora_deteccion_entrada, foto_auto_entrada,deteccion_entrada from placas_entrada where id_parqueo='$id_parqueo' and dentro_fuera='D' order by hora_deteccion_entrada desc limit 1";   



  $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
  $id_placa_entrada='';
  $hora_deteccion_entrada='';
  $foto_auto_entrada = '';
  $deteccion_entrada= '';



            
 while ($row = pg_fetch_row($result)) {

    
 
   $id_placa_entrada=$row[0];
   $hora_deteccion_entrada=$row[1];
   $foto_auto_entrada = $row[2];
   $deteccion_entrada= $row[3];
 }

 pg_free_result($result);


 
 $query = "
 
 select id_entrada_salida from placas_entrada_salida,placas_entrada as Pe 
 where id_placa_entrada='$id_placa_entrada' and id_placa_entrada=id_deteccion_entrada
  and Pe.id_parqueo='$id_parqueo'
 ";   



 $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
 $id_entrada_salida='';

while ($row = pg_fetch_row($result)) {   

  $id_entrada_salida=$row[0];

}

pg_free_result($result);





$query= "update placas_entrada_salida set id_usuario_app='$id_usuario' where id_entrada_salida='$id_entrada_salida' and id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);




$query="update usuarios_app set id_visita_actual='$id_entrada_salida' where id='$id_usuario'"; 

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);



$query="update auto set id_usuario_app='$id_usuario' where placa='$deteccion_entrada' and id_parqueo='$id_parqueo'"; 


$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


if((strlen($id_entrada_salida))>2 ){
  $registro_exitoso='1';

  $mensaje1=' Registro exitoso';
  $mensaje2=' Los datos fueron registrados correctamente , puedes cerrar esta ventana.';

  
}
else{

  $registro_exitoso='10';

  
  
  $mensaje1=' Registro Incorrecto';
  $mensaje2=' No existe fotografía reciente en la base de datos';







}

 }
else{

  $registro_exitoso='10';

  $mensaje1=' Registro Incorrecto';
  $mensaje2=' No se registro porque el usuario actualmente ya se encuentra en algún parqueo, puedes cerrar esta ventana';




}


if(strlen($registro_exitoso)==1){

  $separada = explode(' ', $hora_deteccion_entrada);

  $separada2 = explode('-', $separada[0]);

  $separada3 = explode(':', $separada[1]);

  $hora_min_entrada = $separada3[0]. ':'.$separada3[1];

$fecha_formato_entrada = $separada2[2].'/'.$separada2[1];

  $timestamp_entrada = '('.$fecha_formato_entrada. ' a las ' . $hora_min_entrada. ')';
  





}









  

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
    

#spotify21 {
	/*background: url(../placa_salida.jpeg) no-repeat center top;*/
  background: url(<?php echo $foto_auto_entrada?>) no-repeat center top;
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


</style>


  




</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
      </div>
      <!--logo start-->
       <a class="logo"><b><span>  PARK</span>IATE<span>-KI  </span> <i class="fa fa-car"></i></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
      
      
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>

    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
   
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-mail-forward"></i><?php echo $mensaje1 ?> </h3>
        <div class="row mt">


        <?php

        if(strlen($registro_exitoso)==1){

          echo '

        <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">
                  <div id="spotify21">
                   

                    <div class="sp-title">
                    <h3 style="color:yellow;" >Placa:';
                    
                echo $deteccion_entrada;
                
                
                echo '</h3>
                    </div>
              
                  </div>
                  <p class="followers"><i class="fa fa-arrow-right"></i> Imagen registrada al usuario (';
                   echo $deteccion_entrada ;
                   echo') </p>
                </div>
              </div>';
        }

              ?> 

          <div class="col-lg-12">
            <p><?php echo $mensaje2 ?></p>
          </div>
        </div>



      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
 
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



</body>

</html>

