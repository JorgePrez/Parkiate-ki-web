
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
<a class="active" href="Detalles_Parqueo.php">
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
    <!--sidebar end-->

              
    <?php

$id_parqueo=$_GET["id_parqueo"];



$query = "select * from parqueo where id_parqueo='$id_parqueo'";



$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$idparqueo='';
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
$control_pagos='';
$id_firebase='';
$reservas='';
           


while ($row = pg_fetch_row($result)) {
  $idparqueo1=$row[0];
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
        $control_pagos= $row[27];
        $id_firebase=$row[28];
        $reservas = $row[29];
}

?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Información Del Parqueo <?php echo $id_parqueo;?> </h3>
  
        <!-- COMPLEX TO DO LIST -->
        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-tasks"></i> Datos Principales y Tárifas</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">

              <form class="form-horizontal style-form" method="get" action="formularios/editarprincipales.php">

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label"> Nombre del Parqueo: 
                </label>
                  <div class="col-sm-8">
                    <input type="text" name="nombre_empresa" placeholder="Introduzca el nombre oficial registrado" value ="<?php echo $nombreparqueo;?>" class="form-control"> 

                    <input type="hidden" name="id_parqueo" value=<?php echo $id_parqueo;?>>



               <!--     <p class="form-control-static"> <b> <?php /*echo $nombreparqueo;*/?> </b> </p>
               -->
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Dirección:</label>
                  <div class="col-sm-8">   
                  <input type="text" name="direccion" placeholder="Introduzca la dirección donde se ubica el parqueo"  value ="<?php echo $direccion;?>" class="form-control">

                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Capacidad Máxima:</label>
                  <div class="col-sm-1">
                  
                  <input type="number" name="capacidad_maxima" class="form-control" value=<?php echo $capacidad;?>>

                  </div>



                  <label class="col-sm-1 col-sm-1 control-label">1/2 hora:</label>
                  <div class="col-sm-1">
                  

                  <input type="number" class="form-control" name="media_hora" value=<?php echo $tarifa1;?>>

                  </div>
               

                
                  <label class="col-sm-1 col-sm-1 control-label">Hora:</label>
                  <div class="col-sm-1">
                  <input type="number" class="form-control" name="hora" value=<?php echo $tarifa2;?> value=0>

                  
                </div>

                
                  <label class="col-sm-1 col-sm-1 control-label">Día:</label>
                  <div class="col-sm-1">


                  <?php



                 


                  echo "<input type='number' class='form-control' name='dia' value= $tarifa3>";



            





                  
                  ?>

                </div>
              

                
            
                  <label class="col-sm-1 col-sm-1 control-label">Mes:</label>
                  <div class="col-sm-1">


                  <?php

echo "<input type='number' class='form-control' name='mes' value= $tarifa4>";



?>

                  </div>
                </div>

        

                <div class=" add-task-row">




                  <button type="submit" class="btn btn-success">Guardar Cambios</button>





                  <a class="btn btn-danger pull-right" href="Detalles_Parqueo.php">Cancelar</a>





                </div>


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
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
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
