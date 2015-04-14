<?php ob_start(); ?>



<div class="col-9">
    <h2>
    <span class="fa fa-graduation-cap"></span> Carreras
</h2>
<hr>
<div>
    <form>
        <label> Universidad:</label> 
        <select class="campo-formulario campo-en-linea">
            <option value="#" selected=""> Todas</option>
            <option value="#">UCM</option>
            <option value="#">UPM</option>
            <option value="#">UAM</option>
            <option value="#">De la vida</option>
        </select> 
    </form>
</div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="#">Ingeniería informátia</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="#">Filología clásica</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="#">Química</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="#">Física</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
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
