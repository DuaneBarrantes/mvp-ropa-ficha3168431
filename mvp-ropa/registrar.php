<?php include 'includes/header.php'; ?>
<?php include 'includes/menu.php'; ?>


<main class="contenedor">

    <h1 class="titulo">
        Registrar prenda
    </h1>

    <p class="subtitulo">
        Agrega una nueva prenda al inventario.
    </p>


    <form
        method="POST"
        action="guardar.php"
        class="formulario"
    >

        <div class="campo">

            <label for="descripcion">
                Descripción
            </label>

            <input
                type="text"
                id="descripcion"
                name="descripcion"
                maxlength="100"
                placeholder="Ej. Chaqueta en jean clásica"
                required
            >

        </div>


        <div class="campo">

            <label for="talla">
                Talla
            </label>

            <input
                type="text"
                id="talla"
                name="talla"
                maxlength="20"
                placeholder="Ej. M"
                required
            >

        </div>


        <div class="campo">

            <label for="color">
                Color
            </label>

            <input
                type="text"
                id="color"
                name="color"
                maxlength="50"
                placeholder="Ej. Azul"
                required
            >

        </div>


        <div class="campo">

            <label for="precio">
                Precio
            </label>

            <input
                type="number"
                id="precio"
                name="precio"
                min="0"
                step="1"
                placeholder="Ej. 162000"
                required
            >

            <small class="ayuda">
                Escribe el precio sin puntos ni símbolos.
            </small>

        </div>


        <div class="campo">

            <label for="stock">
                Stock
            </label>

            <input
                type="number"
                id="stock"
                name="stock"
                min="0"
                step="1"
                placeholder="Ej. 10"
                required
            >

        </div>


        <div class="botones">

            <button
                type="submit"
                class="boton boton-dorado"
            >
                Guardar prenda
            </button>

            <a
                href="consultar.php"
                class="boton"
            >
                Cancelar
            </a>

        </div>

    </form>

</main>


<?php include 'includes/footer.php'; ?>