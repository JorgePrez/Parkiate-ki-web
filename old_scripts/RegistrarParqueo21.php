
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



$id_parqueo = $_GET['id_parqueo'];
$latitude=$_GET['latitude'];;
$longitude=$_GET['longitude'];

$query= "UPDATE parqueo SET latitude=$latitude, longitude=$longitude WHERE id_parqueo = '$id_parqueo'";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

 
 
 
 
 ?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Caracteristicas adicionales</h3>


        <form action="RegistrarParqueo3.php" method="get">

     
        <!-- COMPLEX TO DO LIST -->
        <div class="row mt mb">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-tasks"></i>  Elige las características que considera que tiene tu parqueo</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-list">
                  <ul id="sortable" class="task-list">
                    <li class="list-primary">
                      <i class=" fa fa-pause"></i>
                      <div class="task-checkbox">
                        
                      <input type="hidden" name="id_parqueo" value="<?php echo $id_parqueo; ?> checked">


                        <input type="checkbox" class="list-child" name="banios" value="1">
                      </div>
                      <div class="task-title">


                        <span class="task-title-sp">         <b>  Baños </b>                </span>
                   
                      </div>
                    </li>
                    <li class="list-danger">
                      <i class=" fa fa-home"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="bajotecho" value="2">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"> <b> Bajo Techo</b>     </span>
                       
                      </div>
                    </li>
                    <li class="list-success">
                      <i class=" fa fa-road"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="asfalto" value="3">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b>Asfaltado.</b> </span>
                        
                      </div>
                    </li>
                    <li class="list-warning">
                      <i class=" fa fa-eye"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="seguridad" value="4">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Seguridad Privada </b> </span>
                       
                      </div>
                    </li>
                    <li class="list-info">
                      <i class=" fa fa-truck"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="furgoneta" value="5">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Espacio para furgoneta o camión </b></span>
                       
                      </div>
                    </li>

                    <li class="list-primary">
                      <i class=" fa fa-eraser"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="lavado" value="6">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Lavado de Autos </b></span>
                   
                      </div>
                    </li>


                    <li class="list-primary">
                      <i class=" fa fa-lightbulb-o"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="ilumina" value="7">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Iluminado </b> </span>
                   
                      </div>
                    </li>

                    <li class="list-danger">
                      <i class=" fa fa-shield"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="puerta" value="8">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"> <b> Puerta de Seguridad </b> </span>
                       
                      </div>
                    </li>
                    <li class="list-success">
                      <i class=" fa fa-wheelchair"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="discapacitados" value="9">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Apto para discapacitados. </b> </span>
                        
                      </div>
                    </li>
                    <li class="list-warning">
                      <i class=" fa fa-camera-retro"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="obstaculos" value="A">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Cámara de seguridad </b></span>
                       
                      </div>
                    </li>
                    <li class="list-info">
                      <i class=" fa fa-expand"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="amplioespacio" value="B">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b>Amplio Espacio  </b> </span>
                       
                      </div>
                    </li>

                  
                    <li class="list-danger">
                      <i class=" fa fa-arrow-circle-down"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="sotano" value="C">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Sótano </b> </span>
                       
                      </div>
                    </li>
                    <li class="list-success">
                      <i class=" fa fa-credit-card"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="vallet" value="D">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b>  Pago con tarjeta. </b> </span>
                        
                      </div>
                    </li>
             
                  
                  </ul>
                </div>


                <h4 class="mb"><i class="fa fa-clock-o"></i> ¿Desea que la app le muestre al usuario el precio que debe pagar? </h4>
          

          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios1" value="S" checked>
              Si, deseo que la app se encargue de calcular el tiempo y le muestre al usuario cuando debe pagar. (DEBERÁ DESCARGAR LA APLICACIÓN MÓVIL o usar un lector de QR para PC)
              </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="optionsRadios" id="optionsRadios2" value="N">
              No, usaré mi propio sistema del parqueo para mostrarle al usuario cuanto debe pagar.
              </label>
          </div>
          <hr>

       



          <div class="showback">

        

                <button class="btn btn-primary btn-lg btn-block" type="submit"> 
                  Siguiente</button>
              </div>
               
              </div>
            </section>
          </div>
          <!--/col-md-12 -->
        </div>
        <!-- /row -->


        
        </form>
        
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
