<?php
require "../util/memeSelector.php";
require "../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();

$variables = $controlador->anadirCarrera();
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
require "../common/admin/layout.php";

