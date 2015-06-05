<?php
require "../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();
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
                    <?php
                    $like = new Like($apunte);
                    $dislike = new Dislike($apunte);
                    $fav = new Fav($apunte);
                    ?>
                    <span class="col-2"><?php echo $like->generateLike(); ?></span>
                    <span class="col-2"><?php echo $dislike->generateDislike(); ?></span>
                    <span class="col-2"><span class="fa fa-eye"></span> <?php echo $apunte["visualizaciones"] ?></span>
                    <!--poner la clase en funcion de si es favorito o no   -->
                    <span class="col-2"><?php echo $fav->generateFav(); ?></span>
                </div>
                <div class="col-1">
                    <p>
                        <a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><span class="fa fa-chevron-circle-right"></span></a>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <blockquote>Esta asignatura no tiene apuntes públicos</blockquote>
    <?php endif; ?>
</section>
<script>

    $(document).ready(function () {
<?php if (count($variables["apuntes"]) > 0): ?>
    <?php echo $like->generateAjaxScript(); ?>
    <?php echo $dislike->generateAjaxScript(); ?>
    <?php echo $fav->generateAjaxScript(); ?>
<?php endif; ?>
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
