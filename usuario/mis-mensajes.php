<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->misMensajes();

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
            <?php if (count($variables["contactos"]) > 0): ?>
                <?php foreach ($variables["contactos"] as $contacto): ?>
                    <?php if ($contacto->tipo == 1): ?>
                        <div class="picture fila">
                            <p>
                                <img src="../img/usuarios/perfil/<?php echo $contacto->avatar ?>" class="profile-img">
                            </p>
                            <?php if ($variables["mensajes-sin-leer"][$contacto->id] > 0): ?>
                                <div class="status"><span class="fa fa-envelope-o"></span></div>
                            <?php endif; ?>
                            <h4><a href="mis-mensajes.php?id=<?php echo $contacto->id ?>"><?php echo $contacto->nombre . " " . $contacto->apellidos ?></a></h4>
                        </div>
                    <?php else: ?>
                        <div class="picture fila">
                            <p>
                                <img src="../img/usuarios/perfil/admin.png" class="profile-img">
                            </p>
                            <?php if ($variables["mensajes-sin-leer"][$contacto->id] > 0): ?>
                                <div class="status"><span class="fa fa-envelope-o"></span></div>
                            <?php endif; ?>
                            <h4><a href="mis-mensajes.php?id=<?php echo $contacto->id ?>"><?php echo $contacto->nombre . " " . $contacto->apellidos ?><br><small>Administrador</small></a></h4>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <blockquote><h3>No tienes conversaciones recientes.</h3></blockquote>
            <?php endif; ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php if ($variables["contacto"] != null): ?>
        <h3>Conversación con <a href="perfil-usuario.php?id=<?php echo $variables["contacto"]->id ?>"><?php echo $variables["contacto"]->nombre . " " . $variables["contacto"]->apellidos ?></a>:</h3>
        <div class="panel" id="conversacion-2">
            <?php foreach ($variables["mensajes"] as $mensaje): ?>
                <?php if ($mensaje->emisor_id == $variables["contacto"]->id): ?>
                    <p class="msg msg-amigo"><?php echo $controlador->buscarEmoji($mensaje->texto) ?></p>
                <?php else: ?>
                    <p class="msg msg-propio"><?php echo $controlador->buscarEmoji($mensaje->texto) ?></p>
                <?php endif; ?>
            <?php endforeach; ?><div class="clear"></div>
        </div>
        <div>
            <form action="../servicios/usuarioHandler.php?action=enviarMensaje&redirect=<?php echo $variables["contacto"]->id ?>" method="post" id="enviarMensajeForm-2">
                <textarea class="campo-formulario" placeholder="Escribe aquí tu mensaje" id="textArea-2" required></textarea>
                <input type="hidden" value="<?php echo $variables["contacto"]->id ?>" name="idContacto" required>
                <input type="hidden" value="" name="texto" id="texto-2">
                <input type="submit" class="campo-formulario" value="Enviar" id="enviarMensajeBtn-2">
            </form>
        </div>
        <script>
            $(document).on("ready", function () {
                var objDiv = document.getElementById("conversacion-2");
                objDiv.scrollTop = objDiv.scrollHeight;

                $("#enviarMensajeBtn-2").on("click", function (e) {

                    e.preventDefault();
                    $("#texto-2").val(buscarEmoji($("#textArea-2").val()));
                    $("#enviarMensajeForm-2").submit();
                });
            });
        </script>
    <?php endif; ?>
</div>
<script>
    $(document).on('ready', function () {
        $("#conversaciones-recientes > div").width(<?php echo count($variables["contactos"]) * 178 ?>);
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
