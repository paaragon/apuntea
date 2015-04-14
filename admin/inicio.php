<?php ob_start(); ?>
<p>
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <span class="clear"></span>
</p>
<div class="col-3">
    <h3>Cifras:</h3>
    <div class="fila">
        <div class="col-8">
            <ul class="no-style-list">
                <li><a href="#">Nº universidades</a></li>
                <li><a href="#">Nº carreras</a></li>
                <li><a href="#">Nº asignaturas</a></li>
                <li><a href="#">Nº apuntes</a></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="no-style-list">
                <li>666</li>
                <li>22</li>
                <li>101</li>
                <li>9122</li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="col-9">
    <h3>Última actividad:</h3>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong><a href="#">Rodolfo langostino</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong><a href="#">Sinchan42</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong><a href="#">Chiquito</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong><a href="#">Matutano-man</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong><a href="#">Uno_que_pasaba_por_aqui</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php

$contenido = ob_get_clean();
require "../common/admin/layout.php";
