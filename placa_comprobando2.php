

<?php


//$placa_detectada='P666HDP';


//$placa_necesita_correccion='N';


echo "\n";
echo "ENTRANDO A COMPROBANDO SALIDA";
echo "\n";



$listado_placas_adentro = array('P629BRS', 
                                'P241BCD', 
                                'A453BSV',
                                 'P518FGV', 
                                 'P156CMM',
                                 'P206CKJ',
                                 'O267BBG',
                                 'P171CPH',
                                 'C306KLP',
                                 'P600DQT',
                                'P170HXZ',
                              'P752KWJ',
                              'O409GYV',
                              // UN NUEVO TIPO DE CIFRADO QUE TARDARIA MILLONES DE AÑOS EN DESCIFRARSE
                              'P980CLC',
                              'P001BBB',
                              'P372DZZ',
                              'P394MRN',
                              'P263BPF'
                            );




                              if (in_array($placa_detectada, $listado_placas_adentro)) {
                                echo "\n";

                                echo "Existe:";
                                echo $placa_detectada;

                            } else
                            {
                              echo "\n";

                                      //   $distance = levenshtein($placa_detectada, $value);


                            //ENCONTRAR EL VALOR MEJOR
                                /*
                                CONDICION PROVISIONAL , MAYOR TENGA UN PORCENTAJE VALOR MAYOR A 60% Y PORCENTAJE 2 MENOR O IGUAL A 3


                                SI CUMPLE ESTAS CONDICIONES SE ASIGNA EL NUEVO MAYOR

                                */

                                $porcentaje_similar_mayor=0.0;
                                $levenshtein_numbers_menor=1000;

                                $placa_reemplazo='NA';



                              echo "NO EXISTE IGUAL HACER MAGIA";
                              foreach ($listado_placas_adentro as $i => $value) {
                                echo "\n";   
                                 echo "V.A:";
                                echo $value;
                                echo "\t";   

                                echo "V.O:";
                               echo $placa_detectada;
                               echo "\t";   


                            
                               similar_text($value,$placa_detectada,$porcentaje_similaridad);
                               $porcentaje_similaridad2 = levenshtein($placa_detectada, $value);

                               echo "%1:";
                               echo $porcentaje_similaridad;
                               echo "\t";   

                               echo "%2:";
                               echo $porcentaje_similaridad2;
                               echo "\t";  


                               if(($porcentaje_similaridad > 60.0 )&&($porcentaje_similaridad2<= 3 )){


                                 $porcentaje_similar_mayor=$porcentaje_similaridad;
                                $levenshtein_numbers_menor=$porcentaje_similaridad2;

                                $placa_reemplazo=$value;





                               }

                                
                            }



                           if($placa_reemplazo=='NA'){

                            echo "\n";   
                            echo "NO HAY REEMPLAZO FALLO: LUZ AMARILLA ";
                            echo "\n";
                            echo $placa_detectada; echo " --> "; echo $placa_necesita_correccion;
                            $success=false;


                           }
                           else{

                            $placa_necesita_correccion='N';

                            echo "\n";   
                            echo "VALOR REEMPLAZO: ";
                           echo $placa_reemplazo;  echo " --> "; echo $placa_necesita_correccion;

                           }

                       




                            }


                      


                              



?>



