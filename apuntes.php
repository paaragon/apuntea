<?php ob_start(); ?>
<section>
    <h1>[Nombre de los apuntes]</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="carreras.php">Carreras</a></li>
    <li><a href="universidad.php">[Universidad]</a></li>
    <li><a href="carrera.php">[Carrera]</a></li>
    <li><a href="asignatura.php">[Asignatura]</a></li>
    <li>[Nombre de apuntes]</li>
</ul>
<hr>
<section>
    <h2><i class="fa fa-info-circle"></i> Información sobre los apuntes</h2>
    <div class="col-6">
        <ul class="panel-lista">
            <li><strong>Universidad:</strong> [Nombre universidad]</li>
            <li><strong>Carrera:</strong> [Nombre carrera]</li>
            <li><strong>Asignatura:</strong> [Nombre asignatura]</li>
            <li><strong>Profesor:</strong> [Nombre del profesor]</li>
        </ul>
    </div>
    <div class="col-6 panel upload-perfil">
        <img src="img/no-user.jpg" class="img-responsive img-circle">
        <p>
            <a>[Nombre usuario]</a><br>
            <a>[Carrera usuario]</a><br>
            <a>[Universidad usuario]</a><br><br>
            <strong><i class="fa fa-thumbs-up"></i></strong> <span class="badge">4</span>
            <strong><i class="fa fa-thumbs-down"></i></strong> <span class="badge">0</span>
        </p>
    </div>
    <div class="clear"></div>
    <div class="panel info-apuntes">
        <div class="col-2"><p><span><i class="fa fa-globe"></i></span></p></div>
        <div class="col-5"><p><span><strong>[Nombre apuntes]</strong></span></p></div>
        <div class="col-5">
            <p>
                <span><strong><i class="fa fa-thumbs-up"></i></strong> <span class="badge">4</span></span>
                <span><strong><i class="fa fa-thumbs-down"></i></strong> <span class="badge">0</span></span>
                <span><strong><i class="fa fa-eye"></i></strong> <span class="badge">0</span></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <p><a class="boton campo-formulario">Ver apuntes</a></p>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
