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
$DBPASS	=	'';
$DBNAME	=	'crminteracto';

$cnn=mysqli_connect($SERVER,$DBUSER,$DBPASS,$DBNAME);
mysqli_query($cnn, "SET NAMES 'utf8mb4'");
if(mysqli_connect_errno()){
 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
function convertirFechaSpoch($fecha) {
    $date = new DateTime($fecha);
    $formatoSpoch = $date->format('d').' de '.strftime('%B', $date->getTimestamp()).' de ' . $date->format('Y');
    return $formatoSpoch;
}

function formatear_fecha($epoch) {
    if (!is_numeric($epoch)) return '';

    $ahora = time();
    $fecha_actual = date('Y-m-d', $ahora);
    $fecha_dada = date('Y-m-d', $epoch);
    $anio_actual = date('Y', $ahora);
    $anio_dado = date('Y', $epoch);

    $diferencia_dias = floor(($ahora - $epoch) / 86400); // 86400 segundos en un día
    $diferencia_semanas = floor($diferencia_dias / 7);
    $diferencia_meses = floor($diferencia_dias / 30);
    $diferencia_anios = $anio_actual - $anio_dado;

    if ($fecha_dada === $fecha_actual) {
        return 'Hoy';
    } elseif ($diferencia_dias === 1) {
        return 'Ayer';
    } elseif ($diferencia_dias >= 2 && $diferencia_dias <= 7) {
        return 'Hace ' . $diferencia_dias . ' días';
    } elseif ($diferencia_semanas === 1) {
        return 'Hace una semana';
    } elseif ($diferencia_semanas >= 2 && $diferencia_semanas < 4) {
        return 'Hace más de una semana';
    } elseif ($diferencia_meses === 1) {
        return 'Hace un mes';
    } elseif ($diferencia_meses > 1 && $diferencia_anios < 1) {
        return 'Hace más de un mes';
    } elseif ($diferencia_anios >= 2) {
        return '+2 Años';
    } elseif ($anio_dado == $anio_actual) {
        return date('M, d', $epoch);
    } else {
        return date('M, d', $epoch) . ' de ' . $anio_dado;
    }
}


function formatear_hora($timestamp) {
    // Verifica que sea un número válido
    if (!is_numeric($timestamp)) return '';
    return date("H:i:s", $timestamp);
}

/*BASE DE DATOS*/
function loadDatoRelacional($cnn, $tabla, $campo, $getcampo, $where){
    $sql = "SELECT $campo FROM $tabla WHERE $where";
    $result = mysqli_query($cnn, $sql);
    if($row = mysqli_fetch_array($result)){
        $data = $row[$getcampo];
    }else{
        $data = 'Sin información';
    }
    return $data;
}

function loadComboData_empty($control, $modal){
    $data = "";
    $data .= '<div class="dropdown w-100">';
        $data .= '<button class="form-control text-left d-flex justify-content-between align-items-center w-100 customfield" disabled data-modal="'.$modal.'" style="background:#FFF; padding:8px; height:34px" type="button" id="dp'.$control.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $data .= '<span id="cbo'.$control.'">--- Seleccione una opción ---</span>';
            $data .= '<span class="ml-auto dropdown-caret">&#9662;</span>';
        $data .= '</button>';
    $data .= '<div class="dropdown-menu dropdown-menu-cbo w-100" id="'.$control.'_lst" aria-labelledby="dp'.$control.'">';
    $data .= '</div>';
    $data .= '<input type="hidden" name="'.$control.'" id="'.$control.'" value="">';
    $data .= '</div>';
    return $data;
}

function loadComboData($cnn, $tabla, $setCampo, $shCampo, $default, $control, $modal, $allowcreate, $call_funcion='', $argumento=''){
    $sql  = "select id, $setCampo from $tabla";
    if ($argumento!= '') {
        $sql.= " where $argumento";
    }

    $result    = mysqli_query($cnn, $sql);
    
    $dataSet ='';
    
    $defaultName='<i style="color:#999">--- Seleccione una opción ---</i>';
    
    while($row = mysqli_fetch_array($result)){
        if($row['id']==$default){
            $defaultName=$row[$shCampo];
        }
        $getid    = $row['id'];
        $getCampo = $row[$shCampo];
        $dataSet .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes($getCampo).'\', \''.addslashes($getid).'\', \''.addslashes($control).'\', \''.$call_funcion.'\')">'.htmlspecialchars($getCampo).'</a>';
    }

    $data = "";
    $data .= '<div class="dropdown w-100">';
    $data .= '<button class="form-control text-left d-flex justify-content-between align-items-center w-100 customfield" style="background:#FFF; padding:8px; height:34px" type="button" id="dp'.$control.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $data .= '<span id="cbo'.$control.'">'.$defaultName.'</span>';
        $data .= '<span class="ml-auto dropdown-caret">&#9662;</span>';
    $data .= '</button>';
    $data .= '<div class="dropdown-menu dropdown-menu-cbo w-100" id="'.$control.'_lst" aria-labelledby="dp'.$control.'">';
    $data .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\'--- Seleccione una opción ---\', \'\', \'' . addslashes($control) . '\', \''.$call_funcion.'\')"><i style=\'color:#999\'>--- Seleccione una opción ---</i></a>';
    $data .=  $dataSet;
    if($allowcreate=='true'){
        $data .= '<div class="dropdown-divider"></div>';
        $data .= '<a class="dropdown-item text-primary font-weight-bold" href="javascript:void(0)" onclick="shMdl(\''.$modal.'\')">➕ Crear Nuevo</a>';
    }
        $data .= '</div>';
        if($defaultName=='<i style="color:#999">--- Seleccione una opción ---</i>'){
            $setvalurdefault = '';
        }else{
            $setvalurdefault=$default;
        }
        $data .= '<input type="hidden" name="'.$control.'" id="'.$control.'" value="'. $setvalurdefault.'">';
    $data .= '</div>';
    return $data;
}

function loadComboContactosData($cnn, $tabla, $setCampo, $shCampo, $default, $control, $modal, $allowcreate, $call_funcion='', $argumento=''){
    $sql  = "select id, $setCampo from $tabla";
    if ($argumento!= '') {
        $sql.= " where $argumento";
    }

    $result    = mysqli_query($cnn, $sql);
    
    $dataSet ='';
    
    $defaultName='<i style="color:#999">--- Contactos de la cuenta ---</i>';
    
    while($row = mysqli_fetch_array($result)){
        if($row['id']==$default){
            $defaultName=$row[$shCampo];
        }
        $getid    = $row['id'];
        $getCampo = $row[$shCampo];
        $dataSet .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes($getCampo).'\', \''.addslashes("CUENTAUSER==".$getid).'\', \''.addslashes($control).'\', \''.$call_funcion.'\')">'.htmlspecialchars($getCampo).'</a>';
    }
    $dataSet .='<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\'--- Seleccione una opción ---\', \'\', \'' . addslashes($control) . '\', \''.$call_funcion.'\')"><i style=\'color:#999\'>--- Usuarios del Sistema ---</i></a>';

    $result2    = mysqli_query($cnn, "SELECT id,CONCAT(nombres,' ',apellidos,' - ',cargo    ) as getuser FROM usuarios WHERE estado='ACTIVO'");
    while($row2 = mysqli_fetch_array($result2)){
        if($row2['id']==$default){
            $defaultName=$row2['getuser'];
        }
        $getid    = $row2['id'];
        $getCampo = $row2['getuser'];
        $dataSet .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''.addslashes($getCampo).'\', \''.addslashes("SYSUSER==".$getid).'\', \''.addslashes($control).'\', \''.$call_funcion.'\')">'.htmlspecialchars($getCampo).'</a>';
    }

    $data = "";
    $data .= '<div class="dropdown w-100">';
    $data .= '<button class="form-control text-left d-flex justify-content-between align-items-center w-100 customfield" style="background:#FFF; padding:8px; height:34px" type="button" id="dp'.$control.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $data .= '<span id="cbo'.$control.'">'.$defaultName.'</span>';
        $data .= '<span class="ml-auto dropdown-caret">&#9662;</span>';
    $data .= '</button>';
    $data .= '<div class="dropdown-menu dropdown-menu-cbo w-100" id="'.$control.'_lst" aria-labelledby="dp'.$control.'">';
    $data .= '<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\'--- Seleccione una opción ---\', \'\', \'' . addslashes($control) . '\', \''.$call_funcion.'\')"><i style=\'color:#999\'>--- Contactos de la cuenta ---</i></a>';
    $data .=  $dataSet;
    
    $data .= '</div>';
    if($defaultName=='<i style="color:#999">--- Seleccione una opción ---</i>'){
        $setvalurdefault = '';
    }else{
        $setvalurdefault=$default;
    }
    $data .= '<input type="hidden" name="'.$control.'" id="'.$control.'" value="'. $setvalurdefault.'">';
    $data .= '</div>';
    return $data;
}


/**LOGS**/
function log_evento($cnn, $usuario_tipo, $usuario__id, $asocicion, $asocicion__id, $evento, $observaciones, $tabla, $did) {
    if (!$cnn || $cnn->connect_error) {
        error_log("Error de conexión a la base de datos: " . $cnn->connect_error);
        return false;
    }

    $creado = time(); // Formato legible para varchar(30)

    $query = "INSERT INTO logs (
        usuario_tipo, usuario__id, asocicion, asocicion__id, 
        evento, observaciones, tabla, did, creado
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if (!$stmt = $cnn->prepare($query)) {
        error_log("Error en prepare(): " . $cnn->error);
        return false;
    }

    $stmt->bind_param(
        "sisisssis", // Tipos: s=string, i=int
        $usuario_tipo,
        $usuario__id,
        $asocicion,
        $asocicion__id,
        $evento,
        $observaciones,
        $tabla,
        $did,
        $creado
    );

    if (!$stmt->execute()) {
        error_log("Error en execute(): " . $stmt->error);
        $stmt->close();
        return false;
    }

    $stmt->close();
    return true;
}


function escribirLog($mensaje, $archivo = 'logs/app.log') {
    $directorio = dirname($archivo);
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }
    $fecha = date('Y-m-d H:i:s');
    $linea = "[$fecha] $mensaje" . PHP_EOL;
    file_put_contents($archivo, $linea, FILE_APPEND | LOCK_EX);
}


