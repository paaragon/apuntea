<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
<h2>
    <span class="fa fa-home"></span> Inicio
</h2>
<hr>
<p>
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    <span class="clear"></span>
</p>
<div class="col-3">
    <h3>Cifras:</h3>
    <div class="fila ">
        <div class="col-8">
            <ul class="no-style-list">
                <li><strong>Nº universidades</strong></li>
                <li><strong>Nº carreras</strong></li>
                <li><strong>Nº asignaturas</strong></li>
                <li><strong>Nº apuntes</strong></li>
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
                <span class="fa fa-users"></span>
                <strong> <em>serfati</em> se ha añadido a tu lista de amigos</strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-pencil-square"></span>
                <strong> <em>irepas01</em> ha modificado el archivo <em> Tema 1</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-plus-square"></span>
                <strong> <em>MrSlide22</em> ha añadido el archivo <em> Tema 3</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong> <em> Kherdu </em> forma parte del grupo <em> Apuntes Aplicaciones Web</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-user-plus"></span>
                <strong> <em> McMachote </em> te ha incluido en el grupo <em> Proyecto AW</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
