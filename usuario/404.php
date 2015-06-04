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
        <img src="../img/404/<?php echo $meme; ?>" alt="<?php echo $meme; ?>" class="img-responsive">
    </p>
</section>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";

