<?php
include('_loadDataToProcess.php');

$campos='';
$vericar    ="";
$requidos   ="";

$sql                ="\"INSERT INTO ".$tabla ." (";
$sqlCampos          ="";
$sqlCamposInt       ="";
$sqlCamposLet       ="";
$sqlCamposVars      ="";
$scriptUploadSingle ='';
$primero            =true;

$uploadRutaImagenes     = "../../uploads/".$tabla."/imagenes/";
$uploadRutaDocumentos   = "../../uploads/".$tabla."/documentos/";

foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ol         = $dato['ol']       ?? false;
    $rl         = $dato['rl']       ?? false;
    $oc         = $dato['oc']       ?? false;
    $rc         = $dato['rc']       ?? false;

    switch($tipo){
        case 'imagen':
            $vericar.=  '$'.$nombre.'="aaguacateconmngo";'.PHP_EOL;
            $scriptUploadSingle.='if (isset($_FILES["ctr'.$nombre.'"]) && $_FILES["ctr'.$nombre.'"]["error"] === 0) {
                                    $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
                                    $extension = strtolower(pathinfo($_FILES["ctr'.$nombre.'"]["name"], PATHINFO_EXTENSION));
                                    if (!in_array($extension, $allowedExtensions)) {
                                        throw new Exception("Formato de imagen no permitido.");
                                    }

                                    $nombreImagen = date("YmdHis") . rand(1000, 9999) . "." . $extension;
                                    $uploadDir = "'.$uploadRutaImagenes.'";
                                    if (!is_dir($uploadDir)) {
                                        mkdir($uploadDir, 0777, true);
                                    }

                                    $rutaDestino = $uploadDir . $nombreImagen;
                                    if (!move_uploaded_file($_FILES["ctr'.$nombre.'"]["tmp_name"], $rutaDestino)) {
                                        throw new Exception("No se pudo guardar la imagen.");
                                    }

                                    $'.$nombre.'=$nombreImagen;
                                } else {
                                    throw new Exception("No se recibió ninguna imagen.");
                                }'.PHP_EOL;
            break;
        case 'document':
            $vericar.=  '$'.$nombre.'="aaguacate";'.PHP_EOL;
            $scriptUploadSingle.='if (isset($_FILES["ctr'.$nombre.'"]) && $_FILES["ctr'.$nombre.'"]["error"] === 0) {
                                    $allowedExtensions = ["pdf"];
                                    $extension = strtolower(pathinfo($_FILES["ctr'.$nombre.'"]["name"], PATHINFO_EXTENSION));
                                    if (!in_array($extension, $allowedExtensions)) {
                                        throw new Exception("Formato de archivo no permitido.");
                                    }

                                    $nombreImagen = date("YmdHis") . rand(1000, 9999) . "." . $extension;
                                    $uploadDir = "'.$uploadRutaDocumentos.'";
                                    if (!is_dir($uploadDir)) {
                                        mkdir($uploadDir, 0777, true);
                                    }

                                    $rutaDestino = $uploadDir . $nombreImagen;
                                    if (!move_uploaded_file($_FILES["ctr'.$nombre.'"]["tmp_name"], $rutaDestino)) {
                                        throw new Exception("No se pudo guardar la imagen.");
                                    }

                                    $'.$nombre.'=$nombreImagen;
                                } else {
                                    throw new Exception("No se recibió ninguna imagen.");
                                }'.PHP_EOL;
            break;
        default:
            $vericar.=  '$'.$nombre.' = $_POST["ctr'.$nombre.'"] ?? \'\';'. PHP_EOL;
            break;
    }
    


    $herNombre = explode("_", $nombre);
    if($oc=='true'){
        if($nombre!='id'){
            $requidos.='if (empty($'.$nombre.')) {'.PHP_EOL.'$missingFields[] = \''.$herNombre[0].'\';'.PHP_EOL.'}'.PHP_EOL;
            if($primero==true){
                $sqlCampos.= $nombre;
                $sqlCamposInt.="?";
                $sqlCamposVars.="$".$nombre;
                $primero=false;
            } else  {
                $sqlCampos.= ",".$nombre;
                $sqlCamposInt.=",?"; 
                $sqlCamposVars.=", $".$nombre;
            }
            if($tipo == 'int'){ $sqlCamposLet.= 'i'; }else{ $sqlCamposLet.= 's'; }

        }
}
    
}
$sqlCamposLet.='sss';
$sql.=  $sqlCampos.",creado,estado,actualizado) VALUES (".$sqlCamposInt.",?,?,?)\";";

