


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


    <?php
              
              $query = "select nombre from duenio where id_duenio='$id_usuario'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }


              pg_free_result($result);


              
              
              ?>
              
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
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
            <a  href="index.php">
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
            <a class="active" href="micuenta.php">
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
            <a href="escanearQR.php">
              <i class="fa fa-qrcode"></i>
              <span>Escanear QR de usuario</span>
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

  <?php


$query = "select * from duenio where id_duenio='$id_usuario'";
$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$nombrecompleto = '';

$dpi=0;
$nit=0;
$telefono=0;
$correo="";
$contrasenia="";
              
              
while ($row = pg_fetch_row($result)) {
$nombrecompleto= $row[1];
$dpi=$row[2];
$nit=$row[3];
$telefono=$row[4];
$correo=$row[5];
$contrasenia=$row[6];
}


?>


    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Mi Cuenta</h3>
        <!-- BASIC FORM ELELEMNTS -->

        <div class="col-lg-8 col-lg-offset-2 detailed mt">
                        <h4 class="mb">Información de contacto</h4>
                        <form role="form" class="form-horizontal" method="get" action="formularios/micuenta.php">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Id de Usuario</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="text" name="id" value="<?php echo $id_usuario ?> "  disabled>

                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Nombre Completo</label>
                            <div class="col-lg-8">
                              <input type="text" placeholder=" " id="addr2" name="nombre" class="form-control" value="<?php echo $nombrecompleto ?> ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">DPI</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="text" name="dpi" value="<?php echo $dpi ?> "  disabled>

                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-2 control-label">NIT</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="text" name="nit" value="<?php echo $nit ?> "  disabled>

                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-lg-2 control-label">Telefono</label>
                            <div class="col-lg-8">
                              <input type="blocked" placeholder=" " id="cell" name="telefono" class="form-control" value="<?php echo $telefono?>" >
                            </div>
                          </div>
                       
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-8">
                            <input type="blocked" placeholder=" " id="cell" name="correo" class="form-control" value="<?php echo $correo?>" >
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-2 control-label">Contraseña</label>
                            <div class="col-lg-8">
                              <input type="password" placeholder="Escriba su contraseña para confirmar cambios" name="contrasenia" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-12">
                              <button class="btn btn-theme" type="submit">Guardar Cambios</button>
                              <button class="btn btn-theme04" type="button">
                                
                              <span>
                      <a href="index.php">Cancelar</a></span>
            </button>
                            </div>
                          </div>
                        </form>
                      </div>


                   

            
         

         

            <!-- contact_details -->
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

  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script src="lib/form-component.js"></script>



</body>

</html>
