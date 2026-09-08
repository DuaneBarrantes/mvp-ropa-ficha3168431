<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// Traemos la conexión que hicimos en la Sesión 2.
require 'conexion.php';

// Recibimos lo que envió el formulario.
// El texto dentro de [ ] es el name= de cada campo.
$estudiante = $_POST['estudiante'];
$asignatura = $_POST['asignatura'];
$nota       = $_POST['nota'];

// ===== Sesión 7: recibir y mover el archivo =====
// Por defecto, sin imagen
$nombreImagen = "";

// ¿Llegó un archivo y sin errores?
if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
    // Sacamos la extensión: jpg, png...
    $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
    // Nombre único: la hora + la extensión
    $nombreImagen = time() . "." . $extension;
    // De la sala de espera a nuestra carpeta
    move_uploaded_file($_FILES["imagen"]["tmp_name"], "imagenes/" . $nombreImagen);
}

// ===== Sesión 4: INSERT con sentencia preparada =====
// 1) PREPARAR: enviamos la FORMA de la orden.
$sql = "INSERT INTO calificaciones (estudiante, asignatura, nota, imagen) VALUES (?, ?, ?, ?)";
$sentencia = $conexion->prepare($sql);

// 2) AMARRAR: ahora sí van los datos, en orden.
// "ssss" = los cuatro son texto (string).
$sentencia->bind_param("ssss", $estudiante, $asignatura, $nota, $nombreImagen);

// 3) EJECUTAR: aquí es cuando la fila se guarda de verdad.
if ($sentencia->execute()) {
    // Salió bien: volvemos al inicio con un aviso.
    header("Location: index.php?estado=ok");
} else {
    // Algo falló: mostramos el motivo para poder corregirlo.
    echo "Error al guardar: " . $conexion->error;
}

// 4) CERRAR: dejamos todo ordenado.
$sentencia->close();
$conexion->close();
?>
