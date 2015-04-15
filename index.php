<?php ob_start(); ?>
<section>
    <div class="col-4"><img src="img/logo.png" class="img-responsive"></div>
    <div class="col-8">
        <h3>Bienvenido a <strong>Apuntea</strong> tu red social para compartir apuntes.</h3>
    </div>
    <div class="clearfix"></div>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Inicio</li>
</ul>
<hr>
<section>
    <p>
        En <strong>apuntea.com</strong> podrás encontrar todos los apuntes que necesites
        de una manera completamente social. Como usuario no registrado no podrás
        acceder a cierto contenido de la página y no podrás pedir permisos de visualización
        de aquellos apuntes que sean privados. Pulsa <a href="#" data-toggle="modal" data-target="#myModal">aqui para registrarte</a>
    </p>
</section>
<div class="alerta alerta-info">
    <p>Llevamos un total de <span class="distintivo" title="Ya quisiéramos...">1250</span> apuntes</p>
</div>
<section>
    <div id="top-universidades">
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/LogoUCM.jpg"></a></div>
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/upm-T.gif"></a></div>
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/logo_uam.gif"></a></div>
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/logo-uah-bp.gif"></a></div>
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/Logo_URJC.svg.png"></a></div>
        <div class="slide col-2"><a href="universidad.php"><img src="img/universidades/logo_univ_carlosiii.gif"></a></div>
        <div class="clear"></div>
    </div>
    <p><a href="universidades.php"><span class="etiqueta label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
</section>
<div>
    <section class="col-4">
        <h3>Top Carreras</h3>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
            <li><a href="carrera.php">[Nombre carrera]</a></li>
        </ul>
        <p><a href="carreras.php"><span class="etiqueta label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
    <section class="col-4">
        <h3>Top Asignaturas</h3>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre Asignatura]</a></li>
        </ul>
        <p><a href="asignaturas.php"><span class="etiqueta"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
    <section class="col-4">
        <h3>Top Apuntes</h3>
        <hr>
        <ul>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php">[Nombre apuntes]</a></li>
        </ul>
        <p><a href="lista-apuntes.php"><span class="label label-primary"><span class="fa fa-plus"></span> Ver todas</span></a></p>
    </section>
</div>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
