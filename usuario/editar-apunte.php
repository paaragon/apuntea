<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="head-apunte">
    <span class="col-8">
        <a href="universidad.php">[Universidad]</a> / 
        <a href="carrera.php">[Carrera]</a> /
        <a href="#">[Asignatura]</a>
    </span>
    <span class="col-2"><a href="ver-apunte-propio.php"><span class="fa fa-floppy-o"></span> Guardar</a></span>
    <span class="col-2"><a href="ver-apunte-propio.php"><span class="fa fa-times"></span> Cancelar</a></span>
    <div class="clear"></div>
</div>
<div id="contenido-apunte">
    <textarea id="area-apunte">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu. Vestibulum neque elit, convallis quis fringilla at, aliquam nec nibh. Quisque eu magna quis sapien feugiat porttitor. Duis rutrum enim eu leo venenatis, id lobortis lectus ultrices. Nam orci est, euismod vel nibh a, commodo aliquam odio. Aliquam dapibus nibh in nunc porttitor ullamcorper. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;

Aenean lacinia in tellus sed luctus. Phasellus faucibus nibh sed risus pellentesque rutrum. Maecenas rhoncus justo lectus, sit amet efficitur neque posuere sed. Maecenas efficitur metus faucibus, finibus est et, varius ex. Cras enim lacus, facilisis a tortor vitae, varius viverra lacus. Donec placerat bibendum elit, convallis ullamcorper dolor tincidunt vitae. Sed ornare venenatis sem ac semper. Quisque sit amet nisl in purus consectetur venenatis rhoncus vel magna.

Maecenas auctor metus vel nulla tempor aliquet. In at lacinia nisi. Ut vehicula nulla nisi. Proin in bibendum metus. Sed tempus turpis quis elit porttitor pulvinar. Maecenas consectetur velit quis quam bibendum, id hendrerit metus imperdiet. Nunc auctor eu sapien quis aliquam. Pellentesque quis tortor ante. Nam fermentum ac risus eu lobortis.

Nam euismod vestibulum erat non pharetra. Morbi imperdiet eu dui ac porttitor. Integer semper turpis et libero dictum, eget fermentum orci scelerisque. Aliquam scelerisque est risus, vel vestibulum massa luctus in. Nullam aliquam auctor leo, vitae laoreet odio iaculis a. Suspendisse molestie pharetra tortor, vel feugiat lectus commodo nec. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur luctus mauris ut lorem condimentum sodales. Ut ultrices enim eu auctor maximus. Pellentesque at lacus imperdiet metus pretium vehicula. Nulla commodo risus sit amet massa egestas suscipit eget et ante.

Sed non eros justo. Duis quis tellus leo. Phasellus dapibus imperdiet ultricies. Nullam ac semper nisi. Sed ac lectus a leo bibendum dapibus malesuada in sem. Maecenas a ultrices risus. Aliquam sed lacinia dolor. Fusce ut tincidunt eros. Maecenas id elit nulla. Aenean sit amet lacinia metus, vitae tincidunt arcu. 
    </textarea>
</div>
<h3><span class="fa fa-key"></span>Permisos:</h3>
<span class="col-4">
    <label><span class="fa fa-eye"></span> Visualización:</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Algunos usuarios</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Público</label>
    <hr>
    <label>Lectores y grupos:</label>
    <input type="text" name="lector-1" disabled="" value="[Lector 1]" class="campo-formulario">
    <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
</span>
<span class="col-4">
    <label><span class="fa fa-edit"></span> Modificación:</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Alguno usuarios</label>
    <hr>
    <label>Usuarios que modifiquen:</label>
    <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
    <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
    <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
</span>
<span class="col-4">
    <label><span class="fa fa-key"></span> Edición de permisos:</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
    <label class="campo-formulario"><input type="radio" name="visualizacion"> Alguno usuarios</label>
    <hr>
    <label>Usuarios que editen permisos:</label>
    <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
    <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
    <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
</span>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
