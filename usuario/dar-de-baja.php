<?php
require "../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->darDeBaja();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-frown-o"></span> Darse de baja
    </h2>
    <hr>
    <p class="text-center">
        Antes de irte de apuntea te pedimos un solo favor.
        Mira a la cara a nuestro amigo Marvin.<br><br>
        Marvin es un robot muy triste, pero es feliz cada vez que alguien se registra en apuntea. Por desgracia, cada vez que alguien se va vuelve a caer en depresión. Por más que intentamos animarle nos dice <em>"vida... no me hables de la vida...".</em><br><br>
        <img src="../img/marvin.jpg" alt="gato triste" class="img-responsive">
        <br>
        <a class="form-control btn btn-danger" href="../servicios/usuarioHandler.php?action=darDeBaja">Confirmar cancelación de cuenta</a>
    </p>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
