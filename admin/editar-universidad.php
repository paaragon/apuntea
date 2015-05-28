<?php
session_start();
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->getUniversidad();
ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-university"></span> Editar universidad
    </h2>
    <hr>
    <section class="col-9">
        <form action="../servicios/adminHandler.php?action=editarUniversidad&idUniversidad=<?php echo $variables["universidades"]->id ?>"  method="post">
            <span class="col-3"><label>Universidad:</label></span>
            <span class="col-9"><input type="text" name="universidad" class="campo-formulario" value="<?php echo $variables["universidades"]->nombre ?>" required=""></span>
            <span class="col-3"><label>Siglas:</label></span>
            <span class="col-9"><input type="text" name="alias" class="campo-formulario" value="<?php echo $variables["universidades"]->siglas ?>" required=""></span>
            <span class="col-3"><label>Descripción:</label></span>
            <span class="col-9"><input class="campo-formulario" name="descripcion" value="<?php echo $variables["universidades"]->descripcion ?>" ></span>
            <span class="col-9"><label>Logo de la universidad: </label><input type="file" name="imagen_logo" class="campo-formulario" ></span>
            <span class="col-9"><label>Portada de la universidad: </label><input type="file" name="imagen_portada" class="campo-formulario" ></span>
            <input type="submit" value="Guardar universidad" class="campo-formulario ">
        </form>
    </section>
</div>


<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
