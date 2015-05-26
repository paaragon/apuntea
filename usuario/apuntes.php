<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<section>
    <h1>[Nombre de los apuntes]</h1>
</section>
<section>
    <h2><span class="fa fa-info-circle"></span> Información sobre los apuntes</h2>
    <div class="col-6">
        <ul class="panel-lista">
            <li><strong>Universidad:</strong> [Nombre universidad]</li>
            <li><strong>Carrera:</strong> [Nombre carrera]</li>
            <li><strong>Asignatura:</strong> [Nombre asignatura]</li>
            <li><strong>Profesor:</strong> [Nombre del profesor]</li>
        </ul>
    </div>
    <div class="col-6 panel upload-perfil">
        <img src="../img/no-user.jpg" class="img-responsive img-circle">
        <p>
            <a href="perfil-usuario.php">[Nombre usuario]</a><br>
            <a href="carrera.php">[Carrera usuario]</a><br>
            <a href="universidad.php">[Universidad usuario]</a><br><br>
            <strong><span class="fa fa-thumbs-up"></span></strong> <span class="badge">4</span>
            <strong><span class="fa fa-thumbs-down"></span></strong> <span class="badge">0</span>
        </p>
    </div>
    <div class="clear"></div>
    <div class="panel info-apuntes">
        <div class="col-2"><p><span><span class="fa fa-globe"></span></span></p></div>
        <div class="col-5"><p><span><strong>[Nombre apuntes]</strong></span></p></div>
        <div class="col-5">
            <p>
                <span><strong><span class="fa fa-thumbs-up"></span></strong> <span class="badge">4</span></span>
                <span><strong><span class="fa fa-thumbs-down"></span></strong> <span class="badge">0</span></span>
                <span><strong><span class="fa fa-eye"></span></strong> <span class="badge">0</span></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <p><a class="boton campo-formulario" href="ver-apunte.php">Ver apuntes</a></p>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";
