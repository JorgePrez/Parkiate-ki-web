
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
            <a href="escanearQR.php">
              <i class="fa fa-qrcode"></i>
              <span>Escanear QR de usuario</span>
              </a>
         
          </li>
        
                   </ul>
              <!-- sidebar menu end-->
            </div>
          </aside>


          <?php


 
$key = '';
$pattern = '1234567890ABCDEFGH123456789';
$max = strlen($pattern)-1;
for($i=0;$i < 6;$i++){
     $key .= $pattern[mt_rand(0,$max)]; 
    } 


  $id=$key; 
  $id_duenio=   $_COOKIE["id_usuario"];
 
 
  $nombre= $_GET['nombre_empresa'];
  $direccion= $_GET['direccion'];
  $capacidad_maxima = $_GET['capacidad_maxima'];


  $media_hora = $_GET['media_hora'];

  $hora = $_GET['hora'];

  $dia = $_GET['dia'];

  $mes = $_GET['mes'];


  $lunes_entrada=$_GET['lunes_apertura'];;

  $lunes_salida=$_GET['lunes_cierre'];;

  $domingo_entrada=$_GET['domingo_apertura'];;

  $domingo_salida=$_GET['domingo_cierre'];; 

  $detalles='Pendiente';
  $imagenes='Pendiente';
  $latitude=0;
  $longitude=0;

  $martes_entrada=$_GET['martes_apertura'];;
  $martes_salida=$_GET['martes_cierre'];;
  $miercoles_entrada=$_GET['miercoles_apertura'];;
  $miercoles_salida=$_GET['miercoles_cierre'];;
  $jueves_entrada=$_GET['jueves_apertura'];;
  $jueves_salida=$_GET['jueves_cierre'];;
  $viernes_entrada=$_GET['viernes_apertura'];;
  $viernes_salida=$_GET['viernes_cierre'];;
  $sabado_entrada=$_GET['sabado_apertura'];;
  $sabado_salida=$_GET['sabado_cierre'];;

  $control_pagos='Pendiente';


  // base de datols
          
$query = "Insert into parqueo values ('$id','$id_duenio','$nombre','$direccion','$capacidad_maxima','$media_hora','$hora','$dia','$mes','$lunes_entrada','$lunes_salida','$domingo_entrada','$domingo_salida','$detalles','$imagenes','$latitude','$longitude','$martes_entrada','$martes_salida','$miercoles_entrada','$miercoles_salida','$jueves_entrada','$jueves_salida','$viernes_entrada','$viernes_salida','$sabado_entrada','$sabado_salida','$control_pagos')";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);

          
          
          
          
          ?>
           
          

    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Coordenadas de su parqueo (puede seleccionar en el mapa o introducir manualmente)  </h3>
        <!-- BASIC FORM ELELEMNTS -->


        <!-- /row -->
       
        <!-- /row -->
        <!-- INPUT MESSAGES -->
         
        <form action="RegistrarParqueo21.php" method="get">


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
           
          
 
          
                        
           
               <!-- <div class="checkbox">
                
                <input type="hidden" name="id_parqueo" value="/*<?php /*echo $key; */?>*/">
                <label>
                    <input type="checkbox" name="banios" value="1">
                     .        
                    </label>
                </div> -->



            

                <h4 class="mb"><i class="fa fa-angle-right"></i> Ubicación Geógrafica </h4>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Latitud:</label>
                  <div class="col-sm-1">
                  <input type="text" name="latitude" id="latitude" class="form-control">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">                Longitud:</label>
                  <div class="col-sm-1"> 
                  <input type="text" name="longitude" id="longitude" class="form-control">
                  </div>




                <!-- ////////////////////////////////////// -->

                

         
              <div class="checkbox">
                
              <input type="hidden" name="id_parqueo" value="<?php echo $key; ?>">
              
              </div>

   

              
       

          

             

              

              <div id="map"></div>

              <pre id="info"></pre> 

           


              

              <div class="showback">

            

                    <button class="btn btn-primary btn-lg btn-block" type="submit"> 
                      Siguiente</button>
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

    var longitude=-90.51053;
    
    var latitude=14.63406

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 

    latitude = position.coords.latitude;
    longitude =  position.coords.longitude; 
  }


  mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZ2VwcmV6IiwiYSI6ImNrdmNwM3JybzBjYXoyb21sNHByYXRieTcifQ.bH-U8gRuDNY_JAAMMCr19A';
const map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v11',
center: [longitude, latitude], // starting position , longitude, latitude
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
