<?php ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-university"></span> Editar universidad
    </h2>
    <hr>
    <section class="col-9">
        <form action="perfil-universidad.php" method="post">
            <span class="col-3"><label>Universidad:</label></span>
            <span class="col-9"><input type="text" name="universidad" class="campo-formulario" placeholder="Nombre de la universidad" required=""></span>
            <span class="col-3"><label>Siglas:</label></span>
            <span class="col-9"><input type="text" name="alias" class="campo-formulario" placeholder="Alias de la universidad" required=""></span>
            <span class="col-3"><label>Descripción:</label></span>
            <span class="col-9"><textarea class="campo-formulario" name="descripcion" placeholder="Breve descripción de la universidad"></textarea></span>
            <span class="col-9"><label>Logo de la universidad: </label><input type="file" name="imagen_logo" class="campo-formulario" ></span>
            <span class="col-9"><label>Portada de la universidad: </label><input type="file" name="imagen_portada" class="campo-formulario" ></span>
            <input type="submit" value="Guardar universidad" class="campo-formulario ">
        </form>
    </section>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
