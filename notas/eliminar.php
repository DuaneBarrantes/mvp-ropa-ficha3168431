<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";
$id = intval($_GET["id"]);

// WHERE obligatorio: sin él borra TODO
$sql = "DELETE FROM calificaciones WHERE id = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("i", $id);
$sentencia->execute();

header("Location: index.php?estado=eliminado");
exit;
?>
