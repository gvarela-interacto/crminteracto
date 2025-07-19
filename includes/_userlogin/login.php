<?php
session_start();
include("../cn.php");

header("Content-Type: application/json");
$response = ["success" => false, "message" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $username = trim($_POST["username"] ?? '');
        $password = $_POST["password"] ?? '';

        if (empty($username) || empty($password)) {
            throw new Exception("Usuario y contraseña son obligatorios.");
        }

        $query = "SELECT * FROM usuarios WHERE estado <> 'ELIMINADO' AND username = ?";
        $stmt = $cnn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {
                if ($user["estado"] == 'ACTIVO') {
                    $_SESSION["logged"]             = 'true';
                    $_SESSION["uid"]                = $user["id"];
                    $_SESSION["nombres"]            = $user["nombres"];
                    $_SESSION["apellidos"]          = $user["apellidos"];
                    $_SESSION["correoelectronico"]  = $user["correoelectronico"];
                    $_SESSION["whatsapp"]           = $user["whatsapp"];
                    $_SESSION["appId"]              = $user["appId"];

                    $response["success"]            = true;
                    $response["userinfo"] = [
                        "uid"               => $user["id"],
                        "nombres"           => $user["nombres"],
                        "apellidos"         => $user["apellidos"],
                        "correoelectronico" => $user["correoelectronico"],
                        "whatsapp"          => $user["whatsapp"],
                        "appId"             => $user["appId"],
                        "rol"               => $user['rol']
                    ];
                } else {
                    $response["message"] = "Usuario inactivo.";
                }
            } else {
                $response["message"] = "Usuario o contraseña incorrectos.";
            }
        } else {
            $response["message"] = "Usuario o contraseña incorrectos.";
        }

        $stmt->close();
    } catch (Exception $e) {
        $response["message"] = $e->getMessage();
    }
}

echo json_encode($response);
?>
