


  
<?php
  if((strlen($placa_detectada_interno)==8)&&($placa_necesita_correccion=='S')){


    $placa_detectada_interno= substr($placa_detectada_interno,1);


    
  if(preg_match('/^[0]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==7){
    $placa_detectada_interno= substr($placa_detectada_interno,1);
    $placa_detectada_interno='O'.$placa_detectada_interno; 
  $placa_necesita_correccion='N';
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
  $placa_necesita_correccion='N';
}
else{
  // P por ser más probable
    $placa_detectada_interno= substr($placa_detectada_interno,1);
    $placa_detectada_interno='P'.$placa_detectada_interno; 
  $placa_necesita_correccion='N';
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
    $placa_necesita_correccion='N';
  }
  else{
    $placa_necesita_correccion='S';  
  }
}



if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
  $placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{5}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==8){
$placa_necesita_correccion='N';
}

if(preg_match('/^[A-Z]{3}\d{3}$/',$placa_detectada_interno) and strlen($placa_detectada_interno)==6){
$placa_necesita_correccion='N';
}


if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',) and strlen($placa_detectada_interno)==6){
$placa_detectada_interno='P'.$placa_detectada_interno; 
$placa_necesita_correccion='N';
}

if(strlen($placa_detectada_interno)<=5){
$n_caracter=substr($placa_detectada_interno, 0, 1);

if(is_numeric($n_caracter)){
$placa_detectada_interno='P'.$placa_detectada_interno;
}

$placa_necesita_correccion='S';



}




}
 


   ?>