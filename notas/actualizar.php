<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";

// Los datos corregidos + el id oculto
$id         = intval($_POST["id"]);
$estudiante = trim($_POST["estudiante"]);
$asignatura = trim($_POST["asignatura"]);
$nota       = trim($_POST["nota"]);


// UPDATE ... SET ... WHERE (nunca sin WHERE)
$sql = "UPDATE calificaciones SET estudiante = ?, asignatura = ?, nota = ?, WHERE id = ?";
$sentencia = $conexion->prepare($sql);
// 4 textos + 1 entero = "ssssi"
$sentencia->bind_param("ssssi", $estudiante, $asignatura, $nota, $id);
$sentencia->execute();
$sentencia->close();
$conexion->close();

// De vuelta a la lista con aviso
header("Location: index.php?estado=editado");
exit;
?>
