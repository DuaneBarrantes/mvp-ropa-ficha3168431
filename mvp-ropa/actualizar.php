<?php
include 'config/conexion.php';

$nombre = $_POST["nombre"];
$talla = $_POST["talla"];
$color = $_POST["color"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];
$id = $_POST['id'];

$stmt = $conexion->prepare("UPDATE prenda SET descripcion = ?, talla = ?, color = ?, precio = ?, stock = ? WHERE id = ?");
$stmt->bind_param("sssdii", $descripcion, $talla, $color, $precio, $stock, $id);
$stmt->execute();

header("Location: consultar.php");
exit;