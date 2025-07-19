<?php
  session_start();
  if(isset($_SESSION["logged"]) && $_SESSION["logged"] === "true"){
    header('Location: index.php');
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEMPLAMOS</title>
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  </head>
  <body>
    <div class="container-scroller" >
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0" style="background:#333; margin-top:-60px">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div style="text-align:center; margin-bottom:20px">
                  <img src="assets/images/logoapp.png" alt="logo">
                </div>
                <h4 style="margin-top:40px">Bienvenid@!</h4>
                <h6 class="fw-light">Inicia sesión para continuar.</h6>
                <form id="frmLogin" class="pt-2">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Nombre de usuario">
                  </div>
                  <div class="form-group" style="margin-top:6px">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn w-100 btn-block btn-primary btn-lg font-weight-medium auth-form-btn">INGRESAR</button>
                  </div>
                  <div class="text-center mt-4 fw-light">
                    power by <a href="https://interacto.co" class="text-primary"><img src="assets/images/powerby.png"></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/login.js"></script>
  </body>
</html>
