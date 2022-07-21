<?php


/*

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}


if(!isset($_COOKIE["id_usuario"])){
  header("Location: login.html");

}



else{    
  $id_usuario= $_COOKIE["id_usuario"];

}  */






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
<a href="Detalles_Parqueo.php">
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
              <span>Flujo de autos(placas)</span>
              </a>
            <ul class="sub">
            <li><a href="entrada.php">Registro de Autos Entrada</a></li>
              <li><a href="salida.php">Registro de Autos Salida</a></li>
              <li><a href="flujo_autos.php">Entrada y Salida por Placa</a></li>
              <li><a href="autos.php">Registro por auto</a></li>
            </ul>
          </li>

          
<li class="mt">
<a class="active">
  <i class="fa fa-external-link"></i>
  <span>Registro de Servicios(App)</span>
  </a>

</li>



<li class="mt">
<a href="RegistrarParqueo1.php">
  <i class="fa fa-book"></i>
  <span>Reservas</span>
  </a>

</li>



    


        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
 
    <!--sidebar end-->
     <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

      <h3><i class="fa fa-angle-right"></i> Tabla de Servicios</h3>


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
                      <th>Id Servicio</th>

                      <th>Nombre</th>
                     <!-- <th>Prospectos</th> -->
                     <th>Telefono</th>
                     <th>Modelo Auto</th>
                     <th>No. Placa</th>


                     <!--Id servicio, nombre, telefono, modelo_auto,fecha,estado, detalles  -->  

                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Detalles</th>

                
                    

                      </tr>
                    </thead>

                    <tbody>
    
                      <?php
                      
                      $id_parqueo=$_COOKIE["id_parqueo"];



                    //   $query = "select * from servicios_admin where Id_parqueo='$id_parqueo' order by Id DESC";   
                       $query = "select * from servicios_admin where Id_parqueo='$id_parqueo' order by id DESC ";   

                       //                       $query = "select * from prospectos_template";



                       $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                       $id_servicio='';
                       $id_parqueo='';
                       $direccion = '';
                       $nombre_parqueo= '';
                       $imagenes='';
                       $id_usuario = '';
                       $nombre_usuario = ''; 
                       $telefono='';
                       $modelo_auto='';
                       $placa_auto='';
                       $fecha='';
                       $hora_deentrada='';
                       $hora_desalida='';
                       $precio='';
                       $parqueo_control_pagos='';
                       $media_hora='';
                       $hora='';


                                  
                      
    
                      while ($row = pg_fetch_row($result)) {
                        $id_servicio=$row[1];
                        $id_parqueo=$row[2];
                        $direccion = $row[3];
                        $nombre_parqueo= $row[4];
                        $imagenes=$row[5];
                        $id_usuario = $row[6];
                        $nombre_usuario = $row[7]; 
                        $telefono=$row[8];
                        $modelo_auto=$row[9];
                        $placa_auto=$row[10];
                        $fecha=$row[11];
                        $hora_deentrada=$row[12];
                        $hora_desalida=$row[13];
                        $precio=$row[14];
                        $parqueo_control_pagos=$row[15];
                        $media_hora=$row[16];
                        $hora=$row[17];
    
    
    
                    echo	"<tr class='gradeA'>";




                    echo	"<td>$id_servicio</td>";
                    echo	"<td>$nombre_usuario</td>";
                    echo	"<td>$telefono</td>";
                     echo	"<td>$modelo_auto</td>";
                     echo	"<td>$placa_auto</td>";

           echo	"<td>$fecha</td>";

    //        echo	"<td>$precio</td>";

                      
                   $comparador="Por Definir";
                    
                    if($precio== $comparador){

                      echo "<td><p> <font color=red>En Proceso</font> </p> </td>";
                      echo "<td><a href=Detalles_Servicio.php?id_parqueo=$id_parqueo&id_servicio=$id_servicio>Ver Detalles </a></td>\n";                  

                    }
                    else {

                      echo "<td><p> <font color=green>Finalizado</font> </p> </td>";
                      echo "<td><a href=Detalles_Serviciofinalizado.php?id_parqueo=$id_parqueo&id_servicio=$id_servicio>Ver Detalles </a></td>\n";                  

                      
                    }  

    
                 


                            
                    echo	"</tr>";
                
                      
                    }
                    ?>
    
                    </tbody>
                  </table>
    
               
    
    
                  <?php
                  pg_free_result($result);
                  pg_close($conn);
                  ?>

           

            </div>

            <div class="span6">


                  
                  <a href="MisServicios.php?id_parqueo=<?php echo $id_parqueo ?>" class="btn btn-compose">
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
