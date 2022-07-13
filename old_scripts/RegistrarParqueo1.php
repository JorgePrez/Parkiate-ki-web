
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
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js"></script>
  <script src="lib/chart-master/Chart.js"></script>

  <style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>

 
</head>

<body>


<style type="text/css">
#info {
display: table;
position: relative;
margin: 0px auto;
word-wrap: anywhere;
white-space: pre-wrap;
padding: 10px;
border: none;
border-radius: 3px;
font-size: 12px;
text-align: center;
color: #222;
background: #fff;
}
</style>

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
            <a class="active" href="RegistrarParqueo1.php">
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
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Registrar Parqueo</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Datos Principales </h4>
              <form class="form-horizontal style-form" method="get" action="RegistrarParqueo2.php">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nombre Registrado:</label>
                  <div class="col-sm-8">
                    <input type="text" name="nombre_empresa" placeholder="Introduzca el nombre oficial registrado" class="form-control">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Dirección:</label>
                  <div class="col-sm-8"> 
                    <input type="text" name="direccion" placeholder="Introduzca la dirección donde se ubica el parqueo" class="form-control">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Capacidad Máxima:</label>
                  <div class="col-sm-1">
                  

                    <input type="number" name="capacidad_maxima" class="form-control" value=1>
                  </div>
                </div>



          

                <h4 class="mb"><i class="fa fa-angle-right"></i> Registrar tarifas (Sino la ofrece dejar en 0 el valor ) </h4>
            <!--  <form class="form-horizontal style-form" method="get"> -->
       
               
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">1/2 hora: (Q)</label>
                  <div class="col-sm-1">
                    <input type="number" class="form-control" name="media_hora" value=0>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Hora: (Q) </label>
                  <div class="col-sm-1">
                    <input type="number" class="form-control" name="hora" value=0>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Día:</label>
                  <div class="col-sm-1">
                    <input type="number" class="form-control" name="dia" value=0>
                  </div>
                </div>

                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Mes:</label>
                  <div class="col-sm-1">
                    <input type="number" class="form-control"  name="mes" value=0>
                  </div>
                </div>


                <h4 class="mb"><i class="fa fa-angle-right"></i> Lunes </h4>



                <div class="form-group">
                  
                  <label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

                  <div class="col-sm-1">
 
                    <div class="input-group bootstrap-timepicker">
                      <input type="time" class="form-control" name="lunes_apertura" value="00:00">
                    
                    </div>
                  </div>
                </div>
        
                  <div class="form-group">
                       
                  <label class="col-sm-2 col-sm-2 control-label">Horario de Cierre:</label>

                  <div class="col-sm-1">
                      <div class="input-group bootstrap-timepicker">
                        <input type="time" class="form-control" name="lunes_cierre" value="00:00">
                        
                      </div>
                    </div>
                  </div>

                  <h4 class="mb"><i class="fa fa-angle-right"></i> Martes </h4>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
    <div class="input-group bootstrap-timepicker">
      <input type="time" class="form-control" name="martes_apertura" value="00:00">
    
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">>
      <div class="input-group bootstrap-timepicker">
        <input type="time" class="form-control" name="martes_cierre" value="00:00">
        
      </div>
    </div>
  </div>



  <h4 class="mb"><i class="fa fa-angle-right"></i> Miercoles </h4>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
    <div class="input-group bootstrap-timepicker">
      <input type="time" class="form-control" name="miercoles_apertura" value="00:00">
    
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">
      <div class="input-group bootstrap-timepicker">
        <input type="time" class="form-control" name="miercoles_cierre" value="00:00">
        
      </div>
    </div>
  </div>


  <h4 class="mb"><i class="fa fa-angle-right"></i> Jueves </h4>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
    <div class="input-group bootstrap-timepicker">
      <input type="time" class="form-control" name="jueves_apertura" value="00:00">
    
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">
      <div class="input-group bootstrap-timepicker">
        <input type="time" class="form-control" name="jueves_cierre" value="00:00">
        
      </div>
    </div>
  </div>


  <h4 class="mb"><i class="fa fa-angle-right"></i> Viernes </h4>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
    <div class="input-group bootstrap-timepicker">
      <input type="time" class="form-control" name="viernes_apertura" value="00:00">
    
    </div>
  </div>
</div>

  <div class="form-group">
  <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">
      <div class="input-group bootstrap-timepicker">
        <input type="time" class="form-control" name="viernes_cierre" value="00:00">
        
      </div>
    </div>
  </div>



  
  <h4 class="mb"><i class="fa fa-angle-right"></i> Sabado (Sino la ofrece dejar en 12:00 am ambos) </h4>
             
             <div class="form-group">
             <label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
               <div class="input-group bootstrap-timepicker">
                      <input type="time" class="form-control" name="sabado_apertura" value="00:00">
                      
                    </div>
                      
               </div>
             </div>
     
               <div class="form-group">
               <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">
                 <div class="input-group bootstrap-timepicker">
                      <input type="time" class="form-control" name="sabado_cierre" value="00:00" >
                      
                    </div>
                 </div>
               </div>



                  <h4 class="mb"><i class="fa fa-angle-right"></i> Domingo (Sino la ofrece dejar en 12:00 am ambos) </h4>
             
               <div class="form-group">
               <label class="col-sm-2 col-sm-2 control-label">Horario de apertura:</label>

<div class="col-sm-1">
                 <div class="input-group bootstrap-timepicker">
                        <input type="time" class="form-control" name="domingo_apertura" value="00:00">
                        
                      </div>
                        
                 </div>
               </div>
       
                 <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">Horario de cierre:</label>

<div class="col-sm-1">
                   <div class="input-group bootstrap-timepicker">
                        <input type="time" class="form-control" name="domingo_cierre" value="00:00" >
                        
                      </div>
                   </div>
                 </div>


          

                 <div class="showback">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"> 
                      Agregar Ubicación del parqueo</button>
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

  <script>
  mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZ2VwcmV6IiwiYSI6ImNrdmNwM3JybzBjYXoyb21sNHByYXRieTcifQ.bH-U8gRuDNY_JAAMMCr19A';
const map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v11',
center: [-90.51053, 14.63406], // starting position
zoom: 14//9 // starting zoom
});
 
map.on('style.load', function() {

map.on('click', function(e) {
  var coordinates = e.lngLat;

  new mapboxgl.Popup()
    .setLngLat(coordinates)
    .setHTML('Has seleccionado: <br/>' + coordinates)
    .addTo(map);


    document.getElementById('info').innerHTML =
    // e.point is the x, y coordinates of the mousemove event
    // relative to the top-left corner of the map.
   // JSON.stringify(e.point) +
   // '<br />' +
    // e.lngLat is the longitude, latitude geographical position of the event.
    JSON.stringify(e.lngLat.wrap()); 


 
});
});




</script>





</body>

</html>
