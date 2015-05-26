<?php ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-envelope"></span> Mis mensajes
    </h2>
    <hr>
    <p><small>A esta página se accede desde muchos lugares. Cuando se accede a través de un usuario concreto, aparecerá directamente la conversación con él.</small></p>
    <h3>Conversaciones recientes: </h3>
    <div id="conversaciones-recientes">
        <div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-green"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-green"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status status-red"></div>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
                <p><small>Último mensaje: Domingo</small><p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <h3>Conversación con <a href="usuarios-detalles.php">[Usuario]</a>:</h3>
    <div class="panel" id="conversacion">
        <p class="msg msg-amigo">adrt lsrg lgwpser jndzfg</p>
        <p class="msg msg-propio">señorigj f osij psorgjpoier rm owr ñsldfmg ñsdf spob dñ</p>
        <p class="msg msg-amigo">s rtdfg g sldrgf sxcbn sc fxg</p>
        <p class="msg msg-amigo">sdñfgij dfg</p>
        <p class="msg msg-amigo">dgfdlcgs</p>
        <p class="msg msg-propio">dbñ oij pjg po spo jdog dfvm dlksv slreng pe epirj p speov po nerg ps bpsgn rpb epg sfpo bnsrepov epo ipoiej poei gpeosb nsepob</p>
        <p class="msg msg-amigo">adrt lsrg lgwpser jndzfg</p>
        <p class="msg msg-propio">señorigj f osij psorgjpoier rm owr ñsldfmg ñsdf spob dñ</p>
        <p class="msg msg-amigo">s rtdfg g sldrgf sxcbn sc fxg</p>
        <p class="msg msg-amigo">sdñfgij dfg</p>
        <p class="msg msg-amigo">dgfdlcgs</p>
        <p class="msg msg-propio">dbñ oij pjg po spo jdog dfvm dlksv slreng pe epirj p speov po nerg ps bpsgn rpb epg sfpo bnsrepov epo ipoiej poei gpeosb nsepob</p>
        <div class="clear"></div>
    </div>
    <div>
        <form action="#" method="post">
            <textarea class="campo-formulario" placeholder="Escribe aquí tu mensaje"></textarea>
            <input type="submit" class="campo-formulario" value="Enviar">
        </form>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
