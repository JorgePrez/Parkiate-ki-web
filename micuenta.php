
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
  <link rel="stylesheet" href="lib/xchart/xcharts.css">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">



  <script src="lib/chart-master/Chart.js"></script>


<!-- Incluir la versión minificada MD5 -->
<script src="js/md5.min.js"></script>


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
      <?php


include 'logout.php';

?>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->


        <?php
     /*         
              $query = "select nombre from duenio where id_duenio='$id_usuario'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }

              //ver si tiene asociado parqueo


  $query = "select * from duenio,parqueo where duenio.id_duenio=parqueo.id_duenio AND duenio.id_duenio='$id_usuario'";
$result = pg_query($conn, $query) or die('ERROR AL OBTENER DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);

$valorlisttile=0;



if($tuplasaafectadas==1){

 $valorlisttile=1;
  
  
  }*/


              
              ?>
              
  
              <?php
              
              $query = "select nombre_empresa from parqueo where id_parqueo='$id_parqueo'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }

              //ver si tiene asociado parqueo



              
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
<a class="active" href="micuenta.php">
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
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->

  <?php


$query = "select * from duenio where id_duenio='$id_usuario'";
$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());


$id_duenio="";
$nombre="";
$correo="";
$contrasenia="";
$nombre="";
$telefono="";

              
              
while ($row = pg_fetch_row($result)) {
$id_duenio= $row[0];
$correo=$row[1];
$contrasenia=$row[2];
$nombre=$row[4];
$telefono=$row[5];


}

if(strlen($id_parqueo) >1)
{
  $id_parqueo_show=$id_parqueo;
}
else{

  $id_parqueo_show='Aún no registrado( Finaliza la pestaña de Registrar mi parqueo)';
}


?>


    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-edit"></i> Editar Información de Cuenta</h3>
        <!-- BASIC FORM ELELEMNTS -->

        <div class="col-lg-8 col-lg-offset-2 detailed mt">
                        <h4 class="mb">Información de Registro</h4>
                        <form role="form" class="form-horizontal" method="get" action="formularios/micuenta.php" onsubmit ="return matchPassword()">
                          <div class="form-group">
                            <label class="col-lg-2 control-label">  <i class="fa fa-user"></i> Id de Usuario</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="text" name="id" value="<?php echo $id_usuario ?> "  disabled>
                               
                            
                              <input type="hidden" name="real_password" id="real_password" class="form-control" value="<?php echo $contrasenia ?>" required>


                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-lg-2 control-label">  <i class="fa fa-envelope"></i> Email</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="email" name="id" value="<?php echo $correo ?> "  disabled>
                               
                            
                              <input type="hidden" name="correo" id="correo" class="form-control" value="<?php echo $correo?>" required>


                            </div>
                          </div>
            
            
               


                            
                          <div class="form-group">
                            <label class="col-lg-2 control-label">                  <i class="fa fa-user"></i>  Nombre</label>
                            <div class="col-lg-8">
                            <input type="text" placeholder=" " name="nombre" id="nombre" class="form-control" value="<?php echo $nombre?>" required>
                            </div>
                          </div>


                                 
                          <div class="form-group">
                            <label class="col-lg-2 control-label">                  <i class="fa fa-mobile"></i>  Teléfono</label>
                            <div class="col-lg-8">
                            <input type="text" placeholder=" " name="telefono" id="telefono" class="form-control" value="<?php echo $telefono?>" required>
                            </div>
                          </div>



                          

                          <div class="form-group" id="contrasenia_input2">
                            <label class="col-lg-2 control-label">                  <i class="fa fa-key"></i>    Contraseña</label>
                            <div class="col-lg-8">
                              <input type="password" placeholder="Escriba su contraseña para confirmar cambios" name="password" id="password" class="form-control" required>
                              <p class="help-block" id="mensaje"></p>

                            </div>
                          </div>


                          <div class="form-group">
                            <label class="col-lg-2 control-label">   <i class="fa fa-home"></i>  Id de Parqueo</label>
                            <div class="col-lg-8">
                              <input class="form-control" id="disabledInput" type="text" name="id" value="<?php echo $id_parqueo_show ?> "  disabled>

                            </div>

                            <br>
                            <br>
                            <br>


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
  <script type="text/javascript" src="js/md5.min.js"></script>

  <script>
  function matchPassword() {  

  
var contrasenia_real = document.getElementById("real_password").value;  

var tohash=document.getElementById("password").value;

var contrasenia_enviada = md5(tohash);


console.log(contrasenia_real);

console.log(contrasenia_enviada);

 



if(contrasenia_real != contrasenia_enviada)  
{   
  document.getElementById("contrasenia_input2").className = "form-group has-error";
  document.getElementById("mensaje").innerHTML = "Contraseña incorrecta";

  return false 
} 



alert("Cambios realizados correctamente");  



}  
</script>


</body>

</html>
