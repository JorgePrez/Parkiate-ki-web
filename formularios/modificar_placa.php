
<?php

  $id_placa_corr =  $_GET['id_placa_corr']; // 'E158A10F';   

$placa_corr1=  $_GET['placa_corr'];    //'A323ERP';  //$_GET['placa_corr'];


$searchString = " ";
$replaceString = "";
 
$placa_corr= str_replace($searchString, $replaceString, $placa_corr1); 

$id_parqueo= $_COOKIE["id_parqueo"]; // $_COOKIE["id_parqueo"]; // '78FFFE';  

$antigua_placa=$_GET['placa_antigua']; //  'A453BSV'; //$_GET['placa_antigua'];

$id_placa_entrada=$id_placa_corr;


$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
  die("PostgreSQL connection failed");
 }





$query = "select * from placas_entrada_salida where id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";

   $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
   $id_deteccion_entrada='';$id_deteccion_salida='';$id_auto='';$id_parqueo='';
   $id_servicio_app='';$tiempo_total='';$deteccion_entrada_salida='';$existe_error='';


   while ($row = pg_fetch_row($result)) {
    $id_deteccion_entrada=$row[1];$id_deteccion_salida=$row[2];$id_auto=$row[3];
    $id_parqueo=$row[4];$id_servicio_app=$row[5];$tiempo_total=$row[6];
    $deteccion_entrada_salida=$row[7];$existe_error=$row[8];}

   $id_usuario_app=$id_servicio_app;
   pg_free_result($result);


   //SOLO HACER TODO ESTO SI ES DIFERENTE A LA QUE YA ESTA ANTES
   if (!($placa_corr == $deteccion_entrada_salida)) {

                 echo "\n";echo "ES DIFERENTES A LA ORIGINAL SE HACE TODO...";


                //-1. corregir en la tabla placas_entrada (con el id_deteccion_entrada)
                    $query= "UPDATE placas_entrada SET deteccion_entrada='$placa_corr' WHERE id_placa_entrada='$id_deteccion_entrada' AND id_parqueo='$id_parqueo'";
                    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    pg_free_result($result);echo "\n";echo "ACTUALIZRA PLACA ENTRADA";

                //-2 corregir en la tabla placas_salida 

                    $query= "UPDATE placas_salida SET deteccion_salida='$placa_corr' WHERE id_placa_salida='$id_deteccion_salida' AND id_parqueo='$id_parqueo'";
                    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    pg_free_result($result);echo "\n";echo "ACTUALIZAR PLACA SALIDA";

           


//revisar si coincide con alguna
//Obtener los datos del auto con misma placa, 


                $query = "    select count(*) from placas_entrada_salida where id_parqueo='$id_parqueo' AND deteccion_entrada_salida='$placa_corr'";
                $resultauto = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                $coincidencias_placa='';
                while ($row = pg_fetch_row($resultauto)) {
                  $coincidencias_placa=$row[0];
                }
                pg_free_result($resultauto);

        echo "\n";echo "Concidencias placa:"; echo $coincidencias_placa;



                if(($coincidencias_placa==0)){

                       //Actualizar en la tabla actual , la deteccion y poner que no existe error
                       $query= "UPDATE placas_entrada_salida SET deteccion_entrada_salida='$placa_corr',existe_error='N' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
                       $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                       pg_free_result($result);echo "\n";
                       echo "ACTUALIZAR PLACA ENTRADA,SALIDA.";

                       

                     //si no cumple formato nunca se registro por lo que no existe auto

                        if($id_auto=='NA'){

                       
                                                
                                                                    echo "\n";echo "NO HAY AUTO QUE COINCIDE SE CREA UNO NUEVO";


                                                                            ///TODO: 6 CARACTERES PARA ID DE AUTO ESTABA ANTES

                                                                    $key = '';$pattern = '1234567890ABCDEFGH123456789';$max = strlen($pattern)-1;
                                                                                                for($i=0;$i < 8;$i++){ $key .= $pattern[mt_rand(0,$max)]; } 
                                                                                                $id_auto_creado=$key;

                                                                    //consulta de tabla de entrada para obtener foto_ENTRADA ,foto_SALIDA y fecha_registro_auto

                                                                          $query = " select hora_deteccion_entrada,foto_auto_entrada from placas_entrada where id_placa_entrada='$id_deteccion_entrada' AND id_parqueo='$id_parqueo'";
                                                                          $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                                          $hora_deteccion_entrada_R='';$foto_auto_entrada_R='';
                                                                          
                                                                          while ($row = pg_fetch_row($result)) {
                                                                          $hora_deteccion_entrada_R=$row[0];$foto_auto_entrada_R=$row[1];}    pg_free_result($result);

                                                                          $query = "select foto_auto_salida from placas_salida WHERE id_placa_salida='$id_deteccion_salida' AND id_parqueo='$id_parqueo'";
                                                                          $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                                          $foto_auto_salida_R='';

                                                                          while ($row = pg_fetch_row($result)) {$foto_auto_salida_R=$row[0];}   pg_free_result($result);

                                                                          //TODO: POR 'por definir podria dar problemas'
                                                                          $query = "INSERT INTO auto(
                                                                          id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app,fecha_registro_auto)
                                                                          VALUES ('$id_auto_creado', '$placa_corr', 1, '$foto_auto_entrada_R', '$foto_auto_salida_R', '$id_parqueo', 'Por definir', '$hora_deteccion_entrada_R');";
                                                                      
                                                                        $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
                                                                        echo "\n";echo "AUTO CREADO";



                                                                          //Actualizar en la tabla entrada_salida , la deteccion y poner que no existe error
                                                                          $query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_creado' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
                                                                          $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
                                                                        echo "\n";echo "AUTO ACTUALIZADO EN PLACA_eNTRADA_sALIDA";



                                                                        

                            if($id_usuario_app=='NA'){ echo "\n";echo "SIN USUARIO";
                            }
                           else{
                        $query= "UPDATE auto SET id_usuario_app='$id_usuario_app' WHERE id_auto='$id_auto_creado' AND id_parqueo='$id_parqueo'";
                        $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                        pg_free_result($result);  echo "\n";
                        
                        echo "ACTUALIZANDO USUARIO EN TABLA AUTO";
                        

                      }

                          }

                          //CASO: ID DIFERENTE DE NA, PERO CON MAS DE UN REGISTRO EN EL ANTERIOR
                       //COMPROBAR CUANTOS AUTOS EXISTIAN CON LA PLACA ANTERIOR
                          else{
                            $query = "SELECT numero_visitas FROM auto where id_parqueo='$id_parqueo' and placa='$antigua_placa'";
                            $result24 = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());    
                               $numero_visitas_old='';     
                            while ($row = pg_fetch_row($result24)) {
                               $numero_visitas_old=$row[0];
                              }      
                            pg_free_result($result24);

                            echo "\n";echo "numero de visitas: "; echo $numero_visitas_old;



                          if($numero_visitas_old<2){

                            $query= "UPDATE auto SET placa='$placa_corr' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";
                            $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                              pg_free_result($result);
                              echo "\n";echo "SE MODIFICO PLACA AL AUTO YA DEFINIDO, con visitas = 1";

                          }

                          else{
                            //1.RESTAR 1 VISITA AL ANTIGUO
                            $numero_visitas_old_update= $numero_visitas_old-1;
                            $query= "UPDATE auto SET numero_visitas='$numero_visitas_old_update' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";
                            $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                            pg_free_result($result);

                            //2. CREAR UNO NUEVO CON LA INFORMACION QUE TENGO

                                                                      echo "\n";echo "NO HAY AUTO QUE COINCIDE SE CREA UNO NUEVO";


                                                                      ///TODO: 6 CARACTERES PARA ID DE AUTO ESTABA ANTES

                                                              $key = '';$pattern = '1234567890ABCDEFGH123456789';$max = strlen($pattern)-1;
                                                                                          for($i=0;$i < 8;$i++){ $key .= $pattern[mt_rand(0,$max)]; } 
                                                                                          $id_auto_creado=$key;

                                                              //consulta de tabla de entrada para obtener foto_ENTRADA ,foto_SALIDA y fecha_registro_auto

                                                                    $query = " select hora_deteccion_entrada,foto_auto_entrada from placas_entrada where id_placa_entrada='$id_deteccion_entrada' AND id_parqueo='$id_parqueo'";
                                                                    $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                                    $hora_deteccion_entrada_R='';$foto_auto_entrada_R='';
                                                                    
                                                                    while ($row = pg_fetch_row($result)) {
                                                                    $hora_deteccion_entrada_R=$row[0];$foto_auto_entrada_R=$row[1];}    pg_free_result($result);

                                                                    $query = "select foto_auto_salida from placas_salida WHERE id_placa_salida='$id_deteccion_salida' AND id_parqueo='$id_parqueo'";
                                                                    $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                                    $foto_auto_salida_R='';

                                                                    while ($row = pg_fetch_row($result)) {$foto_auto_salida_R=$row[0];}   pg_free_result($result);

                                                                    //TODO: POR 'por definir podria dar problemas'
                                                                    $query = "INSERT INTO auto(
                                                                    id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app,fecha_registro_auto)
                                                                    VALUES ('$id_auto_creado', '$placa_corr', 1, '$foto_auto_entrada_R', '$foto_auto_salida_R', '$id_parqueo', 'Por definir', '$hora_deteccion_entrada_R');";
                                                                
                                                                  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
                                                                  echo "\n";echo "AUTO CREADO";



                                                                    //Actualizar en la tabla entrada_salida , la deteccion y poner que no existe error
                                                                    $query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_creado' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
                                                                    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
                                                                  echo "\n";echo "AUTO ACTUALIZADO EN PLACA_eNTRADA_sALIDA";


                          }




              
            
                        }

      }
 
 else{


  $query = " 

  select auto.id_auto , hora_deteccion_salida,numero_visitas
  from placas_entrada_salida, placas_salida, auto
  where  id_deteccion_salida=id_placa_salida and placas_entrada_salida.id_auto=auto.id_auto 
  and placas_salida.id_parqueo='$id_parqueo' 
  AND deteccion_entrada_salida='$placa_corr' order by hora_deteccion_salida desc limit 1
  ";


  $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
  $id_auto_existente_R='';
  $hora_deteccion_salida_R='';
  $numero_visitas_R='';

  while ($row = pg_fetch_row($result)) {
  $id_auto_existente_R=$row[0];
  $hora_deteccion_salida_R=$row[1];
  $numero_visitas_R=$row[2];
  }

  pg_free_result($result);

  $query= "UPDATE placas_entrada_salida SET deteccion_entrada_salida='$placa_corr',existe_error='N' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  pg_free_result($result);echo "\n";echo "ACTUALIZAR PLACA ENTRADA,SALIDA.";


  if($id_auto=='NA'){


          $query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_existente_R' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
          $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          pg_free_result($result);
         echo "\n";echo "AUTO ACTUALIZADO EN PLACA_eNTRADA_sALIDA";
          $numero_visitas = $numero_visitas_R+1;


                  //no se registro pór tener formatpp invalido
                  if($id_usuario_app=='NA'){
                    $query= "UPDATE auto SET numero_visitas='$numero_visitas'  WHERE id_auto='$id_auto_existente_R' AND id_parqueo='$id_parqueo'";
                    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    $tuplasaafectadas = pg_affected_rows($result);
                    pg_free_result($result);
                   echo "\n";echo "ACT NUMERO DE VISITAS ";


                  }
                  else{
                    $query= "UPDATE auto SET id_usuario_app='$id_usuario_app' ,numero_visitas='$numero_visitas'  WHERE id_auto='$id_auto_existente_R' AND id_parqueo='$id_parqueo'";
                    $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    $tuplasaafectadas = pg_affected_rows($result);
                    pg_free_result($result);
                   echo "\n";echo "ACT NUMERO DE VISITAS + USUARIO";

              

                  }




  }

  
  else{

    $query = "SELECT numero_visitas FROM auto where  id_parqueo='$id_parqueo' and id_auto='$id_auto'";

    $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
    $numero_visitas_anterior='';
  
    while ($row = pg_fetch_row($result)) {
    $numero_visitas_anterior=$row[0];
    }
    pg_free_result($result);



    $numero_visitas_condicion = $numero_visitas_anterior-1;

    if($numero_visitas_condicion==0){

      $query = "DELETE FROM auto WHERE id_parqueo='$id_parqueo' AND id_auto='$id_auto'";
      if($resultadoeliminar = pg_query($query)){
        echo "\n";
      echo "VISITAS= 0 ELIMIANDNO ACTUAL.";
      }
      else{
        echo "Error.";
      }
      pg_free_result($resultadoeliminar);


    }else{

      $query= "UPDATE auto SET numero_visitas='$numero_visitas_condicion',id_usuario_app='Por definir' WHERE id_auto='$id_auto' AND id_parqueo='$id_parqueo'";
      $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
      $tuplasaafectadas = pg_affected_rows($result);
      pg_free_result($result);

      echo "\n";echo "RESTANDOLE 1 AL ANTERIOR ID:"; echo $numero_visitas;



    }



      $query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_existente_R' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
      $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
      pg_free_result($result);
      $numero_visitas = $numero_visitas_R+1;
         
      if($id_usuario_app=='NA'){
        $query= "UPDATE auto SET numero_visitas='$numero_visitas'  WHERE id_auto='$id_auto_existente_R' AND id_parqueo='$id_parqueo'";
        $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $tuplasaafectadas = pg_affected_rows($result);
        pg_free_result($result);

      }
      else{
        $query= "UPDATE auto SET id_usuario_app='$id_usuario_app' ,numero_visitas='$numero_visitas'  WHERE id_auto='$id_auto_existente_R' AND id_parqueo='$id_parqueo'";
        $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
        $tuplasaafectadas = pg_affected_rows($result);
        pg_free_result($result);
  
      }



  }



 }





}

