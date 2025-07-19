<?php
  session_start();
  if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== "true"){
    header('Location: login.php');
    exit;
  }

  include('includes/cn.php');
  
  $url  ='includes/dashboards/dashboard.php';
  $urlJs='includes/dashboards/__dashboard.js';
  
  if(isset($_GET['p'])){
      if(is_dir('includes/'.$_GET['p'])){
        $url = 'includes/'.$_GET['p'].'/listado.php';
        $urlJs='includes/'.$_GET['p'].'/__listado.js';
        if(isset($_GET['s'])){
          if(file_exists('includes/'.$_GET['p'].'/'.$_GET['s'].'.php')){
            $url = 'includes/'.$_GET['p'].'/'.$_GET['s'].'.php';
            $urlJs='includes/'.$_GET['p'].'/__'.$_GET['s'].'.js';
          }
        }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>INTERACTO</title>
  <link rel="stylesheet" href="librerias/feather/feather.css">
  <link rel="stylesheet" href="librerias/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="librerias/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="librerias/typicons/typicons.css">
  <link rel="stylesheet" href="librerias/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="librerias/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="assets/css/vertical-layout-light/personalizado.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.css" rel="stylesheet">
  <link href="assets/css/vertical-layout-light/stickynote.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
</head>
<body class="sidebar-dark">
  <div class="container-scroller"> 
    <?php include('includes/_estructura/header.php'); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include('includes/_estructura/menu.php'); ?>
      <div class="main-panel">
        <div class="content-wrapper interContenido">
          <?php include($url); ?>
        </div>
        <?php include('includes/_estructura/footer.php'); ?>
      </div>
    </div>
    <div id="panelDerecho" class="offcanvas-derecha">
      <div class="offcanvas-header">
        <a href="javascrip:void(0)" id="cerrarPanel"><i class="menu-icon mdi mdi-close"></i></a>
        <h5>Cronómetro de actividad</h5>
      </div>
      <div class="offcanvas-body">
          <!--PANEL LATERAL DERECHO-->
      </div>
      <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
        <div id="miToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
          <div class="toast-header">
            <strong class="me-auto" id="toast-title"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body" id="toast-body"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="librerias/js/vendor.bundle.base.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="librerias/chart.js/Chart.min.js"></script>
  <script src="librerias/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="librerias/progressbar.js/progressbar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/off-canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="librerias/progressbar.js/progressbar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/tableExport.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.29.0/libs/jsPDF/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/roundSlider/1.3.3/roundslider.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.scrollbar/0.2.11/jquery.scrollbar.min.js"></script>
  <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
  <script src="assets/js/socket.js"></script>

  <script src="js/stickynotes.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <script src="assets/js/general.js"></script>
  <?php
    if(file_exists($urlJs)){
      echo '<script src="'.$urlJs.'"></script>';
    }
  ?>



</body>
</html>
