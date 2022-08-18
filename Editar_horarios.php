
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
      <?php
              
              $query = "select nombre from duenio where id_duenio='$id_usuario'";
              //                       $query = "select * from prospectos_template";
              
              $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
              $nombrecompleto = '';
              
              
              while ($row = pg_fetch_row($result)) {
              $nombrecompleto= $row[0];
              }
              
              ?>
              
          
          
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
        <h3><i class="fa fa-angle-right"></i> Información Del Parqueo <?php echo $id_parqueo;?> </h3>
  
      



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


            <!------------- LUNES-------------------->  

              <form class="form-horizontal style-form" method="get" action="formularios/editarhorarios.php">


                <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Lunes Entrada </label>
                 <div class="col-sm-2"> 

                 
                 <?php
                  $lunese = substr($lunes_entrada, 0, -3);  // devuelve "abcde"


                  $lunesex = substr($lunes_salida, 0, -3);  

                  $lunes = $lunese . " - " . $lunesex;

                  ?>



 
 <div class="input-group bootstrap-timepicker">
   <input type="time" class="form-control" name="lunes_apertura"  value="<?php echo $lunese;?>">
 
 </div>


                </div>

                
                <label class="col-sm-2 col-sm-2 control-label">Lunes salida</label>
                  <div class="col-sm-2">
              

                  <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="lunes_cierre"  value="<?php echo $lunesex;?>">
       
       </div>
                  
                </div>


                </div>


            <!------------- CIERRE LUNES-------->  



                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Marters Entrada </label>
                   <div class="col-sm-2"> 
  
                   
                   <?php
                

                    $martes_e = substr($martes_entrada, 0, -3);  // devuelve "abcde"

                    $martes_ex = substr($martes_salida, 0, -3);  // devuelve "abcde"

  
  
                    ?>
  
  
  
   
   <div class="input-group bootstrap-timepicker">
     <input type="time" class="form-control" name="martes_apertura" value="<?php echo $martes_e;?>">
   
   </div>
  
  
                  </div>
  
                  
                  <label class="col-sm-2 col-sm-2 control-label">Martes salida</label>
                    <div class="col-sm-2">
                
  
                    <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="martes_cierre" value="<?php echo $martes_ex;?>">
       
       </div>  
                    
                  </div>
  
  
                  </div>

                  

                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Miercoles Entrada </label>
                     <div class="col-sm-2"> 
    
                     
                     <?php
                      $miercoles_e = substr($miercoles_entrada, 0, -3);  // devuelve "abcde"
    
    
                      $miercoles_ex = substr($miercoles_salida, 0, -3);  
    
    
                      ?>
    
    
    
     
     <div class="input-group bootstrap-timepicker">
       <input type="time" class="form-control" name="miercoles_apertura" value="<?php echo $miercoles_e;?>">
     
     </div>
    
    
                    </div>
    
                    
                    <label class="col-sm-2 col-sm-2 control-label">Miercoles salida</label>
                      <div class="col-sm-2">
                  
    
                      <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="miercoles_cierre" value="<?php echo $miercoles_ex;?>">
       
       </div>    
                      
                    </div>
    
    
                    </div>

                    

                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">jueves entrada </label>
                       <div class="col-sm-2"> 
      
                       
                       <?php
                        $jueves_e = substr($jueves_entrada, 0, -3);  // devuelve "abcde"
      
      
                        $jueves_ex = substr($jueves_salida, 0, -3);  
      
      
                        ?>
      
      
      
       
       <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="jueves_apertura" value="<?php echo $jueves_e;?>">
       
       </div>
      
      
                      </div>
      
                      
                      <label class="col-sm-2 col-sm-2 control-label">Jueves salida</label>
                        <div class="col-sm-2">
                    
      
                        <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="jueves_cierre" value="<?php echo $jueves_ex;?>">
       
       </div>      
                        
                      </div>
      
      
                      </div>

                      
                      <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Viernes Entrada </label>
                         <div class="col-sm-2"> 
        
                         
                         <?php
                          $viernese = substr($viernes_entrada, 0, -3);  // devuelve "abcde"
        
        
                          $viernes_ex = substr($viernes_salida, 0, -3);  
        
        
                          ?>
        
        
        
         
        <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="viernes_apertura" value="<?php echo $viernese;?>">
       
       </div>
        
        
                        </div>
        
                        
                        <label class="col-sm-2 col-sm-2 control-label">Viernes salida</label>
                          <div class="col-sm-2">
                      
        
                          <div class="input-group bootstrap-timepicker">
         <input type="time" class="form-control" name="viernes_cierre" value="<?php echo $viernes_ex;?>">
       
       </div>        
                          
                        </div>
        
        
                        </div>


                        <h4><i class="fa fa-calendar-o"></i> Horarios de Fin de Semana (Sino la ofrece dejar en 12:00 am ambos)</h4>







<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Sabado Entrada </label>
 <div class="col-sm-2"> 

 
 <?php
  $sabadoe = substr($sabado_entrada, 0, -3);  // devuelve "abcde"


  $sabadoex = substr($sabado_salida, 0, -3);  


  ?>




<div class="input-group bootstrap-timepicker">
<input type="time" class="form-control" name="sabado_apertura"  value="<?php echo $sabadoe;?>">

</div>


</div>


<label class="col-sm-2 col-sm-2 control-label">Sabado salida</label>
  <div class="col-sm-2">


  <div class="input-group bootstrap-timepicker">
<input type="time" class="form-control" name="sabado_cierre"  value="<?php echo $sabadoex;?>">

</div>
  
</div>


</div>



                        <!--------------------------------->  





<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Domingo Entrada </label>
 <div class="col-sm-2"> 

 
 <?php
  $domingoe = substr($domingo_entrada, 0, -3);  // devuelve "abcde"


  $domingoex = substr($domingo_salida, 0, -3);  


  ?>




<div class="input-group bootstrap-timepicker">
<input type="time" class="form-control" name="domingo_apertura"  value="<?php echo $domingoe;?>">

</div>


</div>


<label class="col-sm-2 col-sm-2 control-label">Domingo salida</label>
  <div class="col-sm-2">


  <div class="input-group bootstrap-timepicker">
<input type="time" class="form-control" name="domingo_cierre"  value="<?php echo $domingoex;?>">

</div>
  
</div>


</div>


<!-------------S-------->


<input type="hidden" name="id_parqueo" value=<?php echo $id_parqueo;?>>










          




               


            

        
             


        

                <div class=" add-task-row">



          

<button type="submit" class="btn btn-success">Guardar Cambios</button>





<a class="btn btn-danger pull-right" href="Detalles_Parqueo.php">Cancelar</a>



                </div>
            

            

               


               </form>
        

           
              </div>
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
