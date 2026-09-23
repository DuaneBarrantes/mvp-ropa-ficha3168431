<?php
include 'config/conexion.php';

$descripcion = $_POST["descripcion"];
$talla = $_POST["talla"];
$color = $_POST["color"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];

$stmt = $conexion->prepare("INSERT INTO prenda (descripcion, talla, color, precio, stock) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssdi", $descripcion, $talla, $color, $precio, $stock);
$stmt->execute();

header("Location: consultar.php");
exit;