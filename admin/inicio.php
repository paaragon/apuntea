<?php ob_start(); ?>
<div>
    <p>
        <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
        <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
        <img class="col-4" src="../img/line-graph.gif" class="img-responsive mini-logo">
    </p>
</div>
<div>
    <div class="col-4">
        <div class="col-4">
            <ul class="no-style-list">
                <li><a href="#"> Nº universidades</a></li>
                <li><a href="#"> Nº carreras</a></li>
                <li><a href="#"> Nº asignaturas</a></li>
                <li><a href="#"> Nº apuntes</a></li>
            </ul>
        </div>
        <div class="col-1">
            <ul class="no-style-list">
                <li> 666</li>
                <li> 22</li>
                <li> 101</li>
                <li> 9122</li>
            </ul>
        </div>
    </div>
    <div class="col-8">

    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
