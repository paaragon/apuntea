<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->resultadoBusqueda();

ob_start();
?>
<section>
    <h1>Resultados de búsqueda</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Búsqueda</li>
    <li><?php echo $variables["consulta"] ?></li>
</ul>
<hr>
<section>
    <h2>Resultado de la búsqueda</h2>
    <ul>
        <?php if (!isset($variables["opcion"])): ?>
            <blockquote>Error en al búsqueda.</blockquote>
        <?php elseif ($variables["opcion"] == "universidades" && isset($variables["universidades"])): ?>
            <?php foreach ($variables["universidades"] as $uni): ?>
                <li><a href="universidad.php?id?=<?php echo $uni->id ?>"><?php echo $uni->nombre ?></a></li>
            <?php endforeach; ?>

        <?php elseif ($variables["opcion"] == "carreras" && isset($variables["carreras"])): ?>
            <?php foreach ($variables["carreras"] as $car): ?>
                <li><a href="carrera.php?id?=<?php echo $car->id ?>"><?php echo $car->nombre ?></a> - <a href="universidad.php?id=<?php echo $car->universidad->id ?>"><?php echo $car->universidad->siglas ?></a></li>
            <?php endforeach; ?>

        <?php elseif ($variables["opcion"] == "asignaturas" && isset($variables["asignaturas"])): ?>
            <?php foreach ($variables["asignaturas"] as $asi): ?>
                <li><a href="asignatura.php?id?=<?php echo $asi->id ?>"><?php echo $asi->nombre ?></a> - <a href="carrera.php?id?=<?php echo $asi->carrera->id ?>"><?php echo $asi->carrera->nombre ?></a> - <a href="universidad.php?id=<?php echo $asi->carrera->universidad->id ?>"><?php echo $asi->carrera->universidad->siglas ?></a></li>
            <?php endforeach; ?>

        <?php else: ?>
            <blockquote>Búsqueda sin resultados.</blockquote>
        <?php endif; ?>
    </ul>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
