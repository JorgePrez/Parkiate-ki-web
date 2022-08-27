

<?php

$conn = pg_connect("host=db-instancia.ccwm7dhw4cau.us-east-1.rds.amazonaws.com port=5432 user=postgres password=56721449 dbname=postgres");
if (!$conn){
    die("PostgreSQL connection failed");
   }

date_default_timezone_set('America/Guatemala');   //https://parkiateki.ngrok.io/Parkiate-web/registrar_desde_app.php?id_parqueo=78FFFE&id_usuario=12


while(true){

echo "Esperando URL: ";
fscanf(STDIN, "%s", $tocheck);
//echo "LEIDO:, $tocheck";
echo "\n";

//1. OBTENER PARAMETROS

if (str_contains($tocheck, 'registrar_desde_app.php?')) {
                //    echo "Valido";  echo "\n";
                $arr = explode('registrar_desde_app.php?', $tocheck);
                $url_params=$arr[1];
                $arr = explode('&', $url_params);
                $id_parqueo_param=$arr[0];
                $id_usuario_param=$arr[1];
                $id_parqueo_param2 = explode('=', $id_parqueo_param);
                $valor_idparqueo=$id_parqueo_param2[1];
               // echo "id_parqueo: "; echo $valor_idparqueo; echo "\n";
                $id_usuario_param2 = explode('=', $id_usuario_param);
                $valor_idusuario=$id_usuario_param2[1];
               // echo "id_usuario: ";echo $valor_idusuario;echo "\n";

               //SCRIP DE REGISTRAR USUARIO DESDE APP
                $id_parqueo = $valor_idparqueo;
                $id_usuario= $valor_idusuario; 

                                                            $registro_exitoso='';
                                                            $mensaje1='';
                                                            $mensaje2='';

                                                            
                                                            $query = "select id_visita_actual from usuarios_app where id='$id_usuario'";   



                                                            $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                            $condicion='';

                                                                        
                                                            while ($row = pg_fetch_row($result)) {

                                                                
                                                            
                                                            $condicion=$row[0];

                                                            }

                                                            pg_free_result($result);


                                                            if(strlen($condicion)<=1){






                                                            $query = "
                                                            select id_placa_entrada,hora_deteccion_entrada, foto_auto_entrada,deteccion_entrada,id_usuario_app from placas_entrada,placas_entrada_salida
                                                            where placas_entrada.id_parqueo='$id_parqueo' and dentro_fuera='D' and id_deteccion_entrada=id_placa_entrada 
                                                            and id_usuario_app='NA'
                                                            order by hora_deteccion_entrada desc limit 1";
                                                            



                                                            $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                            $id_placa_entrada='';
                                                            $hora_deteccion_entrada='';
                                                            $foto_auto_entrada = '';
                                                            $deteccion_entrada= '';



                                                                        
                                                            while ($row = pg_fetch_row($result)) {

                                                                
                                                            
                                                            $id_placa_entrada=$row[0];
                                                            $hora_deteccion_entrada=$row[1];
                                                            $foto_auto_entrada = $row[2];
                                                            $deteccion_entrada= $row[3];
                                                            }

                                                            pg_free_result($result);


                                                            
                                                            if(!(strlen($id_placa_entrada)>0)){ //puede ser que no existe ninguna foto $id_placa_entrada=''
                                                            $registro_exitoso='10';

                                                            
                                                            
                                                            $mensaje1=' Registro Incorrecto';
                                                            $mensaje2=' No existe fotografía reciente en la base de datos';


                                                            }
                                                            else   
                                                            {



                                                            //puede ser que si exista [rango de tiempo] limitado , y 
                                                                    //si cumple que es menor a los 3 min, se registro
                                                                    //error, qr no confirmado.

                                                                $now = new Datetime('now');$now = $now->format('Y-m-d H:i:s');


                                                                    $datetime1 = new DateTime($hora_deteccion_entrada);//start time
                                                            $datetime2 = new DateTime($now);//end time
                                                            $interval = $datetime1->diff($datetime2);

                                                            $otravariable=$interval->i;

                                                            //$cantidad_minutos=6;// int($interval->i);

                                                            if($otravariable>=5){
                                                            $rango_aceptable=false;

                                                            }
                                                            else{
                                                            $rango_aceptable=true;
                                                            }


                                                            if($rango_aceptable){
                                                                
                                                            $query = "
                                                            
                                                            select id_entrada_salida,id_auto from placas_entrada_salida,placas_entrada as Pe 
                                                            where id_placa_entrada='$id_placa_entrada' and id_placa_entrada=id_deteccion_entrada
                                                            and Pe.id_parqueo='$id_parqueo'
                                                            ";   



                                                            $result = pg_query($conn, $query) or die('ERROR : ' . pg_last_error());
                                                            $id_entrada_salida='';
                                                            $id_auto='';

                                                            while ($row = pg_fetch_row($result)) {   

                                                            $id_entrada_salida=$row[0];
                                                            $id_auto=$row[1];

                                                            }

                                                            pg_free_result($result);





                                                            $query= "update placas_entrada_salida set id_usuario_app='$id_usuario' where id_entrada_salida='$id_entrada_salida' and id_parqueo='$id_parqueo'";

                                                            $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                                            $tuplasaafectadas = pg_affected_rows($result);
                                                            pg_free_result($result);

                                                            //OBTENER EL ID DE LA TALBA id_entrada_Salida con este id, debo revisar si tiene  id_auto != NA




                                                            $query="update usuarios_app set id_visita_actual='$id_entrada_salida' where id='$id_usuario'"; 

                                                            $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                                            $tuplasaafectadas = pg_affected_rows($result);
                                                            pg_free_result($result);


                                                            if($id_auto!='NA'){
                                                            
                                                            $query="update auto set id_usuario_app='$id_usuario' where placa='$deteccion_entrada' and id_parqueo='$id_parqueo' and id_auto='$id_auto'"; 


                                                            $result = pg_query($conn, $query) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                                            $tuplasaafectadas = pg_affected_rows($result);
                                                            pg_free_result($result);

                                                            }


                                                            $registro_exitoso='1';

                                                            $mensaje1=' Registro exitoso';
                                                            $mensaje2=' Los datos fueron registrados correctamente ';


                                                            }

                                                            else{

                                                                $registro_exitoso='10';

                                                            $mensaje1=' Registro Incorrecto';
                                                            $mensaje2=' No existe fotografía reciente en la base de datos';  //' El qr no fue escaneado en un rango de tiempo válido (3 min)';


                                                            }



                                                            }


                                                            }
                                                            else{

                                                            $registro_exitoso='10';

                                                            $mensaje1=' Registro Incorrecto';
                                                            $mensaje2=' No se registro porque el usuario actualmente ya se encuentra en algún parqueo, puedes cerrar esta ventana';


                                                            }


                                                            if(strlen($registro_exitoso)==1){

                                                            $separada = explode(' ', $hora_deteccion_entrada);

                                                            $separada2 = explode('-', $separada[0]);

                                                            $separada3 = explode(':', $separada[1]);

                                                            $hora_min_entrada = $separada3[0]. ':'.$separada3[1];

                                                            $fecha_formato_entrada = $separada2[2].'/'.$separada2[1];

                                                            $timestamp_entrada = '('.$fecha_formato_entrada. ' a las ' . $hora_min_entrada. ')';
                                                            

                                                            }

                                          


                                                            if(strlen($registro_exitoso)==1){

                                                           
                                                                echo "\n";
                                                                      echo $deteccion_entrada;
                                                                      
                                                                      
                                                                      echo '     -->     ';
                                                                         echo $timestamp_entrada;
                                                                       
                                                               
                                                              }
                                                      
                                                             
                                                      
                                                              echo "\n";
                                                             echo $mensaje2;
                                                             echo "\n";
                                                               
                                                         
                                                      
                                                      


        


}


}




?>



