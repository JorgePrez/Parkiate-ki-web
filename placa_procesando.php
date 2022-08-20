

<?php

/////////////////////////////////////////////////


/*A	Vehículo de alquiler
C	Vehículo Comercial
CC	Cuerpo Consular
CD	Cuerpo Diplomático
M	Motocicletas y Ciclomotores
(Formato reducido)

MI	Misión Internacional
O	Vehículo Oficial
P	Vehículo Privado
TC	Remolque
U	Bus urbano
*/

$placa_necesita_correccion='S';

/* 1. Comprobar que cumpla con el formato $000AAA siendo $= A | C | M | O | P | U 
   -> Se marca que la placa cumple con formato 
*/


/* 2.Comprobar que cumppla con el formato $$00AAA siendop $= CC | CD | MI | TC 
    -> Se marca que la placa cumple con formato 

*/


/* 3. (ERROR) Que pasa si detecta 6 caracteres , si cumple el formato 000AAA, se le agregara la P por ser más probable
   -> Se marca que la placa cumple con formato 

*/

/* 4. (ERROR)  Que pasa si detecta 5 o menos letras, si el primer caracter es un numero , se le agrega la P por ser más probable
  
   ->Se marca que no cumple con formato

   */

  /* 5. (ERROR) CUALQUIER otro error que suceda debe ser corregido manualmente (es muy poco probable que suceda esto)

   */


   //ANTES DE COMPROBAR ESTO SE HARAN ALGUNAS CORRECIONES RESPECTO A ERRORES DE FORMATO CON RESPECTO A LA CONFUSIÓN DE | 0 con O | 5 con S | 1 con I | ,
   //ESTOS SOLO SE HARÁN SI TIENEN 7 CARACTERES

   //Algunas correciones primer caracter si es 0 se cambiara por una O


  if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
       $placa_detectada= substr($placa_detectada,1);
       $placa_detectada='O'.$placa_detectada; 
      $placa_necesita_correccion='N';
    }
  
  
  if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
    $n_caracter=substr($placa_detectada, 0, 1);
    //A | C | M | O | P | U 
    if(($n_caracter=='A')||
    ($n_caracter=='C')||
    ($n_caracter=='M')||
    ($n_caracter=='O')||
    ($n_caracter=='P')||
    ($n_caracter=='U')
    ){
      $placa_necesita_correccion='N';
    }
    else{
      // P por ser más probable
       $placa_detectada= substr($placa_detectada,1);
       $placa_detectada='P'.$placa_detectada; 
      $placa_necesita_correccion='N';
    }
  }


    if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
      $n_caracter=substr($placa_detectada, 0, 2);
      // CC | CD | MI | TC 
      if(($n_caracter=='CC')||
      ($n_caracter=='CD')||
      ($n_caracter=='MI')||
      ($n_caracter=='TC')
      ){
        $placa_necesita_correccion='N';
      }
      else{
        $placa_necesita_correccion='S';  
      }
  }


  
  if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
      $placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{5}$/',$placa_detectada) and strlen($placa_detectada)==8){
  $placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
  $placa_necesita_correccion='N';
}


if(preg_match('/^[A-Z]{2}\d{3}$/',$placa_detectada) and strlen($placa_detectada)==5){
  $placa_necesita_correccion='N';
}



  if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==6){
    $placa_detectada='P'.$placa_detectada; 
   $placa_necesita_correccion='N';
  }


  

  if((strlen($placa_detectada)<=5)&&($placa_necesita_correccion=='S')){
    $n_caracter=substr($placa_detectada, 0, 1);

  if(is_numeric($n_caracter)){
    $placa_detectada='P'.$placa_detectada;
  }

   $placa_necesita_correccion='S';



  }


  if((strlen($placa_detectada)==8)&&($placa_necesita_correccion=='S')){


                                                $placa_detectada= substr($placa_detectada,1);


                                                
                                              if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                                $placa_detectada= substr($placa_detectada,1);
                                                $placa_detectada='O'.$placa_detectada; 
                                              $placa_necesita_correccion='N';
                                            }


                                            if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                            $n_caracter=substr($placa_detectada, 0, 1);
                                            //A | C | M | O | P | U 
                                            if(($n_caracter=='A')||
                                            ($n_caracter=='C')||
                                            ($n_caracter=='M')||
                                            ($n_caracter=='O')||
                                            ($n_caracter=='P')||
                                            ($n_caracter=='U')
                                            ){
                                              $placa_necesita_correccion='N';
                                            }
                                            else{
                                              // P por ser más probable
                                                $placa_detectada= substr($placa_detectada,1);
                                                $placa_detectada='P'.$placa_detectada; 
                                              $placa_necesita_correccion='N';
                                            }
                                            }


                                            if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){
                                              $n_caracter=substr($placa_detectada, 0, 2);
                                              // CC | CD | MI | TC 
                                              if(($n_caracter=='CC')||
                                              ($n_caracter=='CD')||
                                              ($n_caracter=='MI')||
                                              ($n_caracter=='TC')
                                              ){
                                                $placa_necesita_correccion='N';
                                              }
                                              else{
                                                $placa_necesita_correccion='S';  
                                              }
                                            }





 


                   }


