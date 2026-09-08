<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar | Registro de Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container my-5">
<div class="row justify-content-center">
    <div class="col-md-4">
        <h1 class="h4 mb-3">📝 Ingresar</h1>
        <!-- Si el login falla, volvemos con ?error=1 -->
        <?php if (isset($_GET["error"])) { ?>
            <div class="alert alert-danger">
                Usuario o clave incorrectos.
            </div>
        <?php } ?>
        <form action="procesar-login.php" method="POST">
            <input type="text" class="form-control mb-2"
                   name="usuario" required
                   placeholder="Usuario">
            <!-- type password: se ve con puntos -->
            <input type="password" class="form-control mb-2"
                   name="clave" required
                   placeholder="Contraseña">
            <button class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</div>
</body>
</html>
