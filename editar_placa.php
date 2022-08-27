
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

   $id_parqueo='N';
   $id_pagina_side_no='2';


}

else{

  $id_parqueo= $_COOKIE["id_parqueo"];


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
  <link href="lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />



  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="css/to-do.css">
  <script src="lib/chart-master/Chart.js"></script>


  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

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
         
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="formularios/logout.php">Cerrar Sesión</a></li>
        </ul>
      </div>

    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
   <!--sidebar start-->

              
          
          
             <!--sidebar start-->
             <?php
              
              $query = "select nombre_empresa from parqueo where id_parqueo='$id_parqueo'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }




              
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
<a href="index.php">
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
              <span>Registro de autos(cámaras)</span>
              </a>
            <ul class="sub">
            <li><a href="entrada.php">Registro de autos (Entrada)</a></li>
              <li><a href="salida.php">Registro de autos (Salida)</a></li>
              <li><a href="flujo_autos.php">Entrada y Salida por Placa</a></li>
              <li><a href="autos.php">Registro por auto</a></li>
            </ul>
          </li>



    
          <li class="mt">
            <a href="javascript:;">
            <i class="fa fa-qrcode"></i>
              <span>Registros desde app (QR)</span>
              </a>
            <ul class="sub">
            <li><a href="visitas.php">Visitas actuales</a></li>
              <li><a href="historial_visitas.php">Historial de visitas (finalizadas)</a></li>
              <li><a href="usuarios.php">Registro de usuarios</a></li>
            </ul>
          </li>


    


        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

              
    <?php

$id_entrada_salida=$_GET["id_entrada_salida"];

echo $id_entrada_salida;
//Obtener todos los datos con el id_entrada_salida


$query = "select id_deteccion_entrada,id_deteccion_salida,deteccion_entrada_salida,existe_error from placas_entrada_salida where id_entrada_salida='$id_entrada_salida' AND id_parqueo='$id_parqueo'";
   //                       $query = "select * from prospectos_template";


   $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
   $id_deteccion_entrada='';
   $id_entrada_salida='';
   $deteccion_entrada_salida='';
   $existe_error='';


   while ($row = pg_fetch_row($result)) {
      $id_deteccion_entrada=$row[0];
      $id_deteccion_salida=$row[1];
      $deteccion_entrada_salida=$row[2];
      $existe_error= $row[3];
   }


$id_placa_entrada=$id_deteccion_entrada;

/*
$camara='';

if (str_contains($entrada_salida, 'E')){

  $camara='entrada';
*/
 // $query = "select * from parqueo where id_parqueo='$id_parqueo'";
 $query= "select * from placas_entrada where id_placa_entrada='$id_placa_entrada' AND id_parqueo='$id_parqueo'"; 

//}
/*else{
  $query = "select * from placas_salida where id_placa_salida='$id_placa_entrada' AND id_parqueo='$id_parqueo'";

  $camara='salida';
}*/


$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_placa1='';
$hora_deteccion='';
$foto_auto = '';
$deteccion= '';
$id_parqueo1='';
$completo = '';

$foto_placa='';

           


while ($row = pg_fetch_row($result)) {

        $id_placa1=$row[0];
        $hora_deteccion=$row[1];
        $foto_auto =$row[2];
        $deteccion= $row[3];
        $id_parqueo1=$row[4];
        $completo =$row[5];

        $foto_placa=$row[6];
}


$placa_antigua=$deteccion;


$separada = explode(' ', $hora_deteccion);

$separada2 = explode('-', $separada[0]);

$separada3 = explode(':', $separada[1]);

$hora_min_entrada = $separada3[0]. ':'.$separada3[1];

$fecha_formato_entrada = $separada2[2].'/'.$separada2[1];

$id_entrada_salida=$_GET["id_entrada_salida"];

?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Información de Foto con ID: <?php echo $id_entrada_salida;?> </h3>
  
  
          <!-- COMPLEX TO DO LIST -->
          <div class="row mt">
            <div class="col-md-12">
              <section class="task-panel tasks-widget">
                <div class="panel-heading">
                  <div class="pull-left">
                    <h4><i class="fa fa-picture-o"></i> Imagenes (Hacer Click en imagen para enfocarla)   [Se muestran las imagenes de placa,y la del auto ]</h4>
                  </div>
                  <br>
                </div>
               
                <center>
                <div class="row mt">
          <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 desc">
                  <div class="photo">

                  <?php ?>
                    <a class="fancybox" href="<?php echo $foto_placa; ?>"><img class="img-responsive" src="<?php echo $foto_placa; ?>" 
                    width='400px' height='auto' alt=""></a>
                  </div>


              <!--       <div class="photo">
                    <a class="fancybox" href="<?php //echo $foto_auto?>"><img class="img-responsive" src="<?php// echo $foto_auto ?>"  width='500px' height='auto' alt=""></a>
                  </div>
                  <div class="overlay"></div>-->
                <!--    <div class="overlay"></div> -->
              
              
            
          </div>
          <!-- col-lg-4 -->
          <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12 desc">
                  <div class="photo">
                    <a class="fancybox" href="<?php echo $foto_auto?>"><img class="img-responsive" src="<?php echo $foto_auto ?>"  width='500px' height='auto' alt=""></a>
                  </div>
                  <!--   <div class="overlay"></div>   -->
              
                
              
          </div>

       </center>
          <!-- col-lg-4 -->
   
              
            
          </div>
          <!-- col-lg-4 -->
               
  
  
              </section>
  
  
  
          
            </div>
            <!-- /col-md-12-->
          </div>
          <!-- /row -->



            <!-- COMPLEX TO DO LIST -->
        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-edit"></i> Hacer corrección de Placa (si la placa coincide exactamente con la imagen solo presiona el botón "guardar cambios")</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">
              <?php


  echo '<form role="form" class="form-horizontal style-form" action="formularios/modificar_placa.php" method="get">';






$mensaje='';
$valor_mostrado='';
                

if($existe_error=='N'){       
echo '<div class="form-group has-success">';  

        $mensaje='La placa cumple con el formato por lo que parece estar bien, 
        si en caso no lo estuviera puedes introducir la placa correcta con ayuda de las fotos de arriba';

        $valor_mostrado= $deteccion;



}else {

  echo '<div class="form-group has-error">';  
  $mensaje='Hay algún error, puedes escribir la placa correcta con ayuda de las fotos de arriba';
  $valor_mostrado= $deteccion;

}

//<div class="form-group has-success">   <!-- has-success has-error has-warning -->

?>
                    <label class="col-lg-6 control-label">Placa detectada en cámara de
                    <?php
                    echo $camara;
                    $label_message = ' el dia ' . $fecha_formato_entrada . ' a las ' . $hora_min_entrada;
                    echo $label_message;
                    ?>
                    
                    :</label>
                    <div class="col-lg-7">
                      <input type="text" placeholder="" name="placa_corr" id="placa_corr" class="form-control" value="<?php echo $valor_mostrado?>">
                      <p class="help-block">  <?php
                    echo $mensaje;
                    ?></p>
                    </div>
                  </div>
               
                  <input type="hidden" name="id_placa_corr" value="<?php echo $id_entrada_salida; ?>">


                  <input type="hidden" name="placa_antigua" value="<?php echo $valor_mostrado; ?>">


                  <div class=" add-task-row">




<button type="submit" class="btn btn-success">Guardar Cambios</button>



</div>
                </form>

            </section>



        
          </div>
          <!-- /col-md-12-->
        </div>
        <!-- /row -->



        








       
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
   
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/fancybox/jquery.fancybox.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript">
    $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });
  </script>
  <!--script for this page-->
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="lib/tasks.js" type="text/javascript"></script>
  <script>
    jQuery(document).ready(function() {
      TaskList.initTaskWidget();
    });

    $(function() {
      $("#sortable").sortable();
      $("#sortable").disableSelection();
    });
  </script>

</body>

</html>
