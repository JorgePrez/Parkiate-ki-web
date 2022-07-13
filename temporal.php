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

<?php
//Crea la cola
  $queue= new SplQueue();

  //Añade elementos
  $queue->enqueue('1');
  $queue->enqueue('2');
  $queue->enqueue('3');

  //Muestra el número de elementos de la cola(3)
  echo $queue->count();

  //Situa el puntero al principio de la cola
  $queue->rewind();

  //Muestra los elementos (1, 2, 3)
  while( $queue->valid() )
  {
    echo $queue->current(), PHP_EOL;
    $queue->next();
  }

   //Saca de la cola el primer elemento y lo muestra
    echo $queue->dequeue();

  //Situa el puntero al principio de la cola
   $queue->rewind();

   //Muestra el número de elementos de la cola(2)
    echo $queue->count();

  //Muestra los elementos (2, 3)
   while( $queue->valid() )
   {
    echo $queue->current(), PHP_EOL;
    $queue->next();
   }

   
?>
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
                      20%
                    </div>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->
            

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
                      20%
                    </div>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->



              <div class="grey-panel pn donut-chart">
              <div class="grey-panel pn donut-chart">
              <div class="grey-panel pn donut-chart">
              <div class="grey-panel pn donut-chart">







              ////////////////////////


              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn">
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
                                    <p>$fecha</p>

                  <footer>
                    <div class="pull-left">
                      <h5><i class="fa fa-hdd-o"></i> 1/5</h5>
                    </div>
                    <div class="pull-right">
                      <h5>60% Ocupardo</h5>
                    </div>
                  </footer>
            
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->
