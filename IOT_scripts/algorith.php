

<?php



/*




SENSOR DETECTA?

   NO
        NADA

  
  SI
       ENVIA IMAGEN A API
                         RESULTADO VALIDA?

                                            NO
                                                LUZ AMARILLA->MENSAJE: NO HAY PLACA EN LA IMAGEN
                                                


                                            SI
                                                ES IGUAL A LA ULTIMA PLACA? (CON UN TIMESTAMP MENOR A 3 MIN)
                                                     NO

                                                          Registrar camara de entrada
                                                          PLACA CUMPLE FORMATO?

                                                                              NO
                                                                                  Registrar placa_entrada_salida con error=S  y ID_auto_entrada=NA
                                                                                  LUZ VERDE PERO INDICANDO->MENSAJE: PROBABLE ERROR
                                                                                  
                                                                            



                                                                              SI

                                                                                      

                                                                                            Registrar camara de entrada
                                                                                            Registrar placa_entrada_salida

                                                                                            AUTO EXISTENTE EN EL PARQUEO? BUSCAR ID_PARQUEO + PLACA_OBTENIDA
                                                                                                            NO
                                                                                                                CREAR AUTO (NUEVO ID_AUTO) 

                                                                                                            SI
                                                                                                              
                                                                                                              obtener auto (ID_AUTO)
                                                                                            
                                                                                            UPDATE DE registrar autos
                                                                                          
                                                                                            LUZ VERDE->MENSAJE: ("PLACA DETECTADA" + ERROR N)



                                                     SI

                                                               LUZ AMARILLA->MENSAJE: IMAGEN REPETITIVA




                                                                                








 */





 
/*

PRIMERA VERSION DE ALGORITMO


SENSOR DETECTA?

   NO
        NADA

  
  SI
       ENVIA IMAGEN A API
                         RESULTADO VALIDA?

                                            NO
                                                LUZ AMARILLA->MENSAJE: NO HAY PLACA EN LA IMAGEN
                                                


                                            SI
                                                PLACA CUMPLE FORMATO?
                                                                      NO
                                                                           Registrar camara de entrada
                                                                           Registrar placa_entrada_salida con error=S  y ID_auto_entrada=NA
                                                                           LUZ AMARILLA->MENSAJE: PROBABLE ERROR
                                                                           
                                                                            



                                                                      SI

                                                                          ES IGUAL A LA ULTIMA PLACA? (CON UN TIMESTAMP MENOR A 3 MIN)
                                                                                NO

                                                                                    Registrar camara de entrada
                                                                                    Registrar placa_entrada_salida

                                                                                    AUTO EXISTENTE EN EL PARQUEO? BUSCAR ID_PARQUEO + PLACA_OBTENIDA
                                                                                                    NO
                                                                                                        CREAR AUTO (NUEVO ID_AUTO) 

                                                                                                    SI
                                                                                                      
                                                                                                      obtener auto (ID_AUTO)
                                                                                    
                                                                                    UPDATE DE registrar autos
                                                                                  
                                                                                    LUZ VERDE->MENSAJE: ("PLACA DETECTADA" + ERROR N)

                                                                                SI

                                                                                   LUZ AMARILLA->MENSAJE: IMAGEN REPETITIVA







 */
//////////////////////////////////////////////TODO:

/*
TODO:QUE SE DEBE HACER PARA REGISTRAR


SENSOR DETECTA?

   NO
        NADA

  
  SI
       ENVIA IMAGEN A API
                         RESULTADO VALIDA?

                                            NO
                                                LUZ AMARILLA->MENSAJE: NO HAY PLACA EN LA IMAGEN
                                                


                                            SI
                                               EXISTEN AUTOS DENTRO?
                                                    
                                                 NO
                                                      LUZ AMARILLA->MENSAJE: NADA QUE REGISTRAR                          
                                

                                                

                                                 SI

                                                    ES IGUAL A LA ULTIMA PLACA (CON UN TIMESTAMP MENOR A 3 MIN)

                                                                                NO
                                                                                      REGISTRAR EN SALIDA
                                                                                      COINCIDE CON ALGUNA PLACA?

                                                                                                                NO
                                                                                                                        ELIMINAR TUPLA DE SALIDA
                                                                                                                        LUZ AMARILLA->MENSAJE: NO COINCIDE

                                                                                                                        




                                                                                                                SI
                                                                                                                        ASIGNAR ID A placas_entrada_salida + editar los campos correspondientes(ENTRADA)

                                                                                                                        EXISTE USUARIO
                                                                                                                                        NO
                                                                                                                                              NO SE HACE NADA

                                                                                                                                        SI


                                                                                                                                              ACTUALIZAR EL CAMPO ID_VISITA_actual de usuario a N





                                                                                                                        
                                                                                                                        
                                                                                                                        AUTO EXISTE?

                                                                                                                                    NO
                                                                                                                                       
                                                                                                                                        NO SE HACE NADA



                                                                                                                                    SI
                                                                                                                                        ACTUALIZAR auto, con placa+ id_parqueo , numeros de visitas+1


                                                                              
                                                                                                                                                        
 

                                                                                                                                        




                                                                                                                          






                                                                                SI

                                                                                      LUZ AMARILLA->MENSAJE: IMAGEN REPETIDA
                                                                               
                                              

                                                                          






 */


?>



