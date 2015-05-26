<?php ob_start(); ?>
<section>
    <h1>Registrarse:</h1>
</section>
<section>
    <form action="registrado.php" method="post">
        <label>Alias de usuario:</label>
        <input type="text" name="alias" class="campo-formulario" required="">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="campo-formulario" required="">
        <label>Apellidos</label>
        <input type="text" name="apellidos" class="campo-formulario" required="">
        <label>Email</label>
        <input type="email" name="email" class="campo-formulario" required="">
        <label>Contraseña:</label>
        <input type="password" name="contrasena" class="campo-formulario" required="">
        <label>Repita la contraseña:</label>
        <input type="password" name="contrasena" class="campo-formulario" required="">
        <input type="submit" value="Registrarse" class="campo-formulario">
    </form>
    <blockquote>
        <h4>O si lo prefieres regístrate con alguna de estas redes sociales:</h4>
        <h1>
            <a href="registrado.php"><i class="fa fa-facebook-square"></i></a>
            <a href="registrado.php"><i class="fa fa-twitter-square"></i></a>
        </h1>
    </blockquote>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
