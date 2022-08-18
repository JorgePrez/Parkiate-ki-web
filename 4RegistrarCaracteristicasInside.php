
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
        
      
        <li class="mt">
<a class="active" >
  <i class="fa fa-columns"></i>
  <span>Registrar mi parqueo</span>
  </a>

</li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
              
    <?php

$id_parqueo=$_GET["id_parqueo"];


?>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
      <h3><i class="fa fa-columns"></i> Agrega la información de tu parqueo </h3>
  
        





        <form action="formularios/editarcaracteristicas_crear.php" method="get">


        <input type="hidden" name="id_parqueo" value="<?php echo $id_parqueo; ?>">
  

          <!-- COMPLEX TO DO LIST -->
          <div class="row mt mb">
          <div class="col-md-12">
            <section class="task-panel tasks-widget">
              <div class="panel-heading">
                <div class="pull-left">
                  <h4><i class="fa fa-tasks"></i> Editar Características del parqueo</h4>
                </div>
                <br>
              </div>
              <div class="panel-body">
                <div class="task-list">
                  <ul id="sortable" class="task-list">


 
                  <?php
             if (str_contains($detalles, '1')) {
    echo '
    
    
    <li class="list-primary">
    <i class=" fa fa-pause"></i>
    <div class="task-checkbox">
      


      <input type="checkbox" class="list-child" name="banios" value="1" checked>
    </div>
    <div class="task-title">


      <span class="task-title-sp">         <b>  Baños </b>                </span>
 
    </div>
  </li>
  '
    
    
    ;
  
  
  
  } 

  else{



    echo '
    
    
    <li class="list-primary">
    <i class=" fa fa-pause"></i>
    <div class="task-checkbox">
      


      <input type="checkbox" class="list-child" name="banios" value="1">
    </div>
    <div class="task-title">


      <span class="task-title-sp">         <b>  Baños </b>                </span>
 
    </div>
  </li>
  '
    
    
    ;
  



  }


    if (str_contains($detalles, '2')) {
      echo ' 
      <li class="list-danger">
      <i class=" fa fa-home"></i>
      <div class="task-checkbox">
      <input type="checkbox" class="list-child" name="bajotecho" value="2" checked>
      </div>
      <div class="task-title">
        <span class="task-title-sp"> <b> Bajo Techo</b>     </span>
       
      </div>
    </li>';
    }
    
    else{

      echo '


      <li class="list-danger">
      <i class=" fa fa-home"></i>
      <div class="task-checkbox">
      <input type="checkbox" class="list-child" name="bajotecho" value="2">
      </div>
      <div class="task-title">
        <span class="task-title-sp"> <b> Bajo Techo</b>     </span>
       
      </div>
    </li>
      
      
      
      ';
    }


      if (str_contains($detalles, '3')) {

        echo '

        <li class="list-success">
        <i class=" fa fa-road"></i>
        <div class="task-checkbox">
        <input type="checkbox" class="list-child" name="asfalto" value="3" checked>
        </div>
        <div class="task-title">
          <span class="task-title-sp"><b>Asfaltado.</b> </span>
          
        </div>
      </li>
        
        
        ';
      } 

      else{

        echo '

        <li class="list-success">
        <i class=" fa fa-road"></i>
        <div class="task-checkbox">
        <input type="checkbox" class="list-child" name="asfalto" value="3">
        </div>
        <div class="task-title">
          <span class="task-title-sp"><b>Asfaltado.</b> </span>
          
        </div>
      </li>
        
        ';
      }


        if (str_contains($detalles, '4')) {

          echo '

          <li class="list-warning">
          <i class=" fa fa-eye"></i>
          <div class="task-checkbox">
          <input type="checkbox" class="list-child" name="seguridad" value="4" checked>
          </div>
          <div class="task-title">
            <span class="task-title-sp"><b> Seguridad Privada </b> </span>
           
          </div>
        </li>

          ';

        }else{

          echo '

          <li class="list-warning">
          <i class=" fa fa-eye"></i>
          <div class="task-checkbox">
          <input type="checkbox" class="list-child" name="seguridad" value="4">
          </div>
          <div class="task-title">
            <span class="task-title-sp"><b> Seguridad Privada </b> </span>
           
          </div>
        </li>

          ';
        } 


          if (str_contains($detalles, '5')) {

            echo '

            <li class="list-info">
                      <i class=" fa fa-truck"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="furgoneta" value="5" checked>
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Espacio para furgoneta o camión </b></span>
                       
                      </div>
                    </li>


            ';


          
          } else {

            echo '

            <li class="list-info">
                      <i class=" fa fa-truck"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="furgoneta" value="5">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Espacio para furgoneta o camión </b></span>
                       
                      </div>
                    </li>

            ';



          }

            if (str_contains($detalles, '6')) {

              echo '

              <li class="list-primary">
              <i class=" fa fa-eraser"></i>
              <div class="task-checkbox">
              <input type="checkbox" class="list-child" name="lavado" value="6" checked>
              </div>
              <div class="task-title">
                <span class="task-title-sp"><b> Lavado de Autos </b></span>
           
              </div>
            </li>

              ';

            
            
            }
            
            else {

              echo '

              <li class="list-primary">
              <i class=" fa fa-eraser"></i>
              <div class="task-checkbox">
              <input type="checkbox" class="list-child" name="lavado" value="6">
              </div>
              <div class="task-title">
                <span class="task-title-sp"><b> Lavado de Autos </b></span>
           
              </div>
            </li>
  
              ';
  
  
  
            }



              if (str_contains($detalles, '7')) {

                echo '

                <li class="list-primary">
                <i class=" fa fa-lightbulb-o"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="ilumina" value="7" checked>
                </div>
                <div class="task-title">
                  <span class="task-title-sp"><b> Iluminado </b> </span>
             
                </div>
              </li>

                ';
                
              } 


              else {

                echo '

                
                <li class="list-primary">
                <i class=" fa fa-lightbulb-o"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="ilumina" value="7">
                </div>
                <div class="task-title">
                  <span class="task-title-sp"><b> Iluminado </b> </span>
             
                </div>
              </li>
  
                ';


              }

                if (str_contains($detalles, '8')) {

                  
                echo '

                
                <li class="list-danger">
                <i class=" fa fa-shield"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="puerta" value="8" checked>
                </div>
                <div class="task-title">
                  <span class="task-title-sp"> <b> Puerta de Seguridad </b> </span>
                 
                </div>
              </li>

                ';


                } 

                 else {

                  echo '

                  
                  <li class="list-danger">
                  <i class=" fa fa-shield"></i>
                  <div class="task-checkbox">
                  <input type="checkbox" class="list-child" name="puerta" value="8">
                  </div>
                  <div class="task-title">
                    <span class="task-title-sp"> <b> Puerta de Seguridad </b> </span>
                   
                  </div>
                </li>
    
                  ';
  
  
                }

                  if (str_contains($detalles, '9')) {

                        
                echo '

                <li class="list-success">
                <i class=" fa fa-wheelchair"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="discapacitados" value="9" checked>
                </div>
                <div class="task-title">
                  <span class="task-title-sp"><b> Apto para discapacitados. </b> </span>
                  
                </div>
              </li>

                ';


                  } 

                  else {

                    echo '

                    <li class="list-success">
                    <i class=" fa fa-wheelchair"></i>
                    <div class="task-checkbox">
                    <input type="checkbox" class="list-child" name="discapacitados" value="9">
                    </div>
                    <div class="task-title">
                      <span class="task-title-sp"><b> Apto para discapacitados. </b> </span>
                      
                    </div>
                  </li>
      
                    ';
    
    
                  }

                    if (str_contains($detalles, 'A')) {

                          
                echo '

                <li class="list-warning">
                <i class=" fa fa-camera-retro"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="obstaculos" value="A" checked>
                </div>
                <div class="task-title">
                  <span class="task-title-sp"><b> Cámara de seguridad </b></span>
                 
                </div>
              </li>

                ';



                    }
                    
                    else {

                      echo '

                      <li class="list-warning">
                      <i class=" fa fa-camera-retro"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="obstaculos" value="A">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b> Cámara de seguridad </b></span>
                       
                      </div>
                    </li>
        
                      ';
      
      
                    }

                      if (str_contains($detalles, 'B')) {
        

                                     
                echo '

                <li class="list-info">
                <i class=" fa fa-expand"></i>
                <div class="task-checkbox">
                <input type="checkbox" class="list-child" name="amplioespacio" value="B" checked>
                </div>
                <div class="task-title">
                  <span class="task-title-sp"><b>Amplio Espacio  </b> </span>
                 
                </div>
              </li>

                ';


                      } 


                      else {

                        echo '

                        <li class="list-info">
                        <i class=" fa fa-expand"></i>
                        <div class="task-checkbox">
                        <input type="checkbox" class="list-child" name="amplioespacio" value="B">
                        </div>
                        <div class="task-title">
                          <span class="task-title-sp"><b>Amplio Espacio  </b> </span>
                         
                        </div>
                      </li>
          
                        ';
        
        
                      }





                        if (str_contains($detalles, 'C')) 
                        {
        

                                     
                          echo '

                          <li class="list-danger">
                          <i class=" fa fa-arrow-circle-down"></i>
                          <div class="task-checkbox">
                          <input type="checkbox" class="list-child" name="sotano" value="C" checked>
                          </div>
                          <div class="task-title">
                            <span class="task-title-sp"><b> Sótano </b> </span>
                           
                          </div>
                        </li>
          
                          ';
          
          
                                } 
          
          
                                else {
          
                                  echo '

                                  <li class="list-danger">
                                  <i class=" fa fa-arrow-circle-down"></i>
                                  <div class="task-checkbox">
                                  <input type="checkbox" class="list-child" name="sotano" value="C">
                                  </div>
                                  <div class="task-title">
                                    <span class="task-title-sp"><b> Sótano </b> </span>
                                   
                                  </div>
                                </li>
                    
                                  ';
                  
                  
                                }

                          if (str_contains($detalles, 'D')) 
                          {
        

                                     
                            echo '

                            <li class="list-success">
                      <i class=" fa fa-credit-card"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="vallet" value="D" checked>
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b>  Pago con tarjeta. </b> </span>
                        
                      </div>
                    </li>
            
                            ';
            
            
                                  } 
            
            
                                  else {
            
                                    echo '

                                    <li class="list-success">
                      <i class=" fa fa-credit-card"></i>
                      <div class="task-checkbox">
                      <input type="checkbox" class="list-child" name="vallet" value="D">
                      </div>
                      <div class="task-title">
                        <span class="task-title-sp"><b>  Pago con tarjeta. </b> </span>
                        
                      </div>
                    </li>
                      
                                    ';
                    
                    
                                  }



                            
                        
  ?>


                   
             
                  
                  </ul>
                </div>



          



          

<button type="submit" class="btn btn-success">Guardar Cambios</button>








                </div>

           
              </div>
            </section>
          </div>
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
