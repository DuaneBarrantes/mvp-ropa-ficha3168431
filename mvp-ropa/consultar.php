<?php
include 'config/conexion.php';

$resultado = $conexion->query("SELECT * FROM prenda ORDER BY id DESC");

if (!$resultado) {
    die("ERROR MYSQL: " . $conexion->error);
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>

<main class="contenedor">

    <h1 class="titulo">Lista de prendas</h1>

    <p class="subtitulo">
        Consulta y administra las prendas registradas en el inventario.
    </p>

    <div style="margin-bottom: 20px; text-align: right;">
        <a href="registrar.php" class="boton boton-dorado">
            + Registrar nueva prenda
        </a>
    </div>

    <div class="tabla-contenedor">

        <table>

            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($fila = $resultado->fetch_assoc()): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars($fila["descripcion"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($fila["talla"]) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($fila["color"]) ?>
                        </td>

                        <td>
                            $<?= number_format((float)$fila["precio"], 0, ',', '.') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($fila["stock"]) ?>
                        </td>

                        <td>

                            <div class="acciones">

                                <a
                                    href="editar.php?id=<?= $fila['id'] ?>"
                                    class="boton boton-editar"
                                >
                                    Editar
                                </a>

                                <a
                                    href="eliminar.php?id=<?= $fila['id'] ?>"
                                    class="boton boton-eliminar"
                                    onclick="return confirm('¿Seguro que quieres eliminar este registro?')"
                                >
                                    Eliminar
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</main>

<?php include 'includes/footer.php'; ?>