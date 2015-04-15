<?php ob_start(); ?>
<section>
    <h1>[Nombre de los apuntes]</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="carreras.php">Carreras</a></li>
    <li><a href="universidad.php">[Universidad]</a></li>
    <li><a href="carrera.php<?php echo $uni ?>">[Carrera]</a></li>
    <li><a href="asignatura.php<?php echo $uni ?>">[Asignatura]</a></li>
    <li>[Nombre de apuntes]</li>
</ul>
<hr>
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
        <img src="img/no-user.jpg" class="imagen-responsive imagen-circular">
        <p>
            <a>[Nombre usuario]</a><br>
            <a>[Carrera usuario]</a><br>
            <a>[Universidad usuario]</a><br><br>
            <strong><span class="fa fa-thumbs-up"></span></strong> <span class="distintivo">4</span>
            <strong><span class="fa fa-thumbs-down"></span></strong> <span class="distintivo">0</span>
        </p>
    </div>
    <div class="clear"></div>
    <div class="panel info-apuntes">
        <div class="col-2"><p><span><span class="fa fa-lock"></span></span></p></div>
        <div class="col-5"><p><span><strong>[Nombre apuntes]</strong></span></p></div>
        <div class="col-5">
            <p>
                <span><strong><span class="fa fa-thumbs-up"></span></strong> <span class="distintivo">4</span></span>
                <span><strong><span class="fa fa-thumbs-down"></span></strong> <span class="distintivo">0</span></span>
                <span><strong><span class="fa fa-eye"></span></strong> <span class="distintivo">0</span></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <div class="alerta alerta-error">
            <p>
                El contenido de estos apuntes es privado.
                <strong><a href="registrarse.php">Regístrese</a></strong>
                para poder pedir permisos de visualización.
            </p>
        </div>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
