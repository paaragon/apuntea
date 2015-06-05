<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<section>
    <h1><span class="fa fa-key"></span> Permisos pedidos</h1>
</section>
<section class="alerta-exito fila">
    <p>
        Ha pedido permisos correctamente. Cuando el administrador de los apuntes los haya concedido será notificado.
    </p>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";
