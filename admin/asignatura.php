<?php ob_start(); ?>

<div class="col-9">
    <section>
        <h1><span class="fa fa-file-text-o"></span> [Nombre de asignatura] <small>- <a href="perfil-universidad.php">[Universidad]</a> / <a href="perfil-universidad.php">[Carrera]</a></small></h1>
    </section>
    <hr>
    <p>
        <a href="editar-asignatura.php" class="boton">Editar asignatura</a>
        <a href="asignatura.php" class="boton">Eliminar asignatura</a>
    </p>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <div class="col-9">
            <p><a href="ver-apunte.php">[Ejemplo de apuntes]</a></p>
        </div>
        <div class="col-3">
            <p>
                <span><span class="fa fa-thumbs-up"></span> <span class="badge">4</span></span>
                <span><span class="fa fa-thumbs-down"></span> <span class="badge">0</span></span>
                <span><span class="fa fa-eye"></span> <span class="badge">199</span></span>
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

<div class="clear"></div>


<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
