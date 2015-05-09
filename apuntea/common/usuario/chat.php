<div class="panel" id="chat">
    <div class="panel-cabecera"><h4><strong>Chat</strong></h4></div>
    <div class="panel-cuerpo">
        <h5><strong>Usuarios conectados:</strong><img src="../img/loading.gif" id="loading"></h5>
        <hr>
        <p id="contactos-conectados">
        </p>
        <hr>
        <div id="panel-conversacion">
            <h5><strong>Conversación con <a href="perfil-usuario.php" id="nombre-conversacion"></a>:</strong></h5>
            <div class="panel" id="conversacion">
            </div>
            <div id="loading-msg"><img src="../img/loading.gif"></div>
            <textarea class="campo-formulario" placeholder="Escribe aquí tu mensaje" id="texto" required></textarea>
            <input type="hidden" id="idContacto">
            <input type="submit" id="enviarMensaje" class="campo-formulario" value="Enviar">
        </div>
        <p><a href="#">Ocultar chat</a></p>
    </div>
</div>
<script src="../js/chat.js"></script>