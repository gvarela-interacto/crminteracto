<?php
session_start();
include("../../includes/cn.php");

header("Content-Type: application/json");
$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $tabla           = trim($_POST["tabla"] ?? '');
        $setNombre       = trim($_POST["setNombre"] ?? '');
        $relacion        = trim($_POST["relacion"] ?? '');
        $relacionNombre  = trim($_POST["relacionNombre"] ?? '');

        if (empty($tabla) || empty($setNombre)) {
            throw new Exception("Tipo de registro y nombre de registro son obligatorios.");
        }

        // ✅ Validación simple del nombre de tabla para evitar inyección SQL
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tabla)) {
            throw new Exception("Nombre de tabla inválido.");
        }

        // Verificar si ya existe
        $query = "SELECT * FROM `$tabla` WHERE estado <> 'ELIMINADO' AND nombre = ?";
        $stmt = $cnn->prepare($query);
        $stmt->bind_param("s", $setNombre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $response["message"] = "Este registro ya existe en la base de datos.";
        } else {
            if (!empty($relacion) && !empty($relacionNombre)) {
                $insertQuery = "INSERT INTO `$tabla` ($relacionNombre, nombre, estado) VALUES (?, ?, 'ACTIVO')";
                $insertStmt = $cnn->prepare($insertQuery);
                $insertStmt->bind_param("is", $relacion, $setNombre);
            } else {
                $insertQuery = "INSERT INTO `$tabla` (nombre, estado) VALUES (?, 'ACTIVO')";
                $insertStmt = $cnn->prepare($insertQuery);
                $insertStmt->bind_param("s", $setNombre);
            }

            if ($insertStmt->execute()) {
                $response["success"] = true;
                $response["message"] = "Registro agregado exitosamente.";
                $response["new_id"] = $cnn->insert_id;
            } else {
                throw new Exception("Error al agregar el registro: " . $insertStmt->error);
            }

            $insertStmt->close();
        }

        $stmt->close();
    } catch (Exception $e) {
        $response["success"] = false;
        $response["message"] = $e->getMessage();
    }
} else {
    $response["success"] = false;
    $response["message"] = "Método no permitido.";
}

echo json_encode($response);
?>
