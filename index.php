<?php ob_start(); ?>
<section id="presentacion">
    <div class="col-md-4"><img src="img/logo.png" class="img-responsive"></div>
    <div class="col-md-8">
        <h3>Bienvenido a <strong>Apuntea</strong> tu red social para compartir apuntes.</h3>
    </div>
    <div class="clearfix"></div>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Inicio</li>
</ol>
<hr>
<section id="descripcion">
    En <strong>apuntea.com</strong> podrás encontrar todos los apuntes que necesites
    de una manera completamente social. Como usuario no registrado no podrás
    acceder a cierto contenido de la página y no podrás pedir permisos de visualización
    de aquellos apuntes que sean privados. Pulsa <a href="#" data-toggle="modal" data-target="#myModal">aqui para registrarte</a>
</section>
<div class="alert alert-info" role="alert">Llevamos un total de <span class="badge" title="Ya quisiéramos...">1250</span> apuntes</div>
<section>
    <div id="top-universidades">
        <div class="slide"><a href="universidad.php"><img src="img/universidades/logoUCM.jpg"></a></div>
        <div class="slide"><a href="universidad.php"><img src="img/universidades/upm-T.gif"></a></div>
        <div class="slide"><a href="universidad.php"><img src="img/universidades/logo_uam.gif"></a></div>
        <div class="slide"><a href="universidad.php"><img src="img/universidades/logo-uah-bp.gif"></a></div>
        <div class="slide"><a href="universidad.php"><img src="img/universidades/Logo_URJC.svg.png"></a></div>
        <div class="slide"><a href="universidad.php"><img src="img/universidades/logo_univ_carlosiii.gif"></a></div>
    </div>
    <p class="text-right"><a href="universidades.php"><span class="label label-primary"><i class="fa fa-plus"></i> Ver todas</span></a></p>
</section>
<div>
    <section class="col-md-4">
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
        <p class="text-right"><a href="carreras.php"><span class="label label-primary"><i class="fa fa-plus"></i> Ver todas</span></a></p>
    </section>
    <section class="col-md-4">
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
        <p class="text-right"><a href="asignaturas.php"><span class="label label-primary"><i class="fa fa-plus"></i> Ver todas</span></a></p>
    </section>
    <section class="col-md-4">
        <h3>Top Apuntes</h3>
        <hr>
        <ul>
            <li><a href="apuntes.php?vis=pub">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pri">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pub">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pri">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pub">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pri">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pub">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pri">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pub">[Nombre apuntes]</a></li>
            <li><a href="apuntes.php?vis=pri">[Nombre apuntes]</a></li>
        </ul>
        <p class="text-right"><a href="lista-apuntes.php"><span class="label label-primary"><i class="fa fa-plus"></i> Ver todas</span></a></p>
    </section>
</div>
<script src="jquery.bxslider/jquery.bxslider.min.js"></script>
<script>
    $(document).ready(function () {
        $('#top-universidades').bxSlider({
            slideWidth: 200,
            minSlides: 1,
            maxSlides: 4,
            slideMargin: 10
        });
    });
</script>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
