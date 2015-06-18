<?php
require "../util/memeSelector.php";
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();
$meme = getMeme();
ob_start();
?>
<section id="error-page">
    <h1>404 - <small>Página no encontrada</small></h1>
    <p>
        <a href="inicio.php">Volver al inicio</a><br>
        <a href="404.php">Recarga la página, ¡te sorprenderá!</a>
    </p>
    <p>
        <img src="../img/404/<?php echo $meme; ?>" alt="<?php echo $meme; ?>" class="img-responsive">
    </p>
</section>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";

