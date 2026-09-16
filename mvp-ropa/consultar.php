<?php
include 'config/conexion.php';
$resultado = $conexion->query("SELECT * FROM prendas ORDER BY id DESC");
?>
<table>
<tr>nombretallacolorpreciostock<th>Acciones</th></tr>
<?php while ($fila = $resultado->fetch_assoc()): ?>
<tr>
<?= htmlspecialchars($fila["descripcion"]) ?><?= htmlspecialchars($fila["talla"]) ?><?= htmlspecialchars($fila["color"]) ?><?= htmlspecialchars($fila["precio"]) ?><?= htmlspecialchars($fila["stock"]) ?>
    <td>
        <a href="editar.php?id=<?= $fila['id'] ?>">Editar</a>
        <a href="eliminar.php?id=<?= $fila['id'] ?>">Eliminar</a>
    </td>
</tr>
<?php endwhile; ?>
</table>