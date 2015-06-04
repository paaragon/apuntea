<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->mensajes();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-envelope"></span> Mis mensajes
    </h2>
    <hr>
    <h3>Conversaciones recientes: </h3>
    <div id="conversaciones-recientes">
        <div>
            <?php if(count($variables["contactos"]) > 0): ?>
            <?php foreach ($variables["contactos"] as $contacto): ?>
                <div class="picture fila">
                    <p>
                        <img src="../img/usuarios/perfil/<?php echo $contacto->avatar ?>" class="profile-img">
                    </p>
                    <h4><a href="mensajes.php?id=<?php echo $contacto->id ?>"><?php echo $contacto->nombre . " " . $contacto->apellidos ?></a></h4>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <blockquote><h4>No tienes conversaciones recientes.</h4></blockquote>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php if ($variables["contacto"] != null): ?>
        <h3>Conversación con <a href="usuarios-detalles.php?id=<?php echo $variables["contacto"]->id ?>"><?php echo $variables["contacto"]->nombre . " " . $variables["contacto"]->apellidos ?></a>:</h3>
        <div class="panel" id="conversacion">
            <?php foreach ($variables["mensajes"] as $mensaje): ?>
                <?php if ($mensaje->emisor_id == $variables["contacto"]->id): ?>
                    <p class="msg msg-amigo"><?php echo $controlador->buscarEmoji($mensaje->texto) ?></p>
                <?php else: ?>
                    <p class="msg msg-propio"><?php echo $controlador->buscarEmoji($mensaje->texto) ?></p>
                <?php endif; ?>
            <?php endforeach; ?><div class="clear"></div>
        </div>
        <div>
            <form action="../servicios/adminHandler.php?action=enviarMensaje&redirect=<?php echo $variables["contacto"]->id ?>" method="post" id="enviarMensajeForm">
                <textarea class="campo-formulario" placeholder="Escribe aquí tu mensaje" id="textArea" required></textarea>
                <input type="hidden" value="<?php echo $variables["contacto"]->id ?>" name="idContacto" required>
                <input type="hidden" value="" name="texto" id="texto">
                <input type="submit" class="campo-formulario" value="Enviar" id="enviarMensajeBtn">
            </form>
        </div>
        <script>
            $(document).on("ready", function () {

                var objDiv = document.getElementById("conversacion");
                objDiv.scrollTop = objDiv.scrollHeight;

                $("#enviarMensajeBtn").on("click", function (e) {

                    e.preventDefault();
                    $("#texto").val(buscarEmoji($("#textArea").val()));
                    $("#enviarMensajeForm").submit();
                });
            });
        </script>
    <?php endif; ?>
</div>
<?php
$scripts[] = '<script src="../js/chat.js"></script>';
$contenido = ob_get_clean();
require "../common/admin/layout.php";
