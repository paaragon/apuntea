<?php ob_start(); ?>

<div id="principal" class="col-9">
    <div>
        <form action="mi-configuracion.php" method="post">
            <legend>Mis datos personales:</legend>
            <span class="col-3"><label>Nombre completo:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required=""></span>
            <span class="col-3"><label>Email:</label></span>
            <span class="col-9"><input type="email" name="nombre" class="campo-formulario" placeholder="Introduzca su nuevo e-mail" required=""></span>
            <span class="col-3"><label>Contraseña:</label></span>
            <span class="col-9"><input type="password" name="password" class="campo-formulario" required=""></span>
            <span class="col-3"><label>Repetir contraseña:</label></span>
            <span class="col-9"><input type="password" name="repeat-password" class="campo-formulario" required=""></span>
            <input type="submit" value="Guardar datos personales" class="campo-formulario">
        </form>
    </div>
    
</div>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
