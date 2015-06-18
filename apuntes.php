<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->verApunte();

ob_start();
?>
<?php if (isset($variables["apunte"])): ?>
    <section>
        <h1><?php echo $variables["apunte"]->titulo ?></h1>
    </section>
    <ul class="breadcrumb">
        <li><a href="index.php">Apuntea</a></li>
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
                <?php echo $variables["apunte"]->usuario->nombre . " " . $variables["apunte"]->usuario->apellidos ?> @<?php echo $variables["apunte"]->usuario->nick ?><br>
                <?php echo $variables["apunte"]->usuario->carrera->nombre ?><br>
                <?php echo $variables["apunte"]->usuario->carrera->universidad->nombre ?>
            </p>
        </div>
        <div class="clear"></div>
        <div class="panel info-apuntes">
            <div class="col-xs-2">
                <p>
                    <span>
                        <?php if ($variables["apunte"]->permisovisualizacion == 2): ?>
                            <span class="fa fa-globe"></span>
                        <?php else: ?>
                            <span class="fa fa-lock"></span>
                        <?php endif; ?>
                    </span>
                </p>
            </div>
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
            <?php if ($variables["apunte"]->permisovisualizacion == 2): ?>
                <p><a class="boton campo-formulario" href="ver-apunte.php?id=<?php echo $variables["apunte"]->id ?>">Ver apuntes</a></p>
            <?php else: ?>
                <div class="alerta alerta-error">
                    <p>
                        El contenido de estos apuntes es privado.
                        <strong><a href="registrarse.php">Regístrese</a></strong>
                        para poder pedir permisos de visualización.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php else: ?>
    <ul class="breadcrumb">
        <li><a href="index.php">Apuntea</a></li>
    </ul>
    <hr>
    <blockquote><h3>Apunte no encontrado.</h3></blockquote>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
