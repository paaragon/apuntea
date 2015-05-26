<?php ob_start(); ?>
<section>
    <h1>¡Enhorabuena!</h1>
</section>
<section>
    <p class="alerta alerta-exito fila">
        <strong>Ha sido registrado como usuario.</strong> Para poder acceder a su perfil revise su correo electrónico donde habrá recibido las instrucciones para el acceso.
    </p>
    <p>
        <a href="index.php">Volver al incio</a>
    </p>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";

