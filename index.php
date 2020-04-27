<?php
ob_start();
include("Config/usuario.php");
$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");
//include ("php/header_index.php");
session_start();
$user = new Usuario;
//var_dump($_POST);
if(!empty($_POST))
{
    if($user->login($_POST))
    {
        header("Location: inicio.php");
    }
    else
    {
        header("Location: index.php");
    }
}
if(isset($_SESSION["token"]))
{
    header("Location: inicio.php");
}
ob_end_flush();

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Login</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="./images/demo/BennettsN.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <style type="text/css">
    .card {
          padding: 15px;
          max-width: 400px;
          height: auto;
          margin: 10px auto;
          text-align: center;
      }
      /* /end custom style for login page */

      body {
          background-color: rgb(224, 224, 224);
      }

      p {
          margin-top: 20px;
          margin-bottom: 10px;
      }

       h1, h3 {
          margin-top: 30px;
      }
  </style>
  </head>

  <body bgcolor="#ffffff">
    <div class="container-fluid" style="background-color: ffffff;">
    <br><br><br>
      <div class="row" style="background-color: ffffff;">
        <div class="col-lg-12" style="background-color: ffffff;">
          <div class="card">
            <div class="login">

              <!-- <img src="images/demo/BennettsN.jpg" class="img-responsive" width="300px" style="margin-top: 5%">-->
              <label for=""><img src="Resources/key.png" alt="Key logo"></label>
              <br><br><br>
              <form method="POST" id="sesion" action="">
                <div class="form-group">
                  <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Sucursal" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control input-lg" name="pwd" id="pwd" placeholder="Contraseña" required>
                </div>
                  <button name="acceder" id="acceder" class="btn btn-info btn-block">Iniciar sesión</button>
              </form>
              <!-- Collapse a form when user click Lost your password? link-->
             <!-- <hr><p>Tienes cuenta ? <a href="registro.php" title="Crear Cuenta">Crear Cuenta</a>.</p>   -->
            </div><!-- /.loginBox -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!--/.row-->
    </div><!-- /.container -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="views/js/jquery-3.1.1.min.js"  crossorigin="anonymous"></script>
    <script src="views/js/popper.min.js"  crossorigin="anonymous"></script>
    <script src="views/js/bootstrap.min.js" crossorigin="anonymous"></script>
  </body>
</html>