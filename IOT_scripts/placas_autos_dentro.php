

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}



         $query = " select deteccion_entrada from placas_entrada where id_parqueo='$id_parqueo' and dentro_fuera='D'";   




         $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
         $placa_dentro_agregar='';


         $listado_placas_adentro =  [];
        

        while ($row = pg_fetch_row($result)) {

           
         $placa_dentro_agregar=$row[0];

         array_push($listado_placas_adentro,$placa_dentro_agregar);

         
        }



        $resultado_placa_dentro='N';



         
         if (in_array($placa_detectada, $listado_placas_adentro)) {
          
          $resultado_placa_dentro='S';

      } 
      else
      {
   //     echo "\n";

                //   $distance = levenshtein($placa_detectada, $value);


      //ENCONTRAR EL VALOR MEJOR
          /*
          CONDICION PROVISIONAL , MAYOR TENGA UN PORCENTAJE VALOR MAYOR A 60% Y PORCENTAJE 2 MENOR O IGUAL A 3


          SI CUMPLE ESTAS CONDICIONES SE ASIGNA EL NUEVO MAYOR

          */

          $porcentaje_similar_mayor=0.0;
          $levenshtein_numbers_menor=1000;

          $placa_reemplazo='NA';



    //    echo "NO EXISTE IGUAL HACER MAGIA";
        foreach ($listado_placas_adentro as $i => $value) {
    /*      echo "\n";   
           echo "V.A:";
          echo $value;
          echo "\t";   

          echo "V.O:";
         echo $placa_detectada;
         echo "\t";   */


      
         similar_text($value,$placa_detectada,$porcentaje_similaridad);
         $porcentaje_similaridad2 = levenshtein($placa_detectada, $value);

      /*   echo "%1:";
         echo $porcentaje_similaridad;
         echo "\t";   

         echo "%2:";
         echo $porcentaje_similaridad2;
         echo "\t";  */


         if(($porcentaje_similaridad > 60.0 )&&($porcentaje_similaridad2<= 3 )){


           $porcentaje_similar_mayor=$porcentaje_similaridad;
          $levenshtein_numbers_menor=$porcentaje_similaridad2;

          $placa_reemplazo=$value;





         }

          
      }



     if($placa_reemplazo=='NA'){


      echo "\n";   
      echo "FAILED:";
      echo $placa_detectada;
      echo "\n";

      $resultado_placa_dentro='N';



     }
     else{

      $antiguovalor=$placa_detectada;
      $placa_detectada=$placa_reemplazo;
      $placa_necesita_correccion='N'; 

      $resultado_placa_dentro='S';

      echo "\n";   
      echo "HUBO REEMPLAZO, antes era:";
      echo $antiguovalor;
      echo "\n";


     }

 




      }



      
        




?>



