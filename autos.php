
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
  <link href="lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/jquery/jquery.min.js"></script>


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
 
    <!--sidebar end-->
     <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
     <!--main content start-->
     <section id="main-content">
      <section class="wrapper">

      <h3><i class="fa fa-truck"></i> Registro por autos
      </h3>
     

      <div class="row mb">
          <!-- page start-->
          <div class="content-panel">

      


            <div class="adv-table">
      <!--       <span class="label label-info">Semana pasadasasa</span>
              <span class="label label-danger">Semana actual</span>
              -->

      

            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">

<!--     <div class="row-fluid"><div class="span6"><div class="dataTables_info" id="hidden-table-info_info">Enseñando 1 a 10 entradas</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Anterior</a></li><li class="active">
       <a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next">
         <a href="#">Siguiente  → </a></li></ul></div></div></div></div>-->


         <thead>
           <tr>
    <!--        <th>ID</th> -->

           <?php

 echo "<th style='display:none;'>ID</th>"; 
 echo "<th style='display:none;'>CASI ID</th>"; 
  ?>

            <th><b> Fecha de primera visita


             <th><b> Fecha de visita más reciente
    
           <th><b>Placa </b></th>



           <th><b>Número de visitas</b></th>
          <!-- <th>Prospectos</th> -->
          </b></th>

          <th><b> Foto en entrada (más reciente)
          </b></th>
          <th><b>Foto en salida (más reciente)</b></th>

          <th><b>Estado</b></th>


          <th><b>Ver registro de este auto</b></th>
          



           </tr>
         </thead>

         <tbody>

           <?php
           


           

         //   $query = "select * from servicios_admin where Id_parqueo='$id_parqueo' order by Id DESCASC";   
            $query = "select * from auto where id_parqueo='$id_parqueo' order BY fecha_registro_auto desc";   

            //                       $query = "select * from prospectos_template";



            $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
            $id_auto='';
            $placa='';
            $numero_visitas = '';
            $modelo_auto= '';
            $foto_delante='';
            $foto_atras = '';
            $id_usuario_app = ''; 
            $fecha_registro_auto='';
            $contador = 0;

            

          


                       
           

           while ($row = pg_fetch_row($result)) {

              
            $id_auto=$row[0];
            $placa=$row[1];
            $numero_visitas = $row[2];
            $foto_delante=$row[3];
            $foto_atras = $row[4];
            $id_usuario_app = $row[6]; 
            $fecha_registro_auto=$row[7];
            $contador = $contador+1;





$querinterno = "select hora_deteccion_entrada,dentro_fuera from placas_entrada where hora_deteccion_entrada =(select max(hora_deteccion_entrada) from placas_entrada WHERE id_parqueo='$id_parqueo' AND (deteccion_entrada = '$placa') )";



            $resultinterno = pg_query($conn, $querinterno) or die('ERROR : ' . pg_last_error());
            $hora_deteccion_entrada='';
            $dentro_fuera='';
        
            

           while ($row = pg_fetch_row($resultinterno)) {

            $hora_deteccion_entrada=$row[0];
            $dentro_fuera=$row[1];
      
           }


   /*
                 echo	"<tr class='gradeC'>";

   */ 
  if ($dentro_fuera=='F') {

    
              echo	"<tr class='gradeC'>";
  }
  else{
    echo	"<tr class='gradeX'>";
  }            

            

      /*   echo	"<tr class='gradeA'>";*/
      


      


      echo	"<td style='display:none;'>$id_auto</td>";

      echo	"<td style='display:none;'>$contador</td>";



      $separada = explode(' ',  $fecha_registro_auto);

      $separada2 = explode('-', $separada[0]);

      $separada3 = explode(':', $separada[1]);

      $hora_min1 = $separada3[0]. ':'.$separada3[1];

    $fecha_formato1 = $separada2[2].' / '.$separada2[1].' / '.$separada2[0];
      


        /* echo	"<td>$hora_deteccion_entrada</td>";*/

        $separada = explode(' ', $hora_deteccion_entrada);

        $separada2 = explode('-', $separada[0]);

        $separada3 = explode(':', $separada[1]);

        $hora_min2 = $separada3[0]. ':'.$separada3[1];

      $fecha_formato2 = $separada2[2].' / '.$separada2[1].' / '.$separada2[0];



        

echo	"<td>
<h4> <span class='label label-info'>


$fecha_formato1
</span>

</h4>

</td>";

echo	"<td>
         <h4> <span class='label label-warning'>
         
 $fecha_formato2
        </span>
  
        </h4>

        </td>";

        //comprobando si hubo correción , si lo hubo mostrar esa.

         echo	"<td>

        <h4> <span class='label label-default'>  
        $placa
               </span>
               </h4>
        
        
        </td>";
       
     
      


       if ($numero_visitas>0) {

        
        echo	"<td>
        <h4> <span class='label label-primary'>
        
       $numero_visitas

       </span>
  

      
       </h4>

       </td>";

       
      }else {
       
        echo	"<td>
        <h4> <span class='label label-danger'>
        
   Haciendo primera visita ahora

       </span>
 


       </h4>


       </td>";
      }
    

      ?>


     
     <?php 





/*           <img src=$foto_auto_entrada  width='100px' height='100px' alt=''>
          <img style='max-width: 60px; height: auto;'  src=$completo_entrada />

          <a class='fancybox' href=$foto_auto_entrada><img style='max-width: 75px; height: auto; src=$foto_auto_entrada alt=''></a>     

 */
          
echo	"<td> 
<a class='fancybox' href=$foto_delante><img class='img-responsive' src=$foto_delante width='75px' height='auto' alt=''></a>

</td>";

if($foto_atras!='Pendiente')
 echo	"<td> 
          <a class='fancybox' href=$foto_atras><img class='img-responsive' src=$foto_atras width='75px' height='auto' alt=''></a>
   
          </td>";

          else{
            echo	"<td>
            <h4> <span class='label label-warning'>
            
             No disponible
    
           </span>
      
    
          
           </h4>
    
           </td>";


          }


          if ($dentro_fuera=='D') {

    
            echo	"<td>
            <h4> <span class='label label-danger'>
            
     Se encuentra en parqueo
    
           </span>
      
    
          
           </h4>
    
           </td>";
  
  
           echo	"<td>";
  }
else{
  echo	"<td>
  <h4> <span class='label label-success'>
  
  No se encuentra en parqueo

 </span>



 </h4>

 </td>";


 echo	"<td>";
}    

 

         
        
echo'<form action="registro_auto.php" method="get">


<input type="hidden" name="id_auto" value=';

echo $id_auto;




echo '><button class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></button>

 </form> ';

         
        
        
 echo	"</td>";
        

 





                 
         echo	"</tr>";
     

         }
         ?>

         </tbody>
       </table>
    
               
    
    
                  <?php
                  pg_free_result($result);
               /*   pg_free_result($result2);

               */
                 pg_close($conn);
                  ?>

           

            </div>


        
          

               

                          
              


          <!-- page end-->
        </div>
        <!-- /row -->

              


        <div class="showback">
              <div class="btn-group btn-group-justified">
                <div class="btn-group">
                  



                <form action="salida.php" method="get">


             <!--    <input type="hidden" name="id_parqueo" value=
                
                "<?php 
                /*$id_parqueo=$_GET["id_parqueo"];
                echo $id_parqueo;*/ ?>">

-->

                  <button type="submit" class="btn btn-theme"><i class="fa fa-refresh"></i> Actualizar </button>

                  </form>
                </div>

                
           
                <div class="btn-group">

                <form action="index.php">

                  <button type="submit" class="btn btn-theme03"><i class="fa fa-dashboard"></i> Ir a Dashboard </button>

                  
                  </form>
                </div>
              </div>
            </div>

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

            <script src="lib/fancybox/jquery.fancybox.js"></script>
 <!--  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> -->   <!-- QUITE ESTA-->


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
    $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });
  </script>
  
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

     /* $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });*/
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
      
    });
  </script>
</body>

</html>
