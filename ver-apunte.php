<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->verApunte();

ob_start();
?>
<?php if(isset($variables["apunte"]) && $variables["apunte"]->permisovisualizacion == 2): ?>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="universidad.php?id=<?php echo $variables["apunte"]->asignatura->carrera->universidad->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->universidad->siglas ?></a></li>
    <li><a href="carrera.php?id=<?php echo $variables["apunte"]->asignatura->carrera->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->nombre ?></a></li>
    <li><a href="asignatura.php?id=<?php echo $variables["apunte"]->asignatura->id ?>"><?php echo $variables["apunte"]->asignatura->nombre ?></a></li>
    <li><?php echo $variables["apunte"]->titulo ?></li>
</ul>
<div>

    <h1 class="text-center"><?php echo $variables["apunte"]->titulo ?></h1>
    <?php echo $variables["apunte"]->contenido ?>
</div>
<?php else: ?>
<blockquote>Este apunte no existe o no tiene permisos para verlo. <a href="index.php">Volver al inicio</a></blockquote>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";