/*END*/

function hexToRgb($hex, $tra) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "rgb($r, $g, $b, $tra)";
}

function formatearSoloFecha($timestamp) {
    $meses = array(
        1 => 'Enero', 
        2 => 'Febrero', 
        3 => 'Marzo', 
        4 => 'Abril', 
        5 => 'Mayo', 
        6 => 'Junio', 
        7 => 'Julio', 
        8 => 'Agosto', 
        9 => 'Septiembre', 
        10 => 'Octubre', 
        11 => 'Noviembre', 
        12 => 'Diciembre'
    );
    $hoy = strtotime('today');
    $ayer = strtotime('yesterday');
    $fechaDelTimestamp = strtotime(date('Y-m-d', $timestamp));
    $hora = date('h:i:s a', $timestamp);
    $hora = str_replace(['am', 'pm'], ['a. m.', 'p. m.'], $hora);
    $dia = date('d', $timestamp);
    $mes = date('n', $timestamp);
    $anio = date('Y', $timestamp);
    return $meses[$mes] . ' ' . $dia . ', ' . $anio ;
}

function formatearFecha($timestamp) {
    $meses = array(
        1 => 'enero', 
        2 => 'febrero', 
        3 => 'marzo', 
        4 => 'abril', 
        5 => 'mayo', 
        6 => 'junio', 
        7 => 'julio', 
        8 => 'agosto', 
        9 => 'septiembre', 
        10 => 'octubre', 
        11 => 'noviembre', 
        12 => 'diciembre'
    );
    $hoy = strtotime('today');
    $ayer = strtotime('yesterday');
    $fechaDelTimestamp = strtotime(date('Y-m-d', $timestamp));
    $hora = date('h:i:s a', $timestamp);
    $hora = str_replace(['am', 'pm'], ['a. m.', 'p. m.'], $hora);
    if ($fechaDelTimestamp == $hoy) {
        return $hora;
    } elseif ($fechaDelTimestamp == $ayer) {
        return 'Ayer, ' . $hora;
    } else {
        $dia = date('d', $timestamp);
        $mes = date('n', $timestamp);
        $anio = date('Y', $timestamp);
        return $meses[$mes] . ' ' . $dia . ', ' . $anio . ' ' . $hora;
    }
}

function generarCadenaSesion() {
    $dia = date('d');
    $mes = date('m');
    $anio = date('Y');
    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');
    $random = mt_rand(1000, 9999); 
    $cadena = $dia . $mes . $anio . $hora . $minuto . $segundo . $random;
    return $cadena;
}



function enviarMensajePublicidad($telefono, $template, $nombres) {
    $data = [
        'telefono' => $telefono,
        'template' => $template,
        'nombres' => $nombres,
    ];
    $url = 'https://www.interacto.co:3002/sendMessageFormSystemTemplate?' . http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) { return false; } else { return true; }
    curl_close($ch);
}

function notificar($sede, $telefono, $mensaje) {
    $data = [
        'sede'          => $sede,
        'telefono'      => $telefono,
        'mensaje'       => $mensaje
    ];
    $url = 'https://www.interacto.co:3005/sendNotificacion?' . http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) { return false; } else { return true; }
    curl_close($ch);
}

function numeroALetras($numero) {
    $unidades = [
        '', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve',
        'diez', 'once', 'doce', 'trece', 'catorce', 'quince',
        'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve', 'veinte'
    ];
    $decenas = [
        '', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta',
        'sesenta', 'setenta', 'ochenta', 'noventa'
    ];
    $centenas = [
        '', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
        'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'
    ];

    if (!is_numeric($numero)) {
        return 'Número no válido';
    }

    $numero = number_format($numero, 2, '.', '');
    $partes = explode('.', $numero);
    $entero = (int)$partes[0];
    $decimal = (int)$partes[1];

    if ($entero === 0) {
        $resultado = 'cero';
    } else {
        $resultado = convertirNumero($entero);
    }

    if ($decimal > 0) {
        $resultado .= ' con ' . convertirNumero($decimal);
    }

    return $resultado;
}

function convertirNumero($numero) {
    $escala = [
        12 => 'billón',
        9 => 'mil millones',
        6 => 'millón',
        3 => 'mil',
        0 => ''
    ];

    $resultado = '';

    foreach ($escala as $exp => $nombre) {
        if ($numero >= pow(10, $exp)) {
            $parte = floor($numero / pow(10, $exp));
            $numero = $numero % pow(10, $exp);

            if ($exp == 6 || $exp == 12) {
                if ($parte == 1) {
                    $resultado .= ' un ' . $nombre;
                } else {
                    $resultado .= ' ' . convertirNumero($parte) . ' ' . $nombre . 'es';
                }
            } elseif ($exp == 3) {
                if ($parte == 1) {
                    $resultado .= ' mil';
                } else {
                    $resultado .= ' ' . convertirNumero($parte) . ' mil';
                }
            } else {
                $resultado .= ' ' . convertirCentenas($parte);
            }
        }
    }

    return trim($resultado);
}

function convertirCentenas($numero) {
    $unidades = [
        '', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve',
        'diez', 'once', 'doce', 'trece', 'catorce', 'quince',
        'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve', 'veinte'
    ];
    $decenas = [
        '', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta',
        'sesenta', 'setenta', 'ochenta', 'noventa'
    ];
    $centenas = [
        '', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
        'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'
    ];

    if ($numero == 100) {
        return 'cien';
    }

    $c = floor($numero / 100);
    $r = $numero % 100;

    $texto = '';
    if ($c > 0) {
        $texto .= $centenas[$c] . ' ';
    }

    if ($r <= 20) {
        $texto .= $unidades[$r];
    } else {
        $d = floor($r / 10);
        $u = $r % 10;
        $texto .= $decenas[$d];
        if ($u > 0) {
            $texto .= ' y ' . $unidades[$u];
        }
    }

    return trim($texto);
}


function convertirFechaClasica($fecha) {
    $meses = [
        1 => "Enero", 2 => "Febrero", 3 => "Marzo",
        4 => "Abril", 5 => "Mayo", 6 => "Junio",
        7 => "Julio", 8 => "Agosto", 9 => "Septiembre",
        10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    ];

    $partes = explode('-', $fecha);
    $anio = $partes[0];
    $mes = (int)$partes[1];
    $dia = (int)$partes[2];

    return "{$meses[$mes]} $dia, $anio";
}


function uploadToGemini($filePath, $mimeType, $apiKey) {
    $url = "https://generativelanguage.googleapis.com/v1beta/files?key=$apiKey";
    $fileData = [
        'file' => new CURLFile($filePath, $mimeType, basename($filePath))
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fileData);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

function waitForFileActive($fileId, $apiKey) {
    $url = "https://generativelanguage.googleapis.com/v1beta/files/$fileId?key=$apiKey";
    
    do {
        sleep(10);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $fileInfo = json_decode($response, true);
    } while ($fileInfo['state'] === 'PROCESSING');
    
    if ($fileInfo['state'] !== 'ACTIVE') {
        throw new Exception("File failed to process");
    }
    
    return $fileInfo;
}

function sendMessageToGemini($fileId, $apiKey, $prompt) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateMessage?key=$apiKey";
    
    $data = [
        "generationConfig" => [
            "temperature" => 1,
            "topP" => 0.95,
            "topK" => 40,
            "maxOutputTokens" => 8192,
            "responseMimeType" => "text/plain"
        ],
        "history" => [
            [
                "role" => "user",
                "parts" => [
                    ["fileData" => [
                        "mimeType" => "application/pdf",
                        "fileUri" => "files/$fileId"
                    ]],
                    ["text" => $prompt]
                ]
            ]
        ]
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}


?>


