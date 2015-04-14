<?php ob_start(); ?>

<div id="principal">

    <div class="col-5">
        <form action="mi-configuracion.php" method="post">
            <legend>Mis datos personales:</legend>
            <span class="col-3"><label>Nombre completo:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required=""></span>
            <span class="col-3"><label>Email:</label></span>
            <span class="col-9"><input type="email" name="nombre" class="campo-formulario" placeholder="Introduzca su nuevo e-mail" required=""></span>
            <span class="col-3"><label>Dirección:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su dirección (opcional)"></span>
            <span class="col-3"><label>Universidad:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su universidad" required=""></span>
            
            <input type="submit" value="Guardar datos personales" class="campo-formulario">
        </form>
    </div>
    <div class="clear"></div>
    <div class="col-5">
        <form action="mi-configuracion.php" method="post">
            <legend>Privacidad: </legend>
            ¿Quién puede ver mi perfil? <br>
            <label><input type="radio" name="vis-perfil" value="Todo el mundo" checked="checked"/> Todo el mundo</label>
            <label><input type="radio" name="vis-perfil" value="Solo amigos" /> Solo mis amigos</label>
            <hr>
            ¿Quién puede ver mi actividad? <br>
            <label><input type="radio" name="vis-actividad" value="Todo el mundo" checked="checked"/> Todo el mundo</label>
            <label><input type="radio" name="vis-actividad" value="Solo amigos" /> Solo mis amigos</label>
            <hr>
            ¿Quién puede encontrarme a través del buscador? <br>
            <label><input type="radio" name="vis-buscador" value="Todo el mundo" checked="checked"/> Todo el mundo</label>
            <label><input type="radio" name="vis-buscador" value="Solo amigos" /> Solo mis amigos</label><br><br>
            <input type="submit" name="actualizar" value="Enviar" class="campo-formulario">
        </form>

    </div>

</div>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