$rutaArchivo        = $rutaBase.$carpeta.'/_save_'.$archivo;
$setTablaTitulo     = strtoupper($tabla);
$setNombreTitulo    = strtoupper($_POST['setTabla']);
$setNombreNomUC     = ucfirst(strtolower($_POST['setTabla']));

if($multimagen!='false'){

    $setTablaImagenes=$tabla.'_imagenes';
    $palabra = rtrim($tabla, 's');
    $setCampoImgen=$palabra.'_id';
    $scriptMultimagen ='$uploadDir = "'.$uploadRutaImagenes.'";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!empty($_FILES["imagenes"]["name"][0])) {
            $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
            foreach ($_FILES["imagenes"]["tmp_name"] as $key => $tmp_name) {
                $filename = $_FILES["imagenes"]["name"][$key];
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $filesize = $_FILES["imagenes"]["size"][$key];

                if (!in_array($extension, $allowedExtensions) || $filesize > 5 * 1024 * 1024) {
                    throw new Exception("Archivo inválido: " . htmlspecialchars($filename));
                }

               $nombreUnico = date("YmdHis") . rand(100000, 999999) . "." . $extension;
               $rutaArchivo = $uploadDir . $nombreUnico;

                if (move_uploaded_file($tmp_name, $rutaArchivo)) {
                    $portada = (!empty($_POST["portadas"][$key]) && $_POST["portadas"][$key] == 1) ? "TRUE" : "FALSE";
                    $queryImg = "INSERT INTO '.$setTablaImagenes.' ('.$setCampoImgen.', imagen, portada, creado, estado) VALUES (?, ?, ?,$creado, \'ACTIVO\')";
                    $stmtImg = $cnn->prepare($queryImg);
                    $stmtImg->bind_param("iss", $lastid, $nombreUnico, $portada);
                    if (!$stmtImg->execute()) {
                        unlink($rutaArchivo);
                        throw new Exception("Error al guardar imagen en la base de datos");
                    }
                    $stmtImg->close();
                } else {
                    throw new Exception("Error al subir la imagen: " . htmlspecialchars($filename));
                }
            }
        }';
}


$setTablaImagenes=$tabla.'_imagenes';
$setCampoImgen=$GetCampoName.'_id';

$codigo = <<<PHP
<?php
    session_start();
    include("../cn.php");
    header("Content-Type: application/json");
    \$response = ["success" => false, "message" => ""];
    if (\$_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        if (!isset(\$cnn) || \$cnn->connect_error) {
            throw new Exception("Error de conexión a la base de datos.");
        }

        $vericar
        
        $requidos

        if (!empty(\$missingFields)) {
            throw new Exception("Por favor, complete los campos obligatorios: " . implode(', ', \$missingFields) . ".");
        }

        $scriptUploadSingle

        \$query=$sql

        if (!\$stmt = \$cnn->prepare(\$query)) {
            throw new Exception("Error al preparar la consulta: " . \$cnn->error);
        }

        \$creado = time();
        \$estado = 'ACTIVO';

        \$codigo= date("ymdHis").str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);

        \$stmt->bind_param("$sqlCamposLet", 
            $sqlCamposVars,
            \$creado,
            \$estado,
            \$creado
        );

        if (!\$stmt->execute()) {
            throw new Exception("No fue posible procesar su solicitud, consulte con el administrador del sistema.");
        }

        \$lastid = \$stmt->insert_id;

        
        $scriptMultimagen


        \$stmt->close();

         \$response["success"] = true;
         \$response["message"] = "Registro guardado exitosamente.";
         \$response["lastid"]  = \$lastid;

    } catch (Exception \$e) {
        \$response["message"] = \$e->getMessage();
    }
}

echo json_encode(\$response, JSON_UNESCAPED_UNICODE);

?>
PHP;

include('_loadDataToProcessEnd.php');

?>