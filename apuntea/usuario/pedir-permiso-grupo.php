<?php ob_start(); ?>
<section>
    <h1><span class="fa fa-key"></span> Pedir permisos para entrar a un grupo</h1>
</section>
<section>
    <form action="permiso-grupo-pedido.php" method="post">
        <label><h4>Grupo:</h4></label>
        <input type="text" class="campo-formulario" name="archivo" value="[Nombre de grupo]" disabled="">
        <input type="hidden" value="[id-archivo]" name="id-archivo"><br><br>
        <textarea name="comentario" placeholder="Escriba un comentario" class="campo-formulario"></textarea>
        <input type="submit" class="campo-formulario" value="Pedir permisos">
    </form>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";
