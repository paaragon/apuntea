<?php ob_start(); ?>
<html>
    <head>
        <title>Perfil</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="estiloNotificaciones.css" rel="stylesheet" type="text/css" /> 
    </head>
    <body>
        <div class="col-9 " id="principal">
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

    </body>
</html>


<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
