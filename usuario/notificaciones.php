<?php ob_start(); ?>
<div id="principal">
    <h2>
        <i class="fa fa-globe"></i> Notificaciones
    </h2>
    <hr>

    <!--Div principal--->
    <div class="notice info fila "><p>Tu mensaje ha sido enviado</p></div>

    <div class="notice success fila "><p>Tienes una peticion de amistad</p></div>

    <div class="notice warning fila "><p>Alguien quiere entrar en tu cuenta</p></div>

    <div class="notice error fila "><p>Error lol! jaja </p></div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
