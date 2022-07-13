
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



         $id_parqueo = $_GET['id_parqueo'];
        $latitude=$_GET['latitude'];;
        $longitude=$_GET['longitude'];

        $query= "UPDATE parqueo SET latitude=$latitude, longitude=$longitude WHERE id_parqueo = '$id_parqueo'";
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
        <h3><i class="fa fa-angle-right"></i> Agregar cáracteristicas adicionales de su parqueo  </h3>
        <!-- BASIC FORM ELELEMNTS -->


        <!-- /row -->
       
        <!-- /row -->
        <!-- INPUT MESSAGES -->
         
        <form action="RegistrarParqueo3.php" method="get">


        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">



         
     
   








                <!-- ////////////////////////////////////// -->

                <h4 class="mb"><i class="fa fa-angle-right"></i> Estas conseguirán que su parqueo sea más atractivo para clientes potenciales</h4>

                <div class="form-group">

         
              <div class="checkbox">
                
              <input type="hidden" name="id_parqueo" value="<?php echo $id_parqueo; ?>">
              <label>
                  <input type="checkbox" name="banios" value="1">
                   Baños          
                  </label>
              </div>

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="bajotecho" value="2">
                  Bajo techo
                  </label>
              </div>

              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="asfalto" value="3">
                  Asfalto
                  </label>
              </div>

              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="seguridad" value="4">
                  Seguridad privada
                  </label>
              </div>

              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="furgoneta" value="5">
                  Espacio para Furgoneta o camión
                             </label>
              </div>

              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="lavado" value="6">
                  Lavado de autos
                  </label>
              </div>

              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ilumina" value="7">
                  Iluminado 
                  </label>
              </div>


              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="puerta" value="8">
                  Puerta de seguridad 
                  </label>
              </div>


              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="discapacitados" value="9">
                  Apto para discapacitados
                  </label>
              </div>


              
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="obstaculos" value="A">
                  Cámara de Seguridad
                  </label>
              </div>


             
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="amplioespacio" value="B">
                  Amplio Espacio
                  </label>
              </div> 

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="sotano" value="C">
                  Sótano
                  </label>
              </div> 


              <div class="checkbox">
                <label>
                  <input type="checkbox" name="vallet" value="D">
                  Pago con Tarjeta
                  </label>
              </div> 
              </div>

              <hr>

              <h4 class="mb"><i class="fa fa-angle-right"></i> ¿Desea que la app se encargue de los cobros o usará su propio sistema?</h4>
          

              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="S" checked>
                  Si, deseo que la app se encargue de calcular el tiempo y le diga al usuario cuando debe pagar
                  </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="N">
                  No, usaré mi propio sistema para cobrar, solo deseo que la app guíe al usuario a mi parqueo
                  </label>
              </div>
              <hr>

           



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
  mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZ2VwcmV6IiwiYSI6ImNrdmNwM3JybzBjYXoyb21sNHByYXRieTcifQ.bH-U8gRuDNY_JAAMMCr19A';
const map = new mapboxgl.Map({
container: 'map', // container id
style: 'mapbox://styles/mapbox/streets-v11',
center: [-90.53408, 14.58206], // starting position
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
