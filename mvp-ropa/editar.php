<?php

include 'config/conexion.php';

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM prenda WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$fila = $resultado->fetch_assoc();

if (!$fila) {
    die("Prenda no encontrada");
}

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar prenda</title>
</head>
<body>

<h1>Editar prenda</h1>

<form method="POST" action="actualizar.php">

    <input type="hidden" name="id" value="<?= htmlspecialchars($fila['id']) ?>">

    <label>Descripcion:</label>
    <input type="text" name="descripcion"
           value="<?= htmlspecialchars($fila['descripcion']) ?>" required>
    <br><br>

    <label>Talla:</label>
    <input type="text" name="talla"
           value="<?= htmlspecialchars($fila['talla']) ?>" required>
    <br><br>

    <label>Color:</label>
    <input type="text" name="color"
           value="<?= htmlspecialchars($fila['color']) ?>" required>
    <br><br>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01"
           value="<?= htmlspecialchars($fila['precio']) ?>" required>
    <br><br>

    <label>Stock:</label>
    <input type="number" name="stock"
           value="<?= htmlspecialchars($fila['stock']) ?>" required>
    <br><br>

    <button type="submit">Actualizar</button>

</form>

<br>

<a href="consultar.php">Volver</a>

<?php include 'includes/footer.php'; ?>

</body>
</html>