<?php
                        setcookie("id_usuario","",time()-1,"/");
                        setcookie("id_parqueo","",time()-1,"/");                       
                         setcookie("id_parqueo_registrando","",time()-1,"/");


                        header("Location: ./../login.php");
 ?>
              