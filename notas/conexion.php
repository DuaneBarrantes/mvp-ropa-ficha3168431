<?php
// === Datos de conexión a MySQL ===
$servidor = "localhost";   // tu PC
$usuario  = "root";        // usuario XAMPP
$clave    = "";            // contraseña vacía
$base     = "notas_db";    // 👈 tu base

// === Crear el puente (NO cambiar) ===
$conexion = new mysqli($servidor, $usuario, $clave, $base);

// === Verificar errores (NO cambiar) ===
if ($conexion->connect_error) {
    die("❌ Error: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
?>
