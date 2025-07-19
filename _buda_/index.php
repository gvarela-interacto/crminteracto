<?php include('../includes/cn.php'); ?>

<?php 

    /*
    if($APP_GESTOR=='FALSE'){
        header('location: ../');
    }
    */

    $link = "includes/dashboard.php";
    if(isset($_GET['m'])){
        if(file_exists("includes/".$_GET['m'].'.php')){
            $link="includes/".$_GET['m'].'.php';
        }
    }
 ?>

<html lang="es">
    <head>
        <title>OWN FRAMEWORK</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body{padding:10px 0px 0px 0px}
            .tabs {
                display: flex;
                cursor: pointer;
                padding-left:10px;
            }
            .tab {
                padding: 10px 20px;
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                margin-right: 5px;
            }
            .tab.active {
                background-color: #fff;
                border-bottom: none;
            }
            .tab-content {
                padding: 4px;
                display: none;
                width:100%;
            }
            .tab-content.active {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid"> 
            <?php include($link); ?>
        </div>
            
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/general.js"></script>
</html>

