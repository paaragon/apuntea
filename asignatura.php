<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->asignatura();

ob_start();
?>
<section>
    <h1><?php echo $variables["asignatura"]->nombre ?></h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="universidad.php?id=<?php echo $variables["asignatura"]->carrera->universidad->id ?>"><?php echo $variables["asignatura"]->carrera->universidad->siglas ?></a></li>
    <li><a href="carrera.php?id=<?php echo $variables["asignatura"]->carrera->id ?>"><?php echo $variables["asignatura"]->carrera->nombre ?></a></li>
    <li><?php echo $variables["asignatura"]->nombre ?></li>
</ul>
<hr>
<section>
    <?php if (count($variables["apuntes"]) > 0): ?>
        <?php foreach ($variables["apuntes"] as $apunte): ?>
            <div class="fila">
                <div class="col-5">
                    <p><?php echo $apunte->titulo ?></p>
                </div>
                <div class="col-6">
                    <p>
                        <span class="fa fa-thumbs-up"></span> <span class="badge"><?php echo $apunte->likes ?></span>
                        <span class="fa fa-thumbs-down"></span> <span class="badge"><?php echo $apunte->dislikes ?></span>
                        <span class="fa fa-eye"></span> <span class="badge"><?php echo $apunte->visualizaciones ?></span>
                    </p>
                </div>
                <div class="col-1">
                    <p>
                        <a href="apuntes.php?id=<?php echo $apunte->id ?>"><span class="fa fa-chevron-circle-right"></span></a>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <blockquote>Esta asignatura no tiene apuntes públicos</blockquote>
    <?php endif; ?>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
