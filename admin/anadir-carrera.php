<?php ob_start(); ?>

<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> Añadir carrera
    </h2>
    <hr>
    <div class="col-9">
        <form action="perfil-carrera.php" method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" required="" class="campo-formulario" placeholder="Introduce el nuevo nombre">
            <label>Universidad:</label>
            <select class="campo-formulario" name="universidad">
                <option>UCM</option>
                <option>UAH</option>
                <option>UPM</option>
            </select>
            <input type="submit" value="Añadir carrera" class="campo-formulario">
        </form>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

