


<?php




$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


if(!isset($_COOKIE["id_parqueo"])){

   $id_parqueo='N';
   $id_pagina_side_no='1';

}

else{

  $id_parqueo= $_COOKIE["id_parqueo"];


}



if(!isset($_COOKIE["id_usuario"])){
  header("Location: login.php");

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
    
              
         /*     $query = "select nombre from duenio where id_duenio='$id_usuario'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }*/
              
              ?>
              
          
          
              <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><img src="img/park_icon2.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">
        
          
    <?php
          if(strlen($id_parqueo) >1)
          {
            echo 'Parqueo la sexta'; //TODO: modificar el nombre del parqueo
          }
          else{
            echo 'Parece que áun no has registrado todos los detalles de tu parqueo, hazlo para poder ver todas nuestras opciones';

          }
     

          ?>
        
        </h5> 
        
        <?php 

if(strlen($id_parqueo) >1)
{
  include 'normal_sidebar.php';
}
else{

include 'side_bar_nopark_controller.php';
}
         


         ?>


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
        <h3><i class="fa fa-columns"></i> Agregar la información de tu parqueo <?php echo $id_parqueo;?> </h3>
  

        <div class="showback">
              <h4><i class="fa fa-angle-right"></i> 1.Presiona el botón "Agregar datos principales y carácteristicas"</h4>
              <div class="progress progress-striped active">
                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                  <span class="sr-only">45% Complete</span>
                </div>
              </div>
            </div>
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

              <form class="form-horizontal style-form">

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label"> Nombre del Parqueo: 
                </label>
                  <div class="col-sm-8">
               <!--     <input type="text" name="nombre_empresa" placeholder="Introduzca el nombre oficial registrado" class="form-control"> -->
                    <p class="form-control-static"> <b> <?php echo $nombreparqueo;?> </b> </p>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Dirección:</label>
                  <div class="col-sm-8"> 
                  <p class="form-control-static"> <b> <?php echo $direccion;?></b> </p>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Capacidad Máxima:</label>
                  <div class="col-sm-1">
                  

                  <p class="form-control-static"> <b> <?php echo $capacidad;?> </b> </p>
                  </div>



                  <label class="col-sm-1 col-sm-1 control-label">1/2 hora:</label>
                  <div class="col-sm-1">
                  
                  <p class="form-control-static"> <b>  Q<?php echo $tarifa1;?>.00  </p>  </b>
                  </div>
               

                
                  <label class="col-sm-1 col-sm-1 control-label">Hora:</label>
                  <div class="col-sm-1">
                  <p class="form-control-static"> <b> Q<?php echo $tarifa2;?>.00 </p> </b> 

                  
                </div>

                
                  <label class="col-sm-1 col-sm-1 control-label">Día:</label>
                  <div class="col-sm-1">


                  <?php

                  if($tarifa3==0){

                    echo "<p class='form-control-static'> <b>N/A</b></p>";

                  }
                  else{
                    
                    echo "<p class='form-control-static'><b> Q$tarifa3.00 </b> </p>";


                  }





                  
                  ?>

                </div>
              

                
            
                  <label class="col-sm-1 col-sm-1 control-label">Mes:</label>
                  <div class="col-sm-1">


                  <?php

if($tarifa4==0){
  echo "<p class='form-control-static'><b> N/A </b> </p>";
}
else{
 
  echo "<p class='form-control-static'><b> Q$tarifa4.00 </b> </p>";
}




?>

                  </div>
                </div>

               </form>
        

                <div class=" add-task-row">


                <?php


      echo "<a class='btn btn-success btn-sm pull-left' href=Editar_principales.php?id_parqueo=$id_parqueo>Editar Datos principales y tarifas</a>";



       ?>

                </div>
              </div>
            </section>



        
          </div>
          <!-- /col-md-12-->
        </div>
        <!-- /row -->



        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-calendar"></i> Horarios entre Semana</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">

              <form class="form-horizontal style-form">

                <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Lunes </label>
                  <div class="col-sm-2">

                  <?php
                  $lunese = substr($lunes_entrada, 0, -3);  // devuelve "abcde"


                  $lunesex = substr($lunes_salida, 0, -3);  

                  $lunes = $lunese . " - " . $lunesex;

                  ?>

                  <p class="form-control-static"><b><?php echo $lunes?></b></p> 

                  
                </div>

                
                <label class="col-sm-2 col-sm-2 control-label">Martes</label>
                  <div class="col-sm-2">
                  <?php
                  $martese = substr($martes_entrada, 0, -3);  // devuelve "abcde"


                  $martesex = substr($martes_salida, 0, -3);  

                  $martes = $martese . " - " . $martesex;

                  ?>

                  <p class="form-control-static"><b><?php echo $martes?></b></p> 

                  
                </div>


                <label class="col-sm-2 col-sm-2 control-label">Miercoles</label>
                  <div class="col-sm-2">


                  <?php
                  $miercolese = substr($miercoles_entrada, 0, -3);  // devuelve "abcde"


                  $miercolesex = substr($miercoles_salida, 0, -3);  

                  $miercoles = $miercolese . " - " . $miercolesex;

                  ?>

                  <p class="form-control-static"><b><?php echo $miercoles?></b></p> 
                  
                </div>

                </div>

                <div class="form-group">




                <label class="col-sm-2 col-sm-2 control-label">Jueves</label>
                  <div class="col-sm-2">

                  <?php
                  $juevese = substr($jueves_entrada, 0, -3);  // devuelve "abcde"


                  $juevesex = substr($jueves_salida, 0, -3);  

                  $jueves = $juevese . " - " . $juevesex;

                  ?>

                  <p class="form-control-static"><b><?php echo $jueves?></b></p>
                  
                </div>

                <label class="col-sm-2 col-sm-2 control-label">Viernes</label>
                  <div class="col-sm-2">
                  <?php
                  $viernese = substr($viernes_entrada, 0, -3);  // devuelve "abcde"


                  $viernesex = substr($viernes_salida, 0, -3);  

                  $viernes = $viernese . " - " . $viernesex;

                  ?>

                  <p class="form-control-static"><b><?php echo $viernes?></b></p>
                  
                </div>
                </div>


                    <h4><i class="fa fa-calendar-o"></i> Horarios de Fin de Semana</h4>


                <div class="form-group">


                <label class="col-sm-2 col-sm-2 control-label">Sabado</label>
                  <div class="col-sm-2">

                  <?php

if($sabado_entrada == $sabado_salida){
                     
  echo "<p class='form-control-static'><b>N/A</b></p>";




}
else {

  $sabadoen = substr($sabado_entrada, 0, -3);  // devuelve "abcde"


  $sabadoex = substr($sabado_salida, 0, -3);  

  $sabado = $sabadoen . " - " . $sabadoex;



  echo "<p class='form-control-static'><b>$sabado</b></p>";


                  

  
}   

               
                  ?>

                  
                </div>



                <label class="col-sm-2 col-sm-2 control-label">Domingo</label>
                  <div class="col-sm-2">
              

                  <?php

if($domingo_entrada == $domingo_salida){
                     
  echo "<p class='form-control-static'><b>N/A</b></p>";




}
else {

  $domingoen = substr($domingo_entrada, 0, -3);  // devuelve "abcde"


  $domingoex = substr($domingo_salida, 0, -3);  

  $domingo = $domingoen . " - " . $domingoex;



  echo "<p class='form-control-static'><b>$domingo</b></p>";


                  

  
}   

               
                  ?>
                  
                </div>

           


             

             

                </div>


           



                

        
             


        

                <div class=" add-task-row">



                <?php


echo "<a class='btn btn-success btn-sm pull-left' href=Editar_horarios.php?id_parqueo=$id_parqueo>Editar Horarios</a>";



 ?>

                </div>
            

            

               


               </form>
        

           
              </div>
            </section>



        
          </div>
          <!-- /col-md-12-->
        </div>
        <!-- /row -->



        
        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-location-arrow"></i> Ubicación</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">

              <form class="form-horizontal style-form">




               
  
                  
                
                  <div class="form-group">
  
  
  
  
                  <label class="col-sm-2 col-sm-2 control-label">Latitud</label>
                    <div class="col-sm-2">
  
                
  
                    <p class="form-control-static"><b><?php echo $latitude?></b></p>
                    
                  </div>
  
                  <label class="col-sm-2 col-sm-2 control-label">Longitud</label>
                    <div class="col-sm-2">
                
  
                    <p class="form-control-static"><b><?php echo $longitude?></b></p>
                    
                  </div>
                  </div>
  
  
                  <div class=" add-task-row">

                  <?php


echo "<a class='btn btn-success btn-sm pull-left' href=EditarUbicacion.php?id_parqueo=$id_parqueo>Editar Ubicación</a>";



 ?>                  </div>
              
  
              
  
                 
  

              

              

               


               </form>
        

           
              </div>
            </section>



        
          </div>
          <!-- /col-md-12-->
        </div>





  

          <!-- COMPLEX TO DO LIST -->
          <div class="row mt mb">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-tasks"></i> Características del parqueo</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-list">
                  <ul id="sortable" class="task-list">


 
                  <?php
             if (str_contains($detalles, '1')) {
    echo '<li class="list-primary"><i class=" fa fa-pause"></i><div class="task-title"><span class="task-title-sp"><b>Baños</b></span></div></li>';
  
  
  
  } 


    if (str_contains($detalles, '2')) {
      echo ' <li class="list-danger"><i class=" fa fa-home"></i><div class="task-title"><span class="task-title-sp"> <b> Bajo Techo</b></span></div></li>';
    } 


      if (str_contains($detalles, '3')) {
        echo '<li class="list-success"><i class=" fa fa-road"></i><div class="task-title"><span class="task-title-sp"><b>Asfaltado.</b> </span></div></li>';
      } 


        if (str_contains($detalles, '4')) {

         echo' <li class="list-warning"><i class=" fa fa-eye"></i><div class="task-title"><span class="task-title-sp"><b> Seguridad Privada </b> </span></div></li>';
        } 


          if (str_contains($detalles, '5')) {

            echo '<li class="list-info"><i class=" fa fa-truck"></i><div class="task-title"><span class="task-title-sp"><b> Espacio para furgoneta o camión </b></span></div></li>';

          
          } 

            if (str_contains($detalles, '6')) {

              echo '<li class="list-primary"><i class=" fa fa-ellipsis-v"></i><div class="task-title"><span class="task-title-sp"><b> Lavado de Autos </b></span></div></li>';
            
            
            } 

              if (str_contains($detalles, '7')) {
echo '<li class="list-primary"><i class=" fa fa-lightbulb-o"></i><div class="task-title"><span class="task-title-sp"><b> Iluminado </b> </span></div></li>';
              
              } 

                if (str_contains($detalles, '8')) {


 echo '<li class="list-danger"><i class=" fa fa-shield"></i><div class="task-title"><span class="task-title-sp"> <b> Puerta de Seguridad </b> </span></div></li>';                 
                } 

                  if (str_contains($detalles, '9')) {

 echo '<li class="list-success"><i class=" fa fa-wheelchair"></i><div class="task-title"><span class="task-title-sp"><b> Apto para discapacitados. </b> </span></div></li>';

                  } 

                    if (str_contains($detalles, 'A')) {

  echo '<li class="list-warning"><i class=" fa fa-camera-retro"></i><div class="task-title"><span class="task-title-sp"><b> Cámara de seguridad </b></span></div></li>';                    


                    } 

                      if (str_contains($detalles, 'B')) {
        
   echo '<li class="list-info"><i class=" fa fa-expand"></i><div class="task-title"><span class="task-title-sp"><b>Amplio Espacio  </b> </span></div></li>';


                      } 


                        if (str_contains($detalles, 'C')) {

       echo '<li class="list-danger"><i class=" fa fa-arrow-circle-down"></i><div class="task-title"><span class="task-title-sp"><b> Sótano </b> </span></div></li>';





                        } 

                          if (str_contains($detalles, 'D')) {


      echo  '<li class="list-success"><i class=" fa fa-credit-card"></i><div class="task-title"><span class="task-title-sp"><b>  Pago con tarjeta. </b> </span></div></li>';
                      

                          }
                            
                        
  ?>


                   
             
                  
                  </ul>
                </div>


                <div class=" add-task-row">

                <?php


echo "<a class='btn btn-success btn-sm pull-left' href=Editar_cara.php?id_parqueo=$id_parqueo>Editar Carácteristicas del parqueo</a>";



 ?> 

              </div>


           
              </div>
            </section>
          </div>
          <!--/col-md-12 -->
        </div>
        <!-- /row -->



        <div class="row mt">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-pircture-o"></i> Imagen del parqueo</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">

              <form class="form-horizontal style-form">


              
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


                            <div class=" add-task-row">



                            <?php


echo "<a class='btn btn-success btn-sm pull-left' href=Editar_imagen.php?id_parqueo=$id_parqueo>Editar Imagen</a>";



 ?>                 </div>




               
  
         

               </form>
        

           
              </div>
            </section>



        
          </div>
          <!-- /col-md-12-->
        </div>
        

     











       
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
