

<?php


require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

use Cloudinary\Transformation\Resize;

use Cloudinary\Transformation\Gravity;
use Cloudinary\Transformation\Crop;
use Cloudinary\Transformation\Quality;
use Cloudinary\Transformation\Format;







$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   
}

date_default_timezone_set('America/Guatemala');



 $cloudinary = new Cloudinary(
    [
        "cloud" =>
            [
                'cloud_name' => 'parkiate-ki',
                'api_key'    => '794241658481217',
                'api_secret' => 'qRQnXnrfL-xqXug4sfFlMgGfeAY',
            ],
            'url' => [
                       'secure' => true //default
            ]
    ]
);


/*$placa_detectada=$response->results[0]->plate;

$placa_detectada = strtoupper($placa_detectada);
*/

$placa_detectada = "CHI084";

echo "resultado:";

echo $placa_detectada;
 echo "\n";



//[A-Z]{3}|[0-9]{5}

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

$placa_necesita_correccion='';

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


  if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==6){


    

    $placa_detectada='P'.$placa_detectada; 

   $placa_necesita_correccion='N';



  }

  if(strlen($placa_detectada)<=5){

    $n_caracter=substr($placa_detectada, 0, 1);

  if(is_numeric($n_caracter)){
    $placa_detectada='P'.$placa_detectada;
  }



   $placa_necesita_correccion='S';



  }


  









 



/*

if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){

  $placa_necesita_correccion='N';

}


else if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){

  $placa_necesita_correccion='N';

}

else if(preg_match('/^\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/', $placa_detectada) and strlen($placa_detectada)==6)
{
  $string='paso con 6';

  $placa_detectada='P'.$placa_detectada;
  $placa_necesita_correccion='N';


}
else{
  $primer_caracter=substr($placa_detectada, 0, 1);

  if(is_numeric($primer_caracter)){
    $placa_detectada='P'.$placa_detectada;
  }else{
   // $placa_detectada= substr($placa_detectada,1);
  }

  $placa_necesita_correccion='S';
}

if(preg_match('/^[A-Z]{1}\d{3}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/',$placa_detectada) and strlen($placa_detectada)==7){

  $placa_necesita_correccion='N';


  $primer_caracter=substr($placa_detectada, 0, 1);

  if(($primer_caracter=='D')||($primer_caracter=='B')){
    $placa_detectada= substr($placa_detectada,1);
    $placa_detectada='P'.$placa_detectada;
  }

}






//SI PARA ESTE PUNTO SIGUE SI DETECTAR TODAS LAS LETRAS, VAMOS A USAR LOS OTROS RESULTADOS SI HAY



if( $placa_detectada=='P206CK'){
  $placa_necesita_correccion='N';

  $placa_detectada='P206CKJ';
  
}
*/

echo "placa detectada :";
echo $placa_detectada;
echo "\n";

echo "Necesita Correcion :";
echo $placa_necesita_correccion;
echo "\n";





  


?>



