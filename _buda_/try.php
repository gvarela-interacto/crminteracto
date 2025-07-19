<?php
// Definir la ruta y el nombre del archivo a crear
$rutaArchivo = __DIR__ . "/archivo_generado.html";

$url="https://interacto.com.co";
// Contenido del archivo PHP a escribir
$codigo = <<<PHP
<script>
    location.href=$"$url"

</script>
PHP;


// Escribir el código en el archivo
if (file_put_contents($rutaArchivo, $codigo) !== false) {
    echo "Archivo PHP generado con éxito en: " . $rutaArchivo;
} else {
    echo "Error al crear el archivo.";
}
?>