<?php ob_start(); ?>
<section id="presentacion">
    <h1>[Nombre de los apuntes]</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="carreras.php">Carreras</a></li>
    <?php
    if (isset($_GET["uni"])) {
        $uni = "?uni=" . $_GET["uni"];
        echo '<li><a href="universidad.php">' . $_GET["uni"] . '</a></li>';
    } else {
        $uni = "";
    }
    ?>
    <li><a href="carrera.php<?php echo $uni ?>">[Nombre de carrera]</a></li>
    <li><a href="asignatura.php<?php echo $uni ?>">[Nombre de asignatura]</a></li>
    <li>[Nombre de apuntes]</li>
</ol>
<hr>
<section>
    <h2><i class="fa fa-info-circle"></i> Información sobre los apuntes</h2>
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item"><strong>Universidad:</strong> [Nombre universidad]</li>
            <li class="list-group-item"><strong>Carrera:</strong> [Nombre carrera]</li>
            <li class="list-group-item"><strong>Asignatura:</strong> [Nombre asignatura]</li>
            <li class="list-group-item"><strong>Profesor:</strong> [Nombre del profesor]</li>
        </ul>
    </div>
    <div class="col-md-6 panel panel-default upload-perfil">
        <img src="img/no-user.jpg" class="img-responsive img-circle">
        <p>
            <a>[Nombre usuario]</a><br>
            <a>[Carrera usuario]</a><br>
            <a>[Universidad usuario]</a><br><br>
            <strong><i class="fa fa-thumbs-up"></i></strong> <span class="badge">4</span>
            <strong><i class="fa fa-thumbs-down"></i></strong> <span class="badge">0</span>
        </p>
    </div>
    <div class="clearfix"></div>
    <div class="panel panel-default info-apuntes">
        <?php if (isset($_GET["vis"]) && $_GET["vis"] == "pub"): ?>
            <div class="col-md-2"><p><span><i class="fa fa-globe"></i></span></p></div>
        <?php else: ?>
            <div class="col-md-2"><p><span><i class="fa fa-lock"></i></span></p></div>
        <?php endif; ?>
        <div class="col-md-5"><p><span><strong>[Nombre apuntes]</strong></span></p></div>
        <div class="col-md-5">
            <p>
                <span><strong><i class="fa fa-thumbs-up"></i></strong> <span class="badge">4</span></span>
                <span><strong><i class="fa fa-thumbs-down"></i></strong> <span class="badge">0</span></span>
                <span><strong><i class="fa fa-eye"></i></strong> <span class="badge">0</span></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <?php if (isset($_GET["vis"]) && $_GET["vis"] == "pub"): ?>
            <p><a class="btn btn-primary form-control">Ver apuntes</a></p>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                El contenido de estos apuntes es privado.
                <strong><a data-toggle="modal" data-target="#myModal">Regístrese</a></strong>
                para poder pedir permisos de visualización.
            </div>
        <?php endif; ?>

    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
