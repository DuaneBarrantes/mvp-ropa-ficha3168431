<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar prenda</title>
</head>
<body>

<h1>Registrar nueva prenda</h1>

<form method="POST" action="guardar.php">

    <label>Descripcion:</label>
    <input type="text" name="descripcion" required>
    <br><br>

    <label>Talla:</label>
    <input type="text" name="talla" required>
    <br><br>

    <label>Color:</label>
    <input type="text" name="color" required>
    <br><br>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" min="0" required>
    <br><br>

    <label>Stock:</label>
    <input type="number" name="stock" min="0" required>
    <br><br>

    <button type="submit">Guardar</button>

</form>

<br>

<a href="consultar.php">Ver prendas</a>

</body>
</html>