<?php
header("Content-Type: application/json");

$rutaBase = __DIR__ . "/../../../includes/";

$tabla      = $_POST['setTabla'] ?? '';
if (!isset($_POST['setTabla']) || empty(trim($_POST['setTabla']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la tabla"
    ]);
    exit;
}

$carpeta      = $_POST['setCarpeta'] ?? '';
if (!isset($_POST['setCarpeta']) || empty(trim($_POST['setCarpeta']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la carpeta"
    ]);
    exit;
}

$archivo      = $_POST['setArchivo'] ?? '';
if (!isset($_POST['setArchivo']) || empty(trim($_POST['setArchivo']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la archivo"
    ]);
    exit;
}

$multimagen   = $_POST['setMultimagen'] ?? '';
if (!isset($_POST['setMultimagen']) || empty(trim($_POST['setMultimagen']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la archivo"
    ]);
    exit;
}

$setDatos      = $_POST['setDatos'] ?? '';

$setTablaTitulo = strtoupper($tabla);

$tablaName=$tabla.'Tbl';

?>