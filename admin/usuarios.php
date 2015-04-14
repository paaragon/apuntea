<?php ob_start(); ?>
<div class="col-9">
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Rodolfo langostino</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 13</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Sinchan42</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 7</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Chiquito</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 5</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Matutano-man</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 101</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Uno_que_pasaba_por_aqui</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> -1</span>            </p>
            <div class="clear"></div>
        </div>
    </div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
