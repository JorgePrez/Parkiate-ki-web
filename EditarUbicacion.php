
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
  <!-- Favicons -->


  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.0/mapbox-gl.js"></script>

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

    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        
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



$query = "select latitude,longitude from parqueo where id_parqueo='$id_parqueo'";



$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());

$latitude='';
$longitude='';

           


while ($row = pg_fetch_row($result)) {

        $latitude=$row[0];
        $longitude=$row[1];
  

}
 


          
          
          
          
          ?>
           
          

    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Editar las coordenadas de su parqueo (puede seleccionar en el mapa o introducir manualmente)  </h3>
        <!-- BASIC FORM ELELEMNTS -->


        <!-- /row -->
       
        <!-- /row -->
        <!-- INPUT MESSAGES -->
         
        <form action="formularios/editarubicacion.php" method="get">


        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> </h4>



                 <br>
           <br>
           <br>

           <br>
           <br>
           <br>

           <br>
           <br>
           <br>

           <br>
           <br>
           <br>

           <br>
           <br>
           <br>

           
           <br>
           <br>
           <br>

          
           <br>
           <br>
           
          
 
          
                        
           
        <div class="checkbox">
                
                <input type="hidden" name="id_parqueo" value="<?php echo $id_parqueo; ?>">
         
                </div> 



            

                <h4 class="mb"><i class="fa fa-angle-right"></i> Ubicación Geógrafica </h4>
                <div class="form-group">
                  <label class="col-sm-3 col-sm-3 control-label">Latitud:</label>
                  <div class="col-sm-3">
                  <input type="text" name="latitude" id="latitude" class="form-control" value=<?php echo $latitude;?>>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-3 col-sm-3 control-label">                Longitud:</label>
                  <div class="col-sm-3"> 
                  <input type="text" name="longitude" id="longitude" class="form-control" value=<?php echo $longitude;?>>
                  </div>



                  <div class="form-group">
                 
<button type="submit" class="btn btn-success">Guardar Cambios</button>











                <!-- ////////////////////////////////////// -->

                

     
   

              
       

          

             

              

              <div id="map"></div>

             <pre id="info"></pre> 


              <div class=" add-task-row">



          




                </div>

           


              









           
              </form>

    
            
       
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
          <!-- CUSTOM TOGGLES -->
          
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
  <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
  <script src="js/servicio-imagen.js"></script>
  <script src="lib/form-component.js"></script>

  <script>
  mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZ2VwcmV6IiwiYSI6ImNrdmNwM3JybzBjYXoyb21sNHByYXRieTcifQ.bH-U8gRuDNY_JAAMMCr19A';
const map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v11',
center: [<?php echo $longitude;?>, <?php echo $latitude;?>], // starting position
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
    

    const ll = e.lngLat;

    const wrapped = ll.wrap();
     

    var longitud = wrapped.lng;

    var latitud =wrapped.lat;
    
    var longitud_string = longitud.toFixed(5);

    var latitud_string = latitud.toFixed(5);



   //ll.toArray(); // = [-73.9749, 40.7736]

    
    

 

    var inputF = document.getElementById("latitude");

    
    inputF.setAttribute('value', latitud_string);


    var inputF2 = document.getElementById("longitude");

    
inputF2.setAttribute('value', longitud_string);








    


 
});
});




</script>

</body>

</html>
