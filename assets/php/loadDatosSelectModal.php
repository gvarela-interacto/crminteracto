<?php
    session_start();
    include('../../includes/cn.php');

    $prnid          = $_POST['prnid'];
    $prncampo       = $_POST['prncampo'];
    $tabla          = $_POST['tabla'];
    $consultaWhere  = $_POST['consultaWhere'];
    $seleccionado   = $_POST['seleccionado'];

    $sql="SELECT $prnid, $prncampo FROM $tabla";
    if($consultaWhere!=''){
        $sql.=" WHERE $consultaWhere";
    }
    $sql.=" ORDER BY $prncampo ASC";
    $resultados = '';
    $result = mysqli_query($cnn, $sql);
    while($row = mysqli_fetch_array($result)){
        $resultados .= '<tr style="cursor:pointer;" onclick="seleccionarFila(this,\''.$row['id'].'\',\''.$row['nombre'].'\')">'.
                            '<td class="zt_celda" style="text-align:center">';
                            if($seleccionado==mb_strtoupper($row['nombre'])){
                               $resultados .='<div class="rwseleccionado"></div>';
                            }             
               $resultados.='</td>'.
                            '<td class="zt_celda">'.mb_strtoupper($row['nombre']) .'</td>'.
                            '<td class="zt_celda"></td>'.
                        '</tr>';
    }
    echo $resultados;

?>