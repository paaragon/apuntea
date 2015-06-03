<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="head-apunte">
    <span class="col-6">
        <a href="universidad.php">[Universidad]</a> / 
        <a href="carrera.php">[Carrera]</a> /
        <a href="#">[Asignatura]</a>
    </span>
    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
    <span class="col-2"><span class="fa fa-eye"></span> 999</span>
    <span class="col-1"><a href="editar-apunte.php">Editar</a></span>
    <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
    <div class="clear"></div>
</div>
<div id="contenido-apunte">

    <h1 class="text-center"><?php echo $variables["apunte"]->titulo ?></h1>
    <?php echo $variables["apunte"]->contenido ?>
</div>
<div>
    <div class="fila">
        <form action="ver-apunte-propio.php" method="post">
            <h3><span class="fa fa-comment"></span> Añadir comentario</h3>
            <textarea class="campo-formulario" name="comentario"></textarea>
            <input type="submit" class="campo-formulario" value="añadir comentario">
        </form>
    </div>
    <div class="fila">
        <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
    <div class="fila">
        <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
    <div class="fila">
        <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
    <div class="fila">
        <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
    <div class="fila">
        <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
