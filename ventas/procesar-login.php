<?php
// SIEMPRE en la primera línea
session_start();
require "conexion.php";

$usuario = trim($_POST["usuario"]);
$clave   = $_POST["clave"];

// Buscamos SOLO por usuario, nunca por clave
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("s", $usuario);
$sentencia->execute();
$fila = $sentencia->get_result()->fetch_assoc();

// ¿Existe Y la clave corresponde al hash?
if ($fila && password_verify($clave, $fila["clave"])) {
    // Guardamos quién entró
    $_SESSION["usuario"] = $fila["usuario"];
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}
exit;
?>
