<?php ob_start(); ?>
<section>
    <h1><span class="fa fa-key"></span> Pedir permisos</h1>
</section>
<section>
    <form action="permiso-pedido.php" method="post">
        <label><h4>Archivo:</h4></label>
        <input type="text" class="campo-formulario" name="archivo" value="[Nombre de apuntes]" disabled="">
        <input type="hidden" value="[id-archivo]" name="id-archivo"><br><br>
        <label><h4>Tipo de permisos:</h4></label><br>
        <ul>
            <li><label><input type="checkbox" name="visualizacion"> Visualización</label></li>
            <li><label><input type="checkbox" name="modificacion"> Modificación</label></li>
            <li><label><input type="checkbox" name="visualizacion"> Administrar permisos</label></li>
        </ul>
        <textarea name="comentario" placeholder="Escriba un comentario" class="campo-formulario"></textarea>
        <input type="submit" class="campo-formulario" value="Pedir permisos">
    </form>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";
