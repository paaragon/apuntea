<?php ob_start(); ?>
<div class="col-9">
    <h2>
        <span class="fa fa-university"></span> Universidades
    </h2>
    <hr>
    <div>
        <p>
            <a href="universidad-nueva.php" class="boton">Añadir nueva</a>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <strong><a href="perfil-universidad.php">UCM</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2"><span class="fa fa-trash"></span> <strong></strong></span>

        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <strong><a href="perfil-universidad.php">UAM</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2"><span class="fa fa-trash"></span> <strong></strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <strong><a href="perfil-universidad.php">UPM</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2"><span class="fa fa-trash"></span> <strong></strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <strong><a href="perfil-universidad.php">UAH</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2"><span class="fa fa-trash"></span> <strong></strong></span>
        </p>
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
<div class="clear"></div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
