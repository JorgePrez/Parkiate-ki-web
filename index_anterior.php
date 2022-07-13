
<?php


include 'database_cookie.php';

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
          if(strlen($id_parqueo) >1)
          {
            echo 'Parqueo la sexta';
          }
          else{
            echo 'Parece que no áun no has todos los detalles agregado tu parqueo, hazlo para poder ver todas nuestras opciones';

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
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row mt">
          <div class="col-lg-9 main-chart">
            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>BIENVENIDO A PARKIATE-KI ESTIMADO ADMINISTRADOR:</h3>
            </div>
           
            <div class="content-panel">
              <h4><i class="fa fa-angle-right"></i>  Servicios prestado por día 
              <span class="label label-info">Semana pasada</span>
              <span class="label label-danger">Semana actual</span>

            </h4>

              <div class="panel-body">
                <figure class="demo-xchart" id="chart"></figure>
              </div>
            </div>

            <!--custom chart end-->
            <div class="row mt">
              <!-- SERVER STATUS PANELS -->


              <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>ESTADO GENERAL</h5>
                  </div>
                  <canvas id="serverstatus02" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 60,
                        color: "#1c9ca7"
                      },
                      {
                        value: 40,
                        color: "#f68275"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
                  </script>
                  <p>23 de Marzo, 2022</p>
                  <footer>
                    <div class="pull-left">
                      <h5><i class="fa fa-hdd-o"></i> 30/50</h5>
                    </div>
                    <div class="pull-right">
                      <h5>60% Ocupado</h5>
                    </div>
                  </footer>
                </div>
                <!--  /darkblue panel -->
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">
                  <div id="spotify">

                  <div class="col-xs-4 col-xs-offset-8">
                      <button class="btn btn-sm btn-clear-g">VER DETALLES</button>
                    </div>
                 
                    <div class="sp-title">
                      <h3>
                      Placa:

                      <?php
        //  echo $nombrecompleto;

          
        $query3 = "select foto_auto_entrada,deteccion_entrada from placas_entrada where hora_deteccion_entrada = (select max(hora_deteccion_entrada) from placas_entrada) AND id_parqueo='2CE369'";
        //                       $query = "select * from prospectos_template";
        
        $resultadp1 = pg_query($conn, $query3) or die('ERROR : ' . pg_last_error());
        $foto_auto_entrada = '';
        $deteccion_entrada='';
        

        while ($row = pg_fetch_row($resultadp1)) {
        $foto_auto_entrada= $row[0];
        $deteccion_entrada=$row[1];
        }

        echo $deteccion_entrada;


        pg_free_result($resultadp1);


          ?>

                      </h3>
                    </div>
                  
                  </div>
                  <p class="followers"><i class="fa fa-arrow-right"></i>  Último auto en llegar
                 </p>
                </div>
              </div>

              
              <div class="col-lg-4 col-md-4 col-sm-4 mb">
                <div class="content-panel pn">
                  <div id="spotify2">

                  <div class="col-xs-4 col-xs-offset-8">
                      <button class="btn btn-sm btn-clear-g">VER DETALLES</button>
                    </div>
              
                    <div class="sp-title">
                      <h3> Placa:


                      <?php
        //  echo $nombrecompleto;

        $query3 = "select foto_auto_salida,deteccion_salida from placas_salida where hora_deteccion_salida = (select max(hora_deteccion_salida) from placas_salida) AND id_parqueo='2CE369'";
        //                       $query = "select * from prospectos_template";
        
        $resultadp = pg_query($conn, $query3) or die('ERROR : ' . pg_last_error());
        $foto_auto_salida = '';
        $deteccion_salida='';
        

        while ($row = pg_fetch_row($resultadp)) {
        $foto_auto_salida= $row[0];
        $deteccion_salida=$row[1];
        }



            echo $deteccion_salida;

          ?>

                      </h3>
                    </div>
                  
                  </div>
                  <p class="followers"><i class="fa fa-arrow-left"></i> Último auto en irse </p>
                </div>
              </div>
            
              
             
            </div>
            <!-- /row -->


             <!--custom chart end-->
          
             <div class="row mt">
              <!-- SERVER STATUS PANELS -->

              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>ESPACIOS PARA RESERVAS</h5>
                  </div>
                  <canvas id="serverstatus01" height="120" width="120"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 70,
                        color: "#FF6B6B"
                      },
                      {
                        value: 30,
                        color: "#fdfdfd"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
                  </script>
                  <div class="row">
                    <div class="col-sm-6 col-xs-6 goleft">
                      <p><br/>
                      <h5><i class="fa fa-hdd-o"></i> 2/10</h5>
                    </p>

                    </div>
                    <div class="col-sm-6 col-xs-6">
                      <h2>20%</h2>
                    </div>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->

               <!-- /col-md-4 -->
               <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="green-panel pn">
                  <div class="green-header">
                    <h5>INGRESOS</h5>
                  </div>
                  <div class="chart mt">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
                  </div>
                  <p class="mt"><b>Q 10,000</b><br/>Mes actual</p>
                </div>
              </div>
              <!-- /col-md-4 -->
            
            
            
           

               <!--  /col-md-4 -->
               <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>SITE STATICS</h5>
                  </div>
                  <h1 class="mt"><i class="fa fa-user fa-3x"></i></h1>
                  <p>+ 1,789 NEW VISITS</p>
                  <footer>
                    <div class="centered">
                      <h5><i class="fa fa-trophy"></i> 17,988</h5>
                    </div>
                  </footer>
                </div>
                <!--  /darkblue panel -->
              </div>
              <!-- /col-md-4 -->
              
            </div>
            <!-- /row -->
           
           
          
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
               *********************************************************************************************************************************************************** -->
           
               <div class="col-lg-3 ds"> 

                
                <!--COMPLETED ACTIONS DONUTS CHART
                <div class="donut-main">
                  <h4>COMPLETED ACTIONS & PROGRESS</h4>
                  <canvas id="newchart" height="130" width="130"></canvas>
                  <script>
                    var doughnutData = [{
                        value: 70,
                        color: "#4ECDC4"
                      },
                      {
                        value: 30,
                        color: "#fdfdfd"
                      }
                    ];
                    var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
                  </script>
                </div> -->
                <!--NEW EARNING STATS 
                <div class="panel terques-chart">
                  <div class="panel-body">
                    <div class="chart">
                      <div class="centered">
                        <span>TODAY EARNINGS</span>
                        <strong>$ 890,00 | 15%</strong>
                      </div>
                      <br>
                      <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                    </div>
                  </div>
                </div> -->
                <!--new earning end-->

                <h4 class="centered mt">Actvidad Reciente</h4>
                <!-- First Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Justo Ahora</muted>
                      <br/>
                      <a href="#"> Javier Escobar</a> llego al parqueo y comenzo su servicio.<br/>
                    </p>
                  </div>
                </div>
                <!-- Second Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 2 minutos </muted>
                      <br/>
                      <a href="#">Huening Bahiyyih</a> Realizo una reserva para el día 26/03.<br/>
                    </p>
                  </div>
                </div>
                <!-- Third Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 3 horas</muted>
                      <br/>
                      <a href="#">Jorge Pérez</a> Finalizo su servicio.<br/>
                    </p>
                  </div>
                </div>
                <!-- Fourth Activity -->
                <div class="desc">
                  <div class="thumb">
                    <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                  </div>
                  <div class="details">
                    <p>
                      <muted>Hace 1 día</muted>
                      <br/>
                      <a href="#">Jenson Button</a> Realizo una reserva para el día de mañana .<br/>
                    </p>
                  </div>
                </div>


            
             
                <!-- CALENDAR-->
                <div id="calendar" class="mb">
                  <div class="panel green-panel no-margin">
                    <div class="panel-body">
                      <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="disadding: none;"></h3>
                        <div id="date-popover-content" class="popover-content"></div>
                      </div>
                      <div id="my-calendar"></div>
                    </div>
                  </div>
                </div>
                <!-- / calendar -->
              </div>   


          <!-- /col-lg-3 -->
        </div>   
        <!-- /row -->
      </section>
    </section>
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
  <script src="lib/jquery.sparkline.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script>
  <script type="text/javascript" src="lib/gritter-conf.js"></script>
  <!--script for this page-->
  <script src="lib/sparkline-chart.js"></script>
  <script src="lib/zabuto_calendar.js"></script>

  <script src="lib/xchart/d3.v3.min.js"></script>
  <script src="lib/xchart/xcharts.min.js"></script>
  <script>
    (function() {
      var data = [{
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 15,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 11,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 10,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 1,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "line-dotted",
        "yScale": "linear"
      }, {
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "cumulative",
        "yScale": "linear"
      }, {
        "xScale": "ordinal",
        "comp": [],
        "main": [{
          "className": ".main.l1",
          "data": [{
            "y": 12,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 6,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 12,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }, {
          "className": ".main.l2",
          "data": [{
            "y": 29,
            "x": "2012-11-19T00:00:00"
          }, {
            "y": 33,
            "x": "2012-11-20T00:00:00"
          }, {
            "y": 13,
            "x": "2012-11-21T00:00:00"
          }, {
            "y": 16,
            "x": "2012-11-22T00:00:00"
          }, {
            "y": 7,
            "x": "2012-11-23T00:00:00"
          }, {
            "y": 18,
            "x": "2012-11-24T00:00:00"
          }, {
            "y": 8,
            "x": "2012-11-25T00:00:00"
          }]
        }],
        "type": "bar",
        "yScale": "linear"
      }];
      var order = [0, 1, 0, 2],
        i = 0,
        xFormat = d3.time.format('%A'),
        chart = new xChart('line-dotted', data[order[i]], '#chart', {
          axisPaddingTop: 5,
          dataFormatX: function(x) {
            return new Date(x);
          },
          tickFormatX: function(x) {
            return xFormat(x);
          },
          timing: 1250
        }),
        rotateTimer,
        toggles = d3.selectAll('.multi button'),
        t = 3500;

      function updateChart(i) {
        var d = data[i];
        chart.setData(d);
        toggles.classed('toggled', function() {
          return (d3.select(this).attr('data-type') === d.type);
        });
        return d;
      }

      toggles.on('click', function(d, i) {
        clearTimeout(rotateTimer);
        updateChart(i);
      });

      function rotateChart() {
        i += 1;
        i = (i >= order.length) ? 0 : i;
        var d = updateChart(order[i]);
        rotateTimer = setTimeout(rotateChart, t);
      }
      rotateTimer = setTimeout(rotateChart, t);
    }());
  </script>



  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Bienvenido a Parkiate-ki estimado usuario administrador:',
        // (string | mandatory) the text inside the notification
        text: 'Estamos aquí para servirle en lo que necesite',
        // (string | optional) the image to display on the left
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script>
  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  </script>
</body>

</html>
