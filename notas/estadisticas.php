<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
require "conexion.php";

// Cuántos hay en total
$sqlTotal = "SELECT COUNT(*) AS total FROM calificaciones";
$total = $conexion->query($sqlTotal)->fetch_assoc()["total"];

// Cuántos hay de cada asignatura
$sqlGrupo = "SELECT asignatura, COUNT(*) AS cantidad
             FROM calificaciones
             GROUP BY asignatura
             ORDER BY cantidad DESC";
$grupos = $conexion->query($sqlGrupo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas | Registro de Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container my-4">
    <h1>📊 Estadísticas</h1>

    <!-- La tarjeta del total -->
    <div class="card text-center mb-4">
        <div class="card-body">
            <h2 class="display-4"><?= $total ?></h2>
            <p>registros en total</p>
        </div>
    </div>

    <h2 class="h5">Distribución por asignatura</h2>
    <?php if ($total > 0) { ?>
        <?php while ($g = $grupos->fetch_assoc()) {
            // Regla de tres: cantidad sobre total
            $porcentaje = round(($g["cantidad"] * 100) / $total);
        ?>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <strong><?= htmlspecialchars($g["asignatura"]) ?></strong>
                <span><?= $g["cantidad"] ?> (<?= $porcentaje ?>%)</span>
            </div>
            <!-- El ancho de la barra ES el porcentaje -->
            <div class="progress">
                <div class="progress-bar bg-success"
                     style="width: <?= $porcentaje ?>%"></div>
            </div>
        </div>
    <?php } ?>

    <a href="index.php" class="btn btn-secondary">Volver</a>

    <footer class="text-center py-4 mt-5 border-top">
        <p class="mb-1"><strong>📝 Registro de Notas</strong></p>
        <p class="mb-1">Creado por: Nombre Uno, Nombre Dos, Nombre Tres</p>
        <p class="text-muted small">SENA · Técnico en Programación de Software · 2026</p>
    </footer>
</body>
</html>
