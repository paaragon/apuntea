
<?php ob_start(); ?>


<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="onOff.css" rel="stylesheet" type="text/css" /> 
    </head>
    <body>



        <div class="col-9">
            <h2>
                <i class="fa fa-users"></i> Historial de mensajes
            </h2>
           

            <div class="picture fila">
                <img src= avatar.jpg class="profile-img">
                <div class="status status-red"></div>
                <p><small>Domingo</small><p>
            </div>
            <div class="picture fila">
                <img src=avatar.jpg  class="profile-img">
                <div class="status status-green"></div>
                <p><small>25 marzo</small><p>
            </div>
            <div class="picture fila">
                <img src=avatar.jpg  class="profile-img">
                <div class="status status-green"></div>
                <p><small>24 marzo</small><p>
            </div>
            <div class="picture fila">
                <img src=avatar.jpg  class="profile-img">
                <div class="status status-green"></div>
                <p><small>2 de febrero 2002</small><p>
            </div>


            <div class="col-12">

                <div class="fila">
                    <h3>
                        <span>
                           Cuando se pulsa a un contacto sale el historial
                           de mensajes recibidos y enviados</span>
                    </h3>
                    <p> Recibido el 2/02/02 a las 22:00</p>
                    <hr>
                    <p>
                        <span>Mensaje de prueba 1</span>

                    </p>
                    <hr>
                    <h3>
                        <span>Mensaje de prueba de: <strong>Pepe</strong></span>
                    </h3>
                    <p> Recibido el 2/02/02 a las 22:00</p>
                    <hr>
                    <p>
                        <span>Mensaje de prueba 2</span>

                    </p>
                    <hr>
                    <h3>
                        <span>Mensaje de prueba de: <strong>Pepe</strong></span>
                    </h3>
                    <p> Recibido el 2/02/02 a las 22:00</p>
                    <hr>
                    <p>
                        <span>Mensaje de prueba 3</span>

                    </p>
                    <hr>
                    <h3>
                        <span>Mensaje de prueba de: <strong>Pepe</strong></span>
                    </h3>
                    <p> Recibido el 2/02/02 a las 22:00</p>

                </div>
            </div>
            <hr>
            <div class="col-5 fila">
                <p>

                    <input type="text" id="reg-nuevo" class="form-nuevo fila" placeholder="Escribe un nuevo mensaje" name="invita">
                    <button type="submit">Enviar</button>


                </p>
            </div>

        </div>
    </body>
</html>

<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
