<?php
require "controladores/ControladorEstandar.php";

session_start();

$controlador = new ControladorEstandar();
$variables = $controlador->inicio();

ob_start();
?>
<section>
    <div class="col-sm-4"><img src="img/logo.png" class="img-responsive"></div>
    <div class="col-sm-8">
        <h3>Bienvenido a <strong>Apuntea</strong> tu red social para compartir apuntes.</h3>
    </div>
    <div class="clearfix"></div>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Inicio</li>
</ul>
<hr>
<section>
    <p>
        En <strong>apuntea.com</strong> podrás encontrar todos los apuntes que necesites
        de una manera completamente social. Como usuario no registrado no podrás
        acceder a cierto contenido de la página y no podrás pedir permisos de visualización
        de aquellos apuntes que sean privados. Pulsa <a href="registrarse.php">aqui para registrarte</a>
    </p>
</section>
<div class="alerta alerta-info">
    <p>Llevamos un total de <span class="distintivo"><?php echo $variables["numero-de-apuntes"] ?></span> apuntes</p>
</div>
<section>
    <div id="top-universidades">
        <?php foreach ($variables["universidades"] as $id => $universidad): ?>
            <div class="slide col-2"><a href="universidad.php?id=<?php echo $id ?>"><img src="img/universidades/perfil/<?php echo $universidad["img"] ?>"></a></div>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>
    <p><a href="universidades.php"><span class="etiqueta label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
</section>
<div>
    <section class="col-sm-4">
        <h3>Top Carreras</h3>
        <hr>
        <ul>
            <?php foreach ($variables["carreras"] as $id => $carrera): ?>
                <li><a href="universidad.php?id=<?php echo $carrera["iduniversidad"] ?>"><?php echo $carrera["siglasuniversidad"] ?></a> - <a href="carrera.php?id=<?php echo $id ?>"><?php echo $carrera["nombre"] ?></a></li>
            <?php endforeach; ?>
        </ul>
        <p><a href="carreras.php"><span class="etiqueta label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
    <section class="col-sm-4">
        <h3>Top Asignaturas</h3>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
        </ul>
        <p><a href="asignaturas.php"><span class="etiqueta"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
    <section class="col-sm-4">
        <h3>Top Apuntes</h3>
        <hr>
        <ul>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
        </ul>
        <p><a href="lista-apuntes.php"><span class="label label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
</div>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
