<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->apunte();

ob_start();
?>
<section>
    <h1><?php echo $variables["apunte"]->titulo ?></h1>
</section>
<ul class="breadcrumb">
    <li><a href="index">Apuntea</a></li>
    <li><a href="universidad.php?id=<?php echo $variables["apunte"]->asignatura->carrera->universidad->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->universidad->siglas ?></a></li>
    <li><a href="carrera.php?id=<?php echo $variables["apunte"]->asignatura->carrera->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->nombre ?></a></li>
    <li><a href="asignatura.php?id=<?php echo $variables["apunte"]->asignatura->id ?>"><?php echo $variables["apunte"]->asignatura->nombre ?></a></li>
    <li><?php echo $variables["apunte"]->titulo ?></li>
</ul>
<hr>
<section>
    <h2><i class="fa fa-info-circle"></i> Información sobre los apuntes</h2>
    <div class="col-sm-6">
        <ul class="panel-lista">
            <li><strong>Universidad:</strong> <?php echo $variables["apunte"]->asignatura->carrera->universidad->nombre ?></li>
            <li><strong>Carrera:</strong> <?php echo $variables["apunte"]->asignatura->carrera->nombre ?></li>
            <li><strong>Asignatura:</strong> <?php echo $variables["apunte"]->asignatura->nombre ?></li>
        </ul>
    </div>
    <div class="col-sm-6 panel upload-perfil">
        <img src="img/no-user.jpg" class="img-responsive img-circle">
        <p>
            <a><?php echo $variables["apunte"]->usuario->nombre . " " . $variables["apunte"]->usuario->apellidos ?></a><br>
            <a><?php echo $variables["apunte"]->usuario->carrera->nombre ?></a><br>
            <a><?php echo $variables["apunte"]->usuario->carrera->universidad->nombre ?></a>
        </p>
    </div>
    <div class="clear"></div>
    <div class="panel info-apuntes">
        <div class="col-xs-2"><p><span><i class="fa fa-globe"></i></span></p></div>
        <div class="col-xs-5"><p><span><strong><?php echo $variables["apunte"]->titulo ?></strong></span></p></div>
        <div class="col-xs-12 col-sm-5">
            <p>
                <span><strong><i class="fa fa-thumbs-up"></i></strong> <span class="badge"><?php echo $variables["apunte"]->likes ?></span></span>
                <span><strong><i class="fa fa-thumbs-down"></i></strong> <span class="badge"><?php echo $variables["apunte"]->dislikes ?></span></span>
                <span><strong><i class="fa fa-eye"></i></strong> <span class="badge"><?php echo $variables["apunte"]->visualizaciones ?></span></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div>
        <p><a class="boton campo-formulario" href="ver-apunte.php?id=<?php echo $variables["apunte"]->id ?>">Ver apuntes</a></p>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
