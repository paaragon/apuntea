<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-university"></span> Editar universidad
    </h2>
    <hr>
    <section class="col-9">
        <form action="perfil-universidad.php" method="post">
            <legend>Datos de la universidad:</legend>
            <span class="col-3"><label>Universidad:</label></span>
            <span class="col-9"><input type="text" name="universidad" class="campo-formulario" placeholder="Nombre de la universidad" required=""></span>
            <span class="col-3"><label>Alias:</label></span>
            <span class="col-9"><input type="email" name="alias" class="campo-formulario" placeholder="Alias de la universidad" required=""></span>
            <span class="col-3"><label>E-mail de contacto:</label></span>
            <span class="col-9"><input type="text" name="email" class="campo-formulario" placeholder="Email de contacto de la universidad"></span>
            <span class="col-3"><label>Descripción:</label></span>
            <span class="col-9"><textarea class="campo-formulario" placeholder="Breve descripción de la universidad"></textarea></span>
            <span class="col-9"><label>Logo de la universidad: </label><input type="file" name="imagen_universidad" class="campo-formulario" ></span>
            <input type="submit" value="Guardar universidad" class="campo-formulario ">
        </form>
    </section>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
