<?php
header("Content-Type: application/json");
$rutaBase = __DIR__ . "/../../../includes/";

if (!isset($_POST['carpeta']) || empty(trim($_POST['carpeta']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la carpeta"
    ]);
    exit;
}

$setcarpeta=strtolower(trim($_POST['carpeta']));
$carpeta = preg_replace('/[^a-zA-Z0-9_-]/', '', $setcarpeta);
$rutaCompleta = realpath($rutaBase) . DIRECTORY_SEPARATOR . $carpeta;

if (!is_dir($rutaCompleta)) {
    if (!mkdir($rutaCompleta, 0777, true)) {
        echo json_encode([
            'success' => false,
            'error' => "No se pudo crear la carpeta en la ruta especificada"
        ]);
        exit;
    }
}

$options="<option value=''>-- Seleccione --</option>";
$carpetas = array_filter(scandir($rutaBase), function($item) use ($rutaBase) {
    return is_dir($rutaBase . DIRECTORY_SEPARATOR . $item) && !in_array($item, ['.', '..']);
});
foreach ($carpetas as $carpeta) {
    $options .= "<option value='$carpeta'";
    if($carpeta==$setcarpeta){ $options .= " selected "; }
    $options .=">$carpeta</option>";
}

echo json_encode([
    'success' => true,
    'optiones' => $options,
    'mensaje' => "Carpeta '{$carpeta}' creada exitosamente",
    'ruta' => $rutaCompleta
]);
exit;