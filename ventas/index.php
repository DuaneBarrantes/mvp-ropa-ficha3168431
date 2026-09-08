<?php
// ===== Sesión 7: protección con sesión =====
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// ===== Sesión 2: traemos la conexión =====
require "conexion.php";

// ===== Sesión 5: SELECT + buscador con LIKE =====
$busqueda = isset($_GET["buscar"]) ? trim($_GET["buscar"]) : "";

if ($busqueda != "") {
    // CON búsqueda: filtramos con LIKE
    $sql = "SELECT * FROM productos WHERE nombre LIKE ? ORDER BY id DESC";
    $sentencia = $conexion->prepare($sql);
    $patron = "%" . $busqueda . "%";
    $sentencia->bind_param("s", $patron);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
} else {
    // SIN búsqueda: mostramos todo
    $sql = "SELECT * FROM productos ORDER BY id DESC";
    $resultado = $conexion->query($sql);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO: describe tu página -->
    <meta name="description" content="Sistema de gestión de ventas">
    <title>Ventas</title>
    <!-- Bootstrap: NO cambiar esta línea, trae todo el estilo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* 🟢 Tema de color — Sesión 3. Elige UNO y descomenta si no quieres el azul (Océano) por defecto */
        /* 🌅 Atardecer
        .bg-primary{background:#ea580c !important;}
        .btn-primary{background:#ea580c;border:none;}
        */
        /* 🌲 Bosque
        .bg-primary{background:#059669 !important;}
        .btn-primary{background:#059669;border:none;}
        */
        /* 🌊 Océano: no agregues nada, ya es azul por defecto */
        img.miniatura{object-fit:cover;}
    </style>
</head>
<body>

<header>
    <!-- nav = barra de navegación (semántica) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">🛒 Ventas</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gestion">Gestión</a></li>
                    <li class="nav-item"><a class="nav-link" href="estadisticas.php">📊 Estadísticas</a></li>
                </ul>
                <span class="navbar-text me-3 ms-lg-3">
                    👤 Hola, <?= htmlspecialchars($_SESSION["usuario"]) ?>
                </span>
                <a href="salir.php" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
            </div>
        </div>
    </nav>
</header>

<main class="container my-4" id="inicio">

    <?php
    // ===== Sesión 6: mensajes de aviso (guardado / editado / eliminado) =====
    if (isset($_GET["estado"])) {
        $avisos = [
            "ok"        => "✅ Registro guardado correctamente.",
            "editado"   => "✏️ Registro actualizado correctamente.",
            "eliminado" => "🗑️ Registro eliminado."
        ];
        $clave = $_GET["estado"];
        if (isset($avisos[$clave])) {
            echo "<div class='alert alert-success'>" . $avisos[$clave] . "</div>";
        }
    }
    ?>

    <section id="gestion">
        <h2>Registrar producto</h2>
        <!-- Sesión 7: enctype para poder subir la imagen -->
        <form action="guardar.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <input type="text" class="form-control mb-2"
                   name="nombre" placeholder="Nombre" required>
            <input type="text" class="form-control mb-2"
                   name="categoria" placeholder="Categoría" required>
            <input type="text" class="form-control mb-2"
                   name="precio" placeholder="Precio" required>
            <input type="file" class="form-control mb-2"
                   name="imagen" accept="image/*">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </section>

    <!-- Sesión 5: buscador (method GET) -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col">
            <input type="text" class="form-control"
                   name="buscar"
                   placeholder="Buscar producto..."
                   value="<?= htmlspecialchars($busqueda) ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Buscar</button>
            <a href="index.php" class="btn btn-secondary">Ver todos</a>
        </div>
    </form>

    <h2>Productos registrados</h2>
    <?php if ($resultado->num_rows > 0) { ?>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Este while saca las filas una por una -->
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?= $fila["id"] ?></td>
                    <td>
                        <?php if (!empty($fila["imagen"])) { ?>
                            <img src="imagenes/<?= $fila['imagen'] ?>"
                                 class="rounded miniatura"
                                 width="60" height="60">
                        <?php } else { ?>
                            <span class="text-muted">Sin foto</span>
                        <?php } ?>
                    </td>
                    <td><?= htmlspecialchars($fila["nombre"]) ?></td>
                    <td><?= htmlspecialchars($fila["categoria"]) ?></td>
                    <td><?= htmlspecialchars($fila["precio"]) ?></td>
                    <td>
                        <a class="btn btn-sm btn-info"
                           href="detalle.php?id=<?= $fila['id'] ?>">🔍 Ver</a>
                        <!-- El id viaja pegado al enlace -->
                        <a class="btn btn-sm btn-warning"
                           href="editar.php?id=<?= $fila['id'] ?>">✏️ Editar</a>
                        <!-- onclick pregunta antes de dejar pasar -->
                        <a class="btn btn-sm btn-danger"
                           href="eliminar.php?id=<?= $fila['id'] ?>"
                           onclick="return confirm('¿Seguro que desea eliminar este registro?')">🗑️ Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Todavía no hay productos registrados.</p>
    <?php } ?>

</main>

<!-- Sesión 8: pie de página con créditos -->
<footer class="text-center py-4 mt-5 border-top">
    <p class="mb-1"><strong>🛒 Ventas</strong></p>
    <p class="text-muted small">SENA · Técnico en Programación de Software · 2026</p>
</footer>

<!-- JS de Bootstrap: hace funcionar el menú ☰ en móvil (NO cambiar) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