//SI PARA ESTE PUNTO SIGUE necesotamdp correcion pasamos a ver los candidatos
 if($placa_necesita_correccion=='S'){


  $nuevo_resultado="";
  $encontrenuevaplaca="";

  $arreglo_candidatos=$response->results[0]->candidates;

  $arrLength = count($arreglo_candidatos);


  for($i = 1; $i < $arrLength; $i++) {

    $placa_detectada_interno= $response->results[0]->candidates[$i]->plate;

    //print_r($posible_candidato);
    $placa_detectada_interno = strtoupper($placa_detectada_interno);
    
    //////////////////////////////////////////////////
    //echo $posible_candidato;

   // echo "\n";

   
$placa_necesita_correccion_interno='S';


if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
  $placa_detectada_interno= substr($placa_detectada_interno,1);
  $placa_detectada_interno='O'.$placa_detectada_interno; 
 $placa_necesita_correccion_interno='N';
}


if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
$n_caracter=substr($placa_detectada_interno, 0, 1);
//A | C | M | O | P | U 
if(($n_caracter=='A')||
($n_caracter=='C')||
($n_caracter=='M')||
($n_caracter=='O')||
($n_caracter=='P')||
($n_caracter=='U')
){
 $placa_necesita_correccion_interno='N';
}

else{
 // P por ser más probable
  $placa_detectada_interno= substr($placa_detectada_interno,1);
  $placa_detectada_interno='P'.$placa_detectada_interno; 
 $placa_necesita_correccion_interno='N';
}
}


if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
 $n_caracter=substr($placa_detectada_interno, 0, 2);
 // CC | CD | MI | TC 
 if(($n_caracter=='CC')||
 ($n_caracter=='CD')||
 ($n_caracter=='MI')||
 ($n_caracter=='TC')
 ){
   $placa_necesita_correccion_interno='N';
 }

 else{
   $placa_necesita_correccion_interno='S';
 }

}



if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
 $placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{3}\d{5}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==8){
$placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
$placa_necesita_correccion_interno='N';
}

if(preg_match('/^[A-Z]{2}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==5){
  $placa_necesita_correccion_interno='N';
  }


if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
$placa_detectada_interno='P'.$placa_detectada_interno; 
$placa_necesita_correccion_interno='N';
}

if((strlen($placa_detectada_interno)<=5)&&($placa_necesita_correccion_interno=='S')){
$n_caracter=substr($placa_detectada_interno, 0, 1);

if(is_numeric($n_caracter)){
$placa_detectada_interno='P'.$placa_detectada_interno;
}

$placa_necesita_correccion_interno='S';
}


if((strlen($placa_detectada_interno)==8)&&($placa_necesita_correccion_interno=='S')){


                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);


                                                  
                                                if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);
                                                  $placa_detectada_interno='O'.$placa_detectada_interno; 
                                                $placa_necesita_correccion_interno='N';
                                                }


                                                if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                $n_caracter=substr($placa_detectada_interno, 0, 1);
                                                //A | C | M | O | P | U 
                                                if(($n_caracter=='A')||
                                                ($n_caracter=='C')||
                                                ($n_caracter=='M')||
                                                ($n_caracter=='O')||
                                                ($n_caracter=='P')||
                                                ($n_caracter=='U')
                                                ){
                                                $placa_necesita_correccion_interno='N';
                                                }
                                                else{
                                                // P por ser más probable
                                                  $placa_detectada_interno= substr($placa_detectada_interno,1);
                                                  $placa_detectada_interno='P'.$placa_detectada_interno; 
                                                $placa_necesita_correccion_interno='N';
                                                }
                                                }


                                                if(preg_match('/^[A-Z]{2}\d{2}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
                                                $n_caracter=substr($placa_detectada_interno, 0, 2);
                                                // CC | CD | MI | TC 
                                                if(($n_caracter=='CC')||
                                                ($n_caracter=='CD')||
                                                ($n_caracter=='MI')||
                                                ($n_caracter=='TC')
                                                ){
                                                  $placa_necesita_correccion_interno='N';
                                                }
                                                else{
                                                  $placa_necesita_correccion_interno='S';  
                                                }
                                                }

}


if( $placa_necesita_correccion_interno=='N'){
  $placa_detectada=$placa_detectada_interno;
  $placa_necesita_correccion='N';
  break;
}


/////////////////////////////////////////////////////////////////////////////


    

}
/*echo "\n";
echo "Longitud: ";
  echo $arrLength;

*/


 }

//$bounding_box_placa = $xmin_placa + $ymin_placa + $xmax_placa + $ymax_placa;

?>



