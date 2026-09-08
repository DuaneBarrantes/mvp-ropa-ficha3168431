<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
require "conexion.php";

$id = intval($_GET["id"]);
$sql = "SELECT * FROM calificaciones WHERE id = ?";
$sentencia = $conexion->prepare($sql);
$sentencia->bind_param("i", $id);
$sentencia->execute();
$fila = $sentencia->get_result()->fetch_assoc();

if (!$fila) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle | Registro de Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container my-4">
<div class="card">
    <div class="row g-0">
        <div class="col-md-4">
            <?php if (!empty($fila["imagen"])) { ?>
                <img src="imagenes/<?= $fila['imagen'] ?>"
                     class="img-fluid rounded-start">
            <?php } else { ?>
                <div class="bg-light p-5 text-center">
                    Sin foto
                </div>
            <?php } ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h1 class="card-title">
                    <?= htmlspecialchars($fila["estudiante"]) ?>
                </h1>
                <table class="table">
                    <tr><th>Asignatura</th>
                        <td><?= htmlspecialchars($fila["asignatura"]) ?></td></tr>
                    <tr><th>Nota</th>
                        <td><?= htmlspecialchars($fila["nota"]) ?></td></tr>
                    <tr><th>Registrado</th>
                        <td><?= date("d/m/Y g:i a", strtotime($fila["fecha_registro"])) ?></td></tr>
                </table>
                <a href="index.php" class="btn btn-secondary">Volver</a>
                <a href="editar.php?id=<?= $fila['id'] ?>"
                   class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
