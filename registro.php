
<?php


if(!isset($_COOKIE["id_usuario"])){

}



else{    
  header("Location: index.php");

}  
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Parkiate-ki (Administrador)</title>

  <!-- Favicons -->
  <link href="img/favicon1.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  
  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  

</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">

            <h4><i class="fa fa-angle-right"></i> Ingrese los siguientes datos para crear una cuenta</h4>

            <div class="form">
              <form class="cmxform form-horizontal style-form" id="signupForm" method="POST" action="formularios/register.php" onsubmit ="return matchPassword()" > <!-- action="formularios/response.php"-->
   
            

                <div class="form-group ">
                  <label for="email" class="control-label col-lg-3">
                  <i class="fa fa-envelope"></i>    

                  Email


                
                </label>
                  <div class="col-lg-8">
                    <input class="form-control" id="email" name="email" type="email" required />
                  </div>
                </div>

                
                <div class="form-group ">
                  <label for="email" class="control-label col-lg-3">
                    
                  <i class="fa fa-user"></i>    

                  Nombre (nombre + apellido):</label>
                  <div class="col-lg-8">
                    <input class="form-control" id="nombre" name="nombre" type="text" required />
                  </div>
                </div>


                
                <div class="form-group ">
                  <label for="email" class="control-label col-lg-3">
                    
                  <i class="fa fa-mobile"></i>    

                  Teléfono:
                
                </label>
                  <div class="col-lg-8">
                    <input class="form-control" id="telefono" name="telefono" type="number" required />
                  </div>
                </div>
        




                <div class="form-group" id="contrasenia_input">
                  <label for="password" class="control-label col-lg-3">
                    
                  <i class="fa fa-key"></i>    

                  Contraseña
                </label>
                  <div class="col-lg-8">
                    <input class="form-control" id="password" name="password" minlength="8" type="password" required />
                  </div>

               
                </div>
                <div class="form-group" id="contrasenia_input2">
                  <label for="confirm_password" class="control-label col-lg-3">
                  
                  <i class="fa fa-check"></i>    

                  Confirmar Contraseña</label>
                  <div class="col-lg-8">
                    <input class="form-control" id="confirm_password" name="confirm_password" minlength="8" type="password" required />

                    <p class="help-block" id="mensaje"></p>


                  </div>
                </div>
              
          
                <div class="form-group">
                  <div class="col-lg-offset-3 col-lg-8"> 
                    <button class="btn btn-theme" type="submit">Confirmar</button>
                    <button class="btn btn-theme01" type="button">
                      
                      <span>
                        <a href="login.php">Cancelar</a></span>
                      </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /form-panel -->
        </div>
        <!-- /col-lg-12 -->
      </div>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <!--BACKSTRETCH-->
  
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  
  
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script src="lib/common-scripts.js"></script>
  <script src="lib/form-validation-script.js"></script>

 
 


  <script>
    $.backstretch("img/fondo.jpg", {
      speed: 500
    });


      
function matchPassword() {  

  
  var pw1 = document.getElementById("password").value;  

  console.log(pw1);
  var pw2 = document.getElementById("confirm_password").value;  

  console.log(pw2);
  if(pw1 != pw2)  
  {   
    document.getElementById("contrasenia_input").className = "form-group has-error";
    document.getElementById("contrasenia_input2").className = "form-group has-error";
    document.getElementById("mensaje").innerHTML = "Las contraseñas NO coinciden";

    return false 
  } 

 
  alert("Usuario creado correctamente");  


 
}  


  </script>
</body>

</html>
