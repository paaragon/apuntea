<?php ob_start(); ?>
<div class="col-9">
    <h2>
        <span class="fa fa-file-text-o"></span> Asignaturas
    </h2>
    <hr>
    <p>
        <a href="asignaturas-nuevas.php" class="boton">Añadir asignatura</a>
    </p>
    <form action="asignaturas.php" method="post">
        <label>Nombre:</label>
        <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario">
        <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
        <select class="campo-formulario">
            <option value="Informatica">Informatica</option>
            <option value="Derecho">Derecho</option>
            <option value="Medicina">Medicina</option>
            <option value="Chuletas">Chuletas</option>
        </select>
        <label><span class="fa fa-university"></span> Universidad:</label>
        <select class="campo-formulario">
            <option value="UCM">UCM</option>
            <option value="UPM">UPM</option>
            <option value="URJC">URJC</option>
            <option value="UAM">UAM</option>
        </select>
    </form>
    <h3>Listado de asginaturas</h3>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-10">
            <p><a href="asignatura.php">[Nombre Asignatura]</a> - <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-carrera.php">[Carrera]</a></p>
        </div>
        <div class="col-2">
            <p>
                <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                <span><a href="asignaturas.php"><span class="fa fa-trash"></a></span>
            </p>
        </div>
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

