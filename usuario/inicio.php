<?php ob_start(); ?>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
