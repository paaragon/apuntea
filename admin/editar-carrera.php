<?php ob_start(); ?>

<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> Editar carrera
    </h2>
    <hr>
    <div class="col-9">
        <form action="perfil-carrera.php" method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" required="" class="campo-formulario" placeholder="Introduce el nuevo nombre">
            <input type="submit" value="Guardar cambios" class="campo-formulario">
        </form>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

