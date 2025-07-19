<?php
    session_start();
    include('../../includes/cn.php');

    $prnid          = $_POST['prnid'];
    $prncampo       = $_POST['prncampo'];
    $tabla          = $_POST['tabla'];
    $consultaWhere  = $_POST['consultaWhere'];
    $setcontrol     = $_POST['setcontrol'];
    $call_funcion   = $_POST['call_funcion'];
    $modal          = $_POST['modal'];
    $camporeferencia    = $_POST['camporeferencia'];
    $idreferencia       = $_POST['idreferencia'];

    $resultados = '<a class="dropdown-item" style="color:#999; font-style:italic" href="#" onclick="seleccionarOpcion(\''.'-- Seleccione --'.'\', \'\', \''.addslashes($setcontrol).'\', \''.$call_funcion.'\')">-- Seleccione --</a>';
    $sql="SELECT $prnid, $prncampo FROM $tabla WHERE $consultaWhere ORDER BY $prncampo ASC";
    $result = mysqli_query($cnn, $sql);
    while($row = mysqli_fetch_array($result)){
        $resultados .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes(mb_strtoupper($row[$prncampo])).'\', \''.addslashes($row[$prnid]).'\', \''.addslashes($setcontrol).'\', \''.$call_funcion.'\')">'.htmlspecialchars(mb_strtoupper($row[$prncampo])).'</a>';
    }
    if($modal!=''){
        $resultados .= '<div style="padding:0px 20px; margin-top:10px"><a class="dropdown-item btn btn-secondary btn-sm" href="#" style="display: flex; align-items: center; justify-content: center;" onclick="abrirModal(\''.$modal.'\',\''.$tabla.'\',\'id\',\'nombre\',\''.$consultaWhere.'\',\''.$camporeferencia.'\',\''.$idreferencia.'\',\''.addslashes($setcontrol).'\',\''.$call_funcion.'\')"><i class="menu-icon mdi mdi-plus" style="margin-right: 5px;"></i> Agregar nuevo</a></div>';
    }
    echo $resultados;

?>