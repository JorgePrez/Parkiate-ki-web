
<?php

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



                           ?>



