
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
 
          $key = '';
          $pattern = '1234567890ABCDEFGH123456789';
          $max = strlen($pattern)-1;
          for($i=0;$i < 6;$i++){
               $key .= $pattern[mt_rand(0,$max)]; 
              } 
          
          
            $id=$key; 
            $id_duenio=   $_COOKIE["id_usuario"];
           
           
            $nombre= $_GET['nombre_empresa'];
            $direccion= $_GET['direccion'];
            $capacidad_maxima = $_GET['capacidad_maxima'];
          
          
            $media_hora = $_GET['media_hora'];
          
            $hora = $_GET['hora'];
          
            $dia = $_GET['dia'];
          
            $mes = $_GET['mes'];


            $lunes_entrada=$_GET['lunes_apertura'];;

            $lunes_salida=$_GET['lunes_cierre'];;

            $domingo_entrada=$_GET['domingo_apertura'];;

            $domingo_salida=$_GET['domingo_cierre'];; 

            $detalles='Pendiente';
            $imagenes='Pendiente';
            $latitude=$_GET['latitude'];;
            $longitude=$_GET['longitude'];;

            $martes_entrada=$_GET['martes_apertura'];;
            $martes_salida=$_GET['martes_cierre'];;
            $miercoles_entrada=$_GET['miercoles_apertura'];;
            $miercoles_salida=$_GET['miercoles_cierre'];;
            $jueves_entrada=$_GET['jueves_apertura'];;
            $jueves_salida=$_GET['jueves_cierre'];;
            $viernes_entrada=$_GET['viernes_apertura'];;
            $viernes_salida=$_GET['viernes_cierre'];;
            $sabado_entrada=$_GET['sabado_apertura'];;
            $sabado_salida=$_GET['sabado_cierre'];;
          
     
            // base de datols
                    
          $query = "Insert into parqueo values ('$id','$id_duenio','$nombre','$direccion','$capacidad_maxima','$media_hora','$hora','$dia','$mes','$lunes_entrada','$lunes_salida','$domingo_entrada','$domingo_salida','$detalles','$imagenes','$latitude','$longitude','$martes_entrada','$martes_salida','$miercoles_entrada','$miercoles_salida','$jueves_entrada','$jueves_salida','$viernes_entrada','$viernes_salida','$sabado_entrada','$sabado_salida')";
          $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
          $tuplasaafectadas = pg_affected_rows($result);
          pg_free_result($result);
          
          
          
          
          ?>
           
          
