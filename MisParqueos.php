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
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

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
            <a  href="index.php">
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



          <!--
          <li class="mt">
            <a class="active" href="Slots.php">
              <i class="fa fa-table"></i>
              <span>Espacios (Slots)</span>
              </a>
          
          </li> -->

          <li class="mt">
            <a href="RegistrarParqueo1.php">
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
 
    <!--sidebar end-->
     <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

      <h3><i class="fa fa-angle-right"></i> Tabla de Parqueos</h3>


        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">

      

              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">

           <!--     <div class="row-fluid"><div class="span6"><div class="dataTables_info" id="hidden-table-info_info">Enseñando 1 a 10 entradas</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Anterior</a></li><li class="active">
                  <a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next">
                    <a href="#">Siguiente  → </a></li></ul></div></div></div></div>-->


                    <thead>
                      <tr>
                      <th>Id Parqueo</th>

                      <th>Nombre</th>
                     <!-- <th>Prospectos</th> -->
                     <th>Dirección</th>
                     <th>Capacidad Máxima</th>
                     <th>Espacios Utilizados</th>


                    <th>Tarifa 1/2 Hora (Q)</th>
                    <th>Tarfia Hora (Q)</th>
                    <th>Espacios</th>
                    
             
                    <th>Detalles</th>
                    <th>Estado</th>

                    

                      </tr>
                    </thead>

                    <tbody>
    
                      <?php
                      
                                                 /*Este parametro deberia estar guardado en el inicio de sesión*/ 


                       $query = "select * from parqueo where id_duenio='$id_usuario'";
                       //                       $query = "select * from prospectos_template";



                       $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                       $idparqueo='';
                       $nombreparqueo='';
                       $direccion  = '';
                       $capacidad= '';
                       $tarifa1='';
                       $tarifa2 = '';
                       $tarifa3 = ''; 
                       $tarifa4='';
                       $latitude='';
                       $longitud='';
           


                                  
                      
    
                      while ($row = pg_fetch_row($result)) {
                        $idparqueo=$row[0];
                        $nombreparqueo=$row[2];
                        $direccion= $row[3];
                        $capacidad= $row[4];
                        $tarifa1=$row[5];
                        $tarifa2=$row[6];
                        $tarifa3=$row[7];
                        $tarifa4=$row[8];
                        $latitude=$row[15];
                        $longitude=$row[16];

                        
                      $Pordefinir= 'Por Definir';

                        $query2 = "select Count(*) as espacios_ocupados  from servicios_admin where id_parqueo='$idparqueo' AND precio='$Pordefinir'";
                        //                       $query = "select * from prospectos_template";
 
 
 
                        $result2 = pg_query($conn, $query2) or die('ERROR : ' . pg_last_error());
                        $parkings=0;

                        while ($rowsito = pg_fetch_row($result2)) {
                          $parkings=$rowsito[0];

                        }
               
    
    
                    echo	"<tr class='gradeA'>";


                    echo	"<td>$idparqueo</td>";
                    echo	"<td>$nombreparqueo</td>";
                    echo	"<td>$direccion</td>";
                     echo	"<td>$capacidad</td>";
                     echo	"<td>$parkings</td>";


                    echo	"<td>$tarifa1</td>";
                    echo	"<td>$tarifa2</td>";


                    

              

              


/*
                    $time_from = strtotime($horario3);
                    $time_to = strtotime($horario4);


                      if($time_from == $time_to){
                     
                        echo	"<td>No disponible</td>";
                        echo	"<td>No disponible</td>";

                      }
                      else {
                        echo	"<td>$horario3</td>";
                        echo	"<td>$horario4</td>";
                        
                      }         */           
                 
                   
                     
                      echo "<td><a href=Slots.php?id_parqueo=$idparqueo>Estado </a></td>\n";     
 
                      
                    echo "<td><a href=Detalles_Parqueo.php?id_parqueo=$idparqueo>Ver detalles </a></td>\n";     
                    
                    echo "<td><a href=MisServicios.php?id_parqueo=$idparqueo>Ver servicios</a></td>\n";    
                    


                            
                    echo	"</tr>";
                
                      
                    }
                    ?>
    
                    </tbody>
                  </table>
    
               
    
    
                  <?php
                  pg_free_result($result);
                  pg_free_result($result2);
                  pg_close($conn);
                  ?>

           

            </div>


            <div class="span6">
                  
                  <a href="MisParqueos.php" class="btn btn-compose">
                 <!-- <a href="contactformprospecto.html" class="btn btn-compose">  -->

                  <i class="fa fa-pencil"></i> Actualizar</a>

                          
                  </div>

          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
   
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <!--
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/popper.min.js"></script>


  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
            -->

            <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>

  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
     /* var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });
         */
      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
       $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>
</body>

</html>
