<?php
session_start();

header("Content-Type: application/json");


unset($_SESSION["logged"]);
unset($_SESSION["uid"]);
unset($_SESSION["nombres"]);
unset($_SESSION["apellidos"]);
unset($_SESSION["correoelectronico"]);
unset($_SESSION["rol"]);
unset($_SESSION["usuario"]);

$response["success"] = true;

echo json_encode($response);

?>

