<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";

// Los datos corregidos + el id oculto
$id        = intval($_POST["id"]);
$nombre    = trim($_POST["nombre"]);
$categoria = trim($_POST["categoria"]);
$precio    = trim($_POST["precio"]);



// UPDATE ... SET ... WHERE (nunca sin WHERE)
$sql = "UPDATE productos SET nombre = ?, categoria = ?, precio = ?, WHERE id = ?";
$sentencia = $conexion->prepare($sql);
// 4 textos + 1 entero = "ssssi"
$sentencia->bind_param("ssssi", $nombre, $categoria, $precio, $id);
$sentencia->execute();
$sentencia->close();
$conexion->close();

// De vuelta a la lista con aviso
header("Location: index.php?estado=editado");
exit;
?>
