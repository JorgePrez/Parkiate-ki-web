
<?php




$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


if(!isset($_COOKIE["id_usuario"])){
  header("Location: login.html");

}



else{    
  $id_usuario= $_COOKIE["id_usuario"];

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
    <?php
              
              $query = "select nombre from duenio where id_duenio='$id_usuario'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }
              
              ?>
              
          
          
              <aside>
                <div id="sidebar" class="nav-collapse ">
                  <!-- sidebar menu start-->
                  <ul class="sidebar-menu" id="nav-accordion">
                    <p class="centered"><img src="img/ui-user.jpg" class="img-circle" width="80"></a></p>
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
                      <a href="opcione.php">
                        <i class="fa fa-home"></i>
                        <span>Menú Principal</span>
                        </a>
                    </li>
          
                    <li class="mt">
                      <a href="micuenta.php">
                        <i class="fa fa-desktop"></i>
                        <span>Mi cuenta</span>
                        </a>
                  
                    </li>
                    <li class="mt">
                      <a href="MisParqueos.php">
                        <i class="fa fa-truck"></i>
                        <span>Mis parqueos</span>
                        </a>
                    
                    </li>
                    <li class="mt">
                      <a href="RegistrarParqueo1.php">
                        <i class="fa fa-book"></i>
                        <span>Agregar parqueos</span>
                        </a>
                   
                    </li>
                    
                    <li class="mt">
                      <a  href="escanearQR.php">
                        <i class="fa fa-qrcode"></i>
                        <span>Escanear QR de usuario</span>
                        </a>
                   
                    </li>
            
                       </ul>
                  <!-- sidebar menu end-->
                </div>
              </aside>

              
    <?php

$id_parqueo=$_GET["id_parqueo"];




?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-table"></i> Espacios de estacionamiento</h3>

  
        <!-- COMPLEX TO DO LIST -->
        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-plus-circle"></i> Crear nuevo espacio o Slot</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">

              <form class="form-horizontal style-form" method="get" action="formularios/crearslot.php">

                
                <div class="form-group">
                  <label class="col-sm-8 col-sm-8 control-label"> <b>Código de espacio</b> (Slot): 
                </label>
                  <div class="col-sm-4">
                    <input type="text" name="codigo" placeholder="Por ejemplo P-23" class="form-control"> 

                    <input type="hidden" name="id_parqueo" value=<?php echo $id_parqueo;?>>



               <!--     <p class="form-control-static"> <b> <?php /*echo $nombreparqueo;*/?> </b> </p>
               -->
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-8 col-sm-8 control-label"> <b>Reservas</b>  (seleccione si este espacio estará destinado a reservas o será un espacio normal, puede modificarlo en cualquier momento):</label>
                  <div class="col-sm-4">   
                  <!--
                  <input type="text" name="direccion" placeholder=
                  "Introduzca la dirección donde se ubica el parqueo" class="form-control"> -->

                  <select name="reservas" class="form-control">


                  <option value="N">Espacio cómun</option>
                  <option value="S">Espacio Destinado para reservas</option>
 
                </select>

                  </div>
                </div>


             
        

                <div class=" add-task-row">




                  <button type="submit" class="btn btn-success">Crear Slot</button>





                  <a class="btn btn-danger pull-right" href="Slots.php?id_parqueo=<?php echo $id_parqueo ?>">Cancelar</a>





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