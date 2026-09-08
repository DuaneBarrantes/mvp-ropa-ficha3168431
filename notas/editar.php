<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";

// Recibimos el id y lo forzamos a número
$id = intval($_GET["id"]);

// Buscamos ESE registro (con ? de siempre)
$sql = "SELECT * FROM calificaciones WHERE id = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("i", $id);
$sentencia->execute();
$resultado = $sentencia->get_result();

// Una sola fila: sin while
$fila = $resultado->fetch_assoc();

// ¿No existe? De vuelta a la lista
if (!$fila) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar calificación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container my-4">
    <h1>Editar calificación</h1>
    <form action="actualizar.php" method="POST" >
        <!-- value = el dato que ya estaba -->
        <input type="text" class="form-control mb-2"
               name="estudiante" required
               value="<?= htmlspecialchars($fila['estudiante']) ?>">
        <input type="text" class="form-control mb-2"
               name="asignatura" required
               value="<?= htmlspecialchars($fila['asignatura']) ?>">
        <input type="text" class="form-control mb-2"
               name="nota" required
               value="<?= htmlspecialchars($fila['nota']) ?>">


        <!-- El usuario no lo ve, pero viaja -->
        <input type="hidden" name="id" value="<?= $fila['id'] ?>">
        <button class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
