<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->miConfiguracion();

ob_start();
?>

<div id="principal" class="col-9">
    <div>
        <form action="../servicios/adminHandler.php?action=cambiarConfiguracion" method="post">
            <legend>Mis datos personales:</legend>
            <span class="col-3"><label>Nombre:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value ="<?php echo $variables["admin"]->nombre ?>"></span>
            <span class="col-3"><label>Apellidos:</label></span>
            <span class="col-9"><input type="text" name="apellidos" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value ="<?php echo $variables["admin"]->apellidos ?>"></span>
            <span class="col-3"><label>Email:</label></span>
            <span class="col-9"><input type="email" name="mail" class="campo-formulario" placeholder="Introduzca su nuevo e-mail" required="" value="<?php echo $variables["admin"]->email ?>"></span>
            <span class="clearfix"><legend>Cambiar contraseña</legend></span>
            <span class="col-3"><label>Contraseña nueva:</label></span>
            <span class="col-9"><input type="password" name="new-password" class="campo-formulario"></span>
            <span class="col-3"><label>Repetir contraseña nueva:</label></span>
            <span class="col-9"><input type="password" name="pass3" class="campo-formulario"></span>
            <input type="submit" name="actualizar" value="Guardar datos personales" class="campo-formulario">
        </form>
    </div>

</div>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
