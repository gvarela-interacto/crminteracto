<?php
    if (file_put_contents($rutaArchivo, $codigo) !== false) {
        echo json_encode(["success" => true, "message" => "Archivo ".$rutaArchivo." generado."]);
    } else {
        echo json_encode(["success" => false, "error" => "No fue posible construir el archivo."]);
    }
?>