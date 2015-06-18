<?php
require "../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->verApunte();
ob_start();
if (isset($variables["apunte"])):
    $apunte = $variables["apunte"];
    ?>
    <div id="head-apunte">
        <p>
            <span class="col-6">
                <a href="universidad.php?id=<?php echo $apunte->asignatura->carrera->universidad->id ?>"><?php echo $apunte->asignatura->carrera->universidad->siglas ?></a> / 
                <a href="carrera.php?id=<?php echo $apunte->asignatura->carrera->id ?>"><?php echo $apunte->asignatura->carrera->nombre ?></a> /
                <a href="asignatura.php?id=<?php echo $apunte->asignatura->id ?>"><?php echo $apunte->asignatura->nombre ?></a>
            </span>
            <?php
            $like = new Like($apunte);
            $dislike = new Dislike($apunte);
            $fav = new Fav($apunte);
            ?>
            <span class="col-1"><?php echo $like->generateLike(); ?></span>
            <span class="col-1"><?php echo $dislike->generateDislike(); ?></span>
            <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte->visualizaciones ?></span>
            <span class="col-2"><?php echo $fav->generateFav(); ?></span>
            <?php if ($apunte->usuario_id == $_SESSION["idUsuario"] || $variables["interaccion"]->permiso > 1): ?>
                <span class="col-1"><a href="editar-apunte.php?id=<?php echo $apunte->id ?>">Editar</a></span>
            <?php endif; ?>
        </p>
        <div class="clear"></div>
    </div>
    <div id="contenido-apunte">

        <h1 class="text-center"><?php echo $variables["apunte"]->titulo ?></h1>
        <?php echo $variables["apunte"]->contenido ?>
    </div>
    <div id="comentarios-apuntes">
        <div class="fila">
            <form action="../servicios/usuarioHandler.php?action=comentarApunte" method="post">
                <h3><span class="fa fa-comment"></span> Añadir comentario</h3>
                <textarea class="campo-formulario" name="comentario"></textarea>
                <input type="hidden" value="<?php echo $apunte->id ?>" name="apunte">
                <input type="submit" class="campo-formulario" value="añadir comentario">
            </form>
        </div>
        <?php foreach ($variables["comentarios"] as $comentario): ?>
            <div class="fila">
                <h4><a href="perfil-usuario.php?id=<?php echo $comentario->usuario->id ?>"><?php echo $comentario->usuario->nombre . " " . $comentario->usuario->apellido ?></a> <small> - <?php echo date("d-m-Y", strtotime($comentario->fecha)) ?></small></h4>
                <p>
                    <?php echo $comentario->texto ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        $(document).on("ready", function () {
    <?php echo $like->generateAjaxScript(); ?>
    <?php echo $dislike->generateAjaxScript(); ?>
    <?php echo $fav->generateAjaxScript(); ?>
        });
    </script>

<?php else: ?>
    <blockquote>
        <h3>Este apunte no existe o no tiene permisos para verlo.</h3>
        <?php if (isset($_GET["id"])): ?>
            <p>Si está seguro que este apunte existe pida permiso a su autor para poder verlo.</p>
            <p><a href="../servicios/usuarioHandler.php?action=pedirPermisoApunte&id=<?php echo filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?>">Pedir permiso</a></p>
        <?php endif; ?>
    </blockquote>
<?php
endif;
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
