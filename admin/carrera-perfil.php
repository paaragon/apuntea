<?php ob_start(); ?>

<div class="col-9">
    <div>
        <div class="col-6">
            <h2><span class="fa fa-graduation-cap"></span> Informática</h2>
        </div>
        <div class="col-6">
            <h3 class="carrera-tag"><a href="#"> / UCM</a></h3>
        </div>
    </div>
    <div class="clear"></div>
    <div>
        <hr>
        <div>
            <h3 class="col-3"> Etiquetas:</h3>
            <p class="col-9">
                Ingeniería, matemáticas, electrónica, bases de datos, programación, C/C++, Java
            </p>
        </div>
        <hr>
        <div>
            
            <h3 class="col-3"> Descripción:</h3>
            <p class="col-9">
                Cosas interesantes que a mi no se me ocurren..
            </p>
        </div>
        <hr>
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
