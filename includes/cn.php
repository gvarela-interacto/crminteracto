<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Content-Type: text/html;charset=utf-8");
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

date_default_timezone_set("America/Bogota");

$SERVER	=	'localhost';
$DBUSER	=	'root';
$DBPASS	=	'M@j0309!mysql**';
$DBNAME	=	'templamos';

$cnn=mysqli_connect($SERVER,$DBUSER,$DBPASS,$DBNAME);
mysqli_query($cnn, "SET NAMES 'utf8mb4'");
if(mysqli_connect_errno()){
 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

/*GESTION DB*/
function loadCampoDescriptivo($pdo, $tabla, $regla, $prncampo, $consultaWhere, $notfound = '') {
    if (empty($tabla) || empty($regla) || empty($prncampo) || empty($consultaWhere)) {
        throw new Exception("Error: parámetros incompletos para la consulta.");
    }
    $sql = "SELECT $regla FROM $tabla WHERE $consultaWhere ORDER BY id ASC LIMIT 1";
    try {
        $stmt = $pdo->query($sql);
        $row  = $stmt->fetch_assoc();
        if ($row && isset($row[$prncampo])) {
            return mb_strtoupper($row[$prncampo]);
        } else {
            return $notfound;
        }
    } catch (PDOException $e) {
        return "Error SQL: " . $e->getMessage();
    }
}


function controlSelect($tipocontrol, $origendatos, $tabla, $regla, $prncampo, $prnid, $consultaWhere, $controlname, $setDisabled='', $call_funcion='', $modal=''){
    $resultados = '';
    $resultados .= '<div class="dropdown w-100">';
        $resultados .= '<button '.$setDisabled.' class="form-control text-left d-flex justify-content-between align-items-center w-100 customfield" data-modal="" style="background:#FFF; padding:8px; height:34px" type="button" name="btn'.$controlname.'" id="btn'.$controlname.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $resultados .= '<span id="des'.$controlname.'">-- Seleccione --</span>';
            $resultados .= '<span class="ml-auto dropdown-caret">&#9662;</span>';
        $resultados .= '</button>';
        $resultados .= '<div class="dropdown-menu dropdown-menu-cbo w-100" id="'.$controlname.'_lst" aria-labelledby="btn'.$controlname.'">';
        $resultados .= '<a class="dropdown-item" style="color:#999; font-style:italic" href="#" onclick="seleccionarOpcion(\''.'-- Seleccione --'.'\', \''.''.'\', \''.addslashes($controlname).'\', \''.$call_funcion.'\')">-- Seleccione --</a>';

    switch($tipocontrol){
        case 'VACIO':
            $resultados .= '';
            break;
        case 'VLRMANUAL':
            $getDatos = explode(',', $origendatos);
            foreach ($getDatos as $dato) {
                $resultados .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes($dato).'\', \''.addslashes($dato).'\', \''.addslashes($controlname).'\', \''.$call_funcion.'\')">'.htmlspecialchars($dato).'</a>';
            }
            break;
        case 'DBBASICO':
            if (empty($tabla) || empty($regla) || empty($prncampo) || empty($prnid) || empty($consultaWhere)) {
                throw new Exception("Error: parámetros incompletos para la consulta.");
            }
            $sql = "SELECT $regla FROM $tabla WHERE $consultaWhere ORDER BY $prncampo ASC";
            try {
                $result = $origendatos->query($sql);
                if (!$result) {
                    return "Error SQL: " . $origendatos->error;
                }
                while ($row = $result->fetch_assoc()) {
                    if (isset($row[$prncampo])) {
                        $resultados .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes(mb_strtoupper($row[$prncampo])).'\', \''.addslashes($row[$prnid]).'\', \''.addslashes($controlname).'\', \''.$call_funcion.'\')">'.mb_strtoupper(htmlspecialchars($row[$prncampo])).'</a>';
                    }
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
            break;
        default:
            throw new Exception("Tipo de control no reconocido: " . $tipocontrol);
    }

    if($modal!=''){
        $resultados .= '<div style="padding:0px 20px; margin-top:10px"><a class="dropdown-item btn btn-secondary btn-sm" href="#" style="display: flex; align-items: center; justify-content: center;" onclick="abrirModal(\''.$modal.'\',\''.$tabla.'\',\'id\',\'nombre\',\'\',\'\',\'\',\''.addslashes($controlname).'\',\''.$call_funcion.'\')"><i class="menu-icon mdi mdi-plus" style="margin-right: 5px;"></i> Agregar nuevo</a></div>';
    }

    $resultados .= '</div>';
    $resultados .= '<input type="hidden" name="'.$controlname.'" id="'.$controlname.'" value="">';
    $resultados .= '</div>';
    return $resultados;
}


?>


