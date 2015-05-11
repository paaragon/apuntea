<div class="panel" id="chat">
    <div class="panel-cabecera"><h4><strong>Chat</strong></h4></div>
    <div class="panel-cuerpo">
        <h5><strong>Usuarios conectados:</strong><img src="../img/loading.gif" id="loading"></h5>
        <hr>
        <div id="contactos-conectados">
        </div>
        <hr>
        <div id="panel-conversacion">
            <h5><strong>Conversación con <a href="perfil-usuario.php" id="nombre-conversacion"></a>:</strong></h5>
            <div class="panel" id="conversacion">
            </div>
            <div id="loading-msg"><img src="../img/loading.gif"></div>
            <textarea class="campo-formulario" placeholder="Escribe aquí tu mensaje" id="texto" required></textarea>
            <input type="hidden" id="idContacto">
            <input type="submit" id="enviarMensaje" class="campo-formulario" value="Enviar">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Leyenda para iconos
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <ul>
                                <li><span class="twa twa-laughing"></span>: "XD"</li>
                                <li><span class="twa twa-smile"></span>: ":D"</li>
                                <li><span class="twa twa-wink"></span>: ";)"</li>
                                <li><span class="twa twa-kissing-heart"></span>: :*</li>
                                <li><span class="twa twa-cry"></span>: ":_("</li>
                                <li><span class="twa twa-unamused"></span>: "¬¬"</li>
                                <li><span class="twa twa-blush"></span>: "^^"</li>
                                <li><span class="twa twa-sleeping"></span>: "zzz"</li>
                                <li><span class="twa twa-heart"></span>: "<3"</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p><a href="#">Ocultar chat</a></p>
    </div>
</div>
<!--<scirpt src="../js/emoji.js"></scirpt>-->
<script src="../js/chat.js"></script>