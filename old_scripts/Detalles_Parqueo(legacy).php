
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

}

?>


    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Datos del parqueo <?php echo $id_parqueo;?>  </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Datos Principales </h4>
              <form class="form-horizontal style-form" action="RegistrarParqueo2.php">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label"> Nombre del Parqueo: 
                </label>
                  <div class="col-sm-8">
               <!--     <input type="text" name="nombre_empresa" placeholder="Introduzca el nombre oficial registrado" class="form-control"> -->
                    <p class="form-control-static"> <?php echo $nombreparqueo;?></p>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Dirección:</label>
                  <div class="col-sm-8"> 
                  <p class="form-control-static"> <?php echo $direccion;?></p>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Capacidad Máxima:</label>
                  <div class="col-sm-1">
                  

                  <p class="form-control-static"> <?php echo $capacidad;?></p>
                  </div>
                </div>



                <h4 class="mb"><i class="fa fa-angle-right"></i> Tarifas Registradas: </h4>
            <!--  <form class="form-horizontal style-form" method="get"> -->
       
               
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">1/2 hora: (Q)</label>
                  <div class="col-sm-1">
                  
                  <p class="form-control-static"> <?php echo $tarifa1;?></p> 
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Hora: (Q) </label>
                  <div class="col-sm-1">
                  <p class="form-control-static"> <?php echo $tarifa2;?></p> 

                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Día: (Q) </label>
                  <div class="col-sm-1">


                  <?php

                  if($tarifa3==0){

                    echo "<p class='form-control-static'>N/A</p>";

                  }
                  else{
                    
                    echo "<p class='form-control-static'>$tarifa3</p>";


                  }





                  
                  ?>

                </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Mes: (Q)</label>
                  <div class="col-sm-1">


                  <?php

if($tarifa4==0){
  echo "<p class='form-control-static'>N/A</p>";
}
else{
 
  echo "<p class='form-control-static'>$tarifa4</p>";
}




?>

                  </div>
                </div>



                
                <h4 class="mb"><i class="fa fa-angle-right"></i> Ubicación Geográfica </h4>



                <div class="form-group">
                  <label class="control-label col-md-3">Latitud</label>
                  <div class="col-md-4">
                    <div class="input-group bootstrap-timepicker">
                    <p class="form-control-static"> <?php echo $latitude;?></p> 
                    
                    </div>
                  </div>
                </div>
        
                  <div class="form-group">
                    <label class="control-label col-md-3">Longidut</label>
                    <div class="col-md-4">
                      <div class="input-group bootstrap-timepicker">
                      <p class="form-control-static"> <?php echo $longitude;?></p>                         
                      </div>
                    </div>
                  </div>


                <h4 class="mb"><i class="fa fa-angle-right"></i> Lunes </h4>



                <div class="form-group">
                  <label class="control-label col-md-3">Horario de apertura</label>
                  <div class="col-md-4">
                    <div class="input-group bootstrap-timepicker">
                    <p class="form-control-static"> <?php echo $lunes_entrada;?></p> 
                    
                    </div>
                  </div>
                </div>
        
                  <div class="form-group">
                    <label class="control-label col-md-3">Horario de Cierre</label>
                    <div class="col-md-4">
                      <div class="input-group bootstrap-timepicker">
                      <p class="form-control-static"> <?php echo $lunes_salida;?></p>                         
                      </div>
                    </div>
                  </div>


                  <h4 class="mb"><i class="fa fa-angle-right"></i> Martes </h4>



<div class="form-group">
  <label class="control-label col-md-3">Horario de apertura</label>
  <div class="col-md-4">
    <div class="input-group bootstrap-timepicker">
    <p class="form-control-static"> <?php echo $martes_entrada;?></p> 
    
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="control-label col-md-3">Horario de Cierre</label>
    <div class="col-md-4">
      <div class="input-group bootstrap-timepicker">
      <p class="form-control-static"> <?php echo $martes_salida;?></p>                         
      </div>
    </div>
  </div>


  <h4 class="mb"><i class="fa fa-angle-right"></i> Miercoles </h4>



<div class="form-group">
  <label class="control-label col-md-3">Horario de apertura</label>
  <div class="col-md-4">
    <div class="input-group bootstrap-timepicker">
    <p class="form-control-static"> <?php echo $miercoles_entrada;?></p> 
    
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="control-label col-md-3">Horario de Cierre</label>
    <div class="col-md-4">
      <div class="input-group bootstrap-timepicker">
      <p class="form-control-static"> <?php echo $miercoles_salida;?></p>                         
      </div>
    </div>
  </div>


  
  <h4 class="mb"><i class="fa fa-angle-right"></i> Jueves </h4>



<div class="form-group">
  <label class="control-label col-md-3">Horario de apertura</label>
  <div class="col-md-4">
    <div class="input-group bootstrap-timepicker">
    <p class="form-control-static"> <?php echo $jueves_entrada;?></p> 
    
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="control-label col-md-3">Horario de Cierre</label>
    <div class="col-md-4">
      <div class="input-group bootstrap-timepicker">
      <p class="form-control-static"> <?php echo $jueves_salida;?></p>                         
      </div>
    </div>
  </div>


  <h4 class="mb"><i class="fa fa-angle-right"></i> Viernes </h4>



<div class="form-group">
  <label class="control-label col-md-3">Horario de apertura</label>
  <div class="col-md-4">
    <div class="input-group bootstrap-timepicker">
    <p class="form-control-static"> <?php echo $viernes_entrada;?></p> 
    
    </div>
  </div>
</div>

  <div class="form-group">
    <label class="control-label col-md-3">Horario de Cierre</label>
    <div class="col-md-4">
      <div class="input-group bootstrap-timepicker">
      <p class="form-control-static"> <?php echo $viernes_salida;?></p>                         
      </div>
    </div>
  </div>



  <?php

$time_from1 = strtotime($sabado_entrada);
  $time_to1 = strtotime($sabado_salida);


?>   

<h4 class="mb"><i class="fa fa-angle-right"></i> Sabado </h4>

<div class="form-group">
<label class="control-label col-md-3">Horario de apertura</label>
<div class="col-md-4">
<div class="input-group bootstrap-timepicker">

<?php


if($time_from1 == $time_to1){
   
echo "<p class='form-control-static'>N/A</p>";


}
else {

echo "<p class='form-control-static'>$sabado_entrada</p>";




}            

?>

        
    </div>
      
</div>
</div>

<div class="form-group">
 <label class="control-label col-md-3">Horario de Cierre</label>
 <div class="col-md-4">
 <div class="input-group bootstrap-timepicker">

 <?php


if($time_from1 == $time_to1){

echo "<p class='form-control-static'>N/A</p>";
}
else {
echo "<p class='form-control-static'>$sabado_salida</p>";

}            
?>


      
    </div>
 </div>
</div>



                  <?php

                  $time_from = strtotime($domingo_entrada);
                    $time_to = strtotime($domingo_salida);


                  ?>   

                  <h4 class="mb"><i class="fa fa-angle-right"></i> Domingo </h4>
             
               <div class="form-group">
                 <label class="control-label col-md-3">Horario de apertura</label>
                 <div class="col-md-4">
                 <div class="input-group bootstrap-timepicker">

                <?php

                
if($time_from == $time_to){
                     
  echo "<p class='form-control-static'>N/A</p>";


}
else {

  echo "<p class='form-control-static'>$domingo_entrada</p>";

                  

  
}            

                ?>

                          
                      </div>
                        
                 </div>
               </div>
       
                 <div class="form-group">
                   <label class="control-label col-md-3">Horario de Cierre</label>
                   <div class="col-md-4">
                   <div class="input-group bootstrap-timepicker">
                  
                   <?php

                
if($time_from == $time_to){
             
  echo "<p class='form-control-static'>N/A</p>";
}
else {
  echo "<p class='form-control-static'>$domingo_salida</p>";
         
}            
                ?>


                        
                      </div>
                   </div>
                 </div>


                 <h4 class="mb"><i class="fa fa-angle-right"></i> Detalles del parqueo </h4>


                 <div class="form-group">

                 <div class="col-md-4">


                 <ul>
  
<?php
             if (str_contains($detalles, '1')) {
    echo '<li>-Baños</li>';} 


    if (str_contains($detalles, '2')) {
      echo '<li>-Bajo techo</li>';} 


      if (str_contains($detalles, '3')) {
        echo '<li>-Asfalto</li>';} 


        if (str_contains($detalles, '4')) {
          echo '<li>-Seguridad privada</li>';} 


          if (str_contains($detalles, '5')) {
            echo '<li>-Espacio para Furgoneta o camión</li>';} 

            if (str_contains($detalles, '6')) {
              echo '<li>-Lavado de autos</li>';} 

              if (str_contains($detalles, '7')) {
                echo '<li>-Iluminado </li>';} 

                if (str_contains($detalles, '8')) {
                  echo '<li>-Puerta de seguridad </li>';} 

                  if (str_contains($detalles, '9')) {
                    echo '<li>-Apto para discapacitados</li>';} 

                    if (str_contains($detalles, 'A')) {
                      echo '<li>-Cámara de Seguridad</li>';} 

                      if (str_contains($detalles, 'B')) {
                        echo '<li>-Amplio Espacio</li>';} 


                        if (str_contains($detalles, 'C')) {
                          echo '<li>-Sótano</li>';} 

                          if (str_contains($detalles, 'D')) {
                            echo '<li>-Pago con Tarjeta</li>';}
                            
                        
  ?>


</ul>  

</div>





</div>



<h4 class="mb"><i class="fa fa-angle-right"></i> Imagen del parqueo: </h4>



<div class="project-wrapper">
                              <div class="project">
                                <div class="photo-wrapper">
                                  <div class="photo">
                                        <img id=user-photo class="img-responsive" src=" <?php              
  echo $imagenes;
       
                ?>" alt="">
                                  </div>
                                </div>
                              </div>
                            </div>



                     
                            
                            <div class="span6">
                  
                  <a href="index.php" class="btn btn-compose">
                 <!-- <a href="contactformprospecto.html" class="btn btn-compose">  -->

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