else{

 echo "\n";echo "ES IGUAL, EXISTER ERROR A N...";


 if($existe_error=='S'){


  $query= "UPDATE placas_entrada_salida SET existe_error='N' 
  WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$tuplasaafectadas = pg_affected_rows($result);
pg_free_result($result);


$key = '';$pattern = '1234567890ABCDEFGH123456789';$max = strlen($pattern)-1;
for($i=0;$i < 8;$i++){ $key .= $pattern[mt_rand(0,$max)]; } 
$id_auto_creado=$key;

//consulta de tabla de entrada para obtener foto_ENTRADA ,foto_SALIDA y fecha_registro_auto

$query = " select hora_deteccion_entrada,foto_auto_entrada from placas_entrada where id_placa_entrada='$id_deteccion_entrada' AND id_parqueo='$id_parqueo'";
$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$hora_deteccion_entrada_R='';$foto_auto_entrada_R='';

while ($row = pg_fetch_row($result)) {
$hora_deteccion_entrada_R=$row[0];$foto_auto_entrada_R=$row[1];}    pg_free_result($result);

$query = "select foto_auto_salida from placas_salida WHERE id_placa_salida='$id_deteccion_salida' AND id_parqueo='$id_parqueo'";
$result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
$foto_auto_salida_R='';

while ($row = pg_fetch_row($result)) {$foto_auto_salida_R=$row[0];}   pg_free_result($result);

//TODO: POR 'por definir podria dar problemas'
$query = "INSERT INTO auto(
id_auto, placa, numero_visitas, foto_delante, foto_atras, id_parqueo, id_usuario_app,fecha_registro_auto)
VALUES ('$id_auto_creado', '$placa_corr', 1, '$foto_auto_entrada_R', '$foto_auto_salida_R', '$id_parqueo', 'Por definir', '$hora_deteccion_entrada_R');";

$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
echo "\n";echo "AUTO CREADO";



//Actualizar en la tabla entrada_salida , la deteccion y poner que no existe error
$query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_creado' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());pg_free_result($result);
echo "\n";echo "AUTO ACTUALIZADO EN PLACA_eNTRADA_sALIDA";



$query= "UPDATE placas_entrada_salida SET id_auto='$id_auto_existente_R' WHERE id_entrada_salida='$id_placa_corr' AND id_parqueo='$id_parqueo'";
$result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
pg_free_result($result);
$numero_visitas = $numero_visitas_R+1;
   
if($id_usuario_app=='NA'){

}
else{
  $query= "UPDATE auto SET id_usuario_app='$id_usuario_app'  WHERE id_auto='$id_auto_creado' AND id_parqueo='$id_parqueo'";
  $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
  $tuplasaafectadas = pg_affected_rows($result);
  pg_free_result($result);

}










 }


 


//




}


$url="Location: ./../flujo_autos.php";
header($url);
















?>
