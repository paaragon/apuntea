<?php ob_start(); ?>



<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> Carreras
    </h2>
    <hr>
    <div>
        <div class="col-10">
            <form>
                <label> Universidad:</label> 
                <select class="campo-formulario campo-en-linea">
                    <option value="#" selected="">Todas</option>
                    <option value="#">UCM</option>
                    <option value="#">UPM</option>
                    <option value="#">UAM</option>
                    <option value="#">De la vida</option>
                </select> 
            </form>
        </div>
        <div>
            <h2>
                <span class="fa fa-plus-circle plus-color"></span>    
            </h2>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <strong><a href="./carrera-perfil.php">Ingeniería informática</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2 carrera-icon"><a href="./carrera-perfil.php"><span class="fa fa-graduation-cap"></span></a> </span>
            <span class="col-2 minus-color"><span class="fa fa-minus-circle"></span> </span>
        </p> 
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <strong><a href="./carrera-perfil.php">Filología clásica</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2 carrera-icon"><a href="./carrera-perfil.php"><span class="fa fa-graduation-cap"></span></a> </span>
            <span class="col-2 minus-color"><span  class="fa fa-minus-circle"></span> </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <strong><a href="./carrera-perfil.php">Química</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2 carrera-icon"><a href="./carrera-perfil.php"><span class="fa fa-graduation-cap"></span></a> </span>
            <span class="col-2 minus-color"><span class="fa fa-minus-circle"></span> </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <strong><a href="./carrera-perfil.php">Física</a></strong>
            </span>
            <span class="col-2"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-2 carrera-icon"><a href="./carrera-perfil.php"><span class="fa fa-graduation-cap"></span></a> </span>
            <span class="col-2 minus-color"><span class="fa fa-minus-circle"></span> </span>
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
