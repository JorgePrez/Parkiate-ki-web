
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
  <script src="lib/chart-master/Chart.js"></script>

 
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
<a class="active">
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


    <?php

$id_parqueo=$_GET["id_parqueo"];

$id_servicio=$_GET["id_servicio"];


$query = "select * from servicios_admin where Id_servicio='$id_servicio'";   




$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$id_servicio='';
$id_parqueo='';
$direccion = '';
$nombre_parqueo= '';
$imagenes='';
$id_usuario = '';
$nombre_usuario = ''; 
$telefono='';
$modelo_auto='';
$placa_auto='';
$fecha='';
$hora_deentrada='';
$hora_desalida='';
$precio='';
$parqueo_control_pagos='';
$media_hora='';
$hora='';

           

while ($row = pg_fetch_row($result)) {
 $id_servicio=$row[1];
 $id_parqueo=$row[2];
 $direccion = $row[3];
 $nombre_parqueo= $row[4];
 $imagenes=$row[5];
 $id_usuario = $row[6];
 $nombre_usuario = $row[7]; 
 $telefono=$row[8];
 $modelo_auto=$row[9];
 $placa_auto=$row[10];
 $fecha=$row[11];
 $hora_deentrada=$row[12];
 $hora_desalida=$row[13];
 $precio=$row[14];
 $parqueo_control_pagos=$row[15];
 $media_hora=$row[16];
 $hora=$row[17];
}


?>


    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Datos del servicio: <?php echo $id_servicio;?>  </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de usuario </h4>
              <form class="form-horizontal style-form" action="RegistrarParqueo2.php">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label"> Nombre: 
                </label>
                  <div class="col-sm-8">
               <!--     <input type="text" name="nombre_empresa" placeholder="Introduzca el nombre oficial registrado" class="form-control"> -->
                    <p class="form-control-static"> <?php echo $nombre_usuario;?></p>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Telefono:</label>
                  <div class="col-sm-8"> 
                  <p class="form-control-static"> <?php echo $telefono;?></p>
                  </div>
                </div>


  



                <h4 class="mb"><i class="fa fa-angle-right"></i> Datos de auto: </h4>
            <!--  <form class="form-horizontal style-form" method="get"> -->
       
               
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Vehiculo: </label>
                  <div class="col-sm-8">
                  
                  <p class="form-control-static"> <?php echo $modelo_auto;?></p> 
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Placa: </label>
                  <div class="col-sm-8">
                  <p class="form-control-static"> <?php echo $placa_auto;?></p> 

                  </div>
                </div>

                
           

        


                
                <h4 class="mb"><i class="fa fa-angle-right"></i> Datos del servicio </h4>



                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Hora de entrada</label>
                  <div class="col-sm-8">
                  
                  <p class="form-control-static"> <?php echo $hora_deentrada;?></p> 
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Hora de salida </label>
                  <div class="col-sm-8">
                  <p class="form-control-static"> <?php echo $hora_desalida;?></p> 

                  </div>
                </div>

                        
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Total Cobrado(Q) </label>
                  <div class="col-sm-8">
                  <p class="form-control-static">Q<?php echo $precio;?>.00</p> 

                  </div>
                </div>


             
                            
                            <div class="span6">


                            <a href="MisServicios.php?id_parqueo=<?php echo $id_parqueo ?>" class="btn btn-compose">

                
                  <i class="fa fa-pencil"></i> Regresar </a>

                          
                  </div>






           
              </form>
            </div>
          </div>
          <!-- col-lg-12-->
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
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <!--custom switch-->
  <script src="lib/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="lib/jquery.tagsinput.js"></script>
  <!--custom checkbox & radio-->
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>

  <?php
                  pg_free_result($result);
                  pg_close($conn);
                  ?>




</body>

</html>
