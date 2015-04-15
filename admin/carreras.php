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
                    <option value="todas" selected="">Todas</option>
                    <option value="ucm">UCM</option>
                    <option value="upm">UPM</option>
                    <option value="uam">UAM</option>
                    <option value="dlv">De la vida</option>
                </select> 
            </form>
        </div>
        <div>
            <a href="anadir-carrera.php" class="boton">Añadir carrera</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="perfil-carrera.php">Ingeniería informática</a> <small>/ <a href="perfil-universidad.php">[Nombre universidad]</a></small></strong>
            </span>
            <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-1 minus-color"><a href="carreras.php"><span class="fa fa-trash"></span></a></span>
        </p> 
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="perfil-carrera.php">Química</a> <small>/ <a href="perfil-universidad.php">[Nombre universidad]</a></small></strong>
            </span>
            <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-1 minus-color"><a href="carreras.php"><span class="fa fa-trash"></span></a></span>
        </p> 
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="perfil-carrera.php">Magisterio</a> <small>/ <a href="perfil-universidad.php">[Nombre universidad]</a></small></strong>
            </span>
            <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-1 minus-color"><a href="carreras.php"><span class="fa fa-trash"></span></a></span>
        </p> 
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <strong><a href="perfil-carrera.php">Filología Tolkien</a> <small>/ <a href="perfil-universidad.php">[Nombre universidad]</a></small></strong>
            </span>
            <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
            <span class="col-1 minus-color"><a href="carreras.php"><span class="fa fa-trash"></span></a></span>
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
