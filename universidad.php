<?php ob_start(); ?>
<section id="presentacion">
    <h1>[Nombre universidad]</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="carreras.php">Carreras</a></li>
    <li>[Nombre universidad]</li>
</ol>
<hr>
<form>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <div class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></div>
        </div>
    </div>
</form>
<section>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-paint-brush"></i> Artes y humanidades</h2>
        <hr>
        <ul>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-rocket"></i> Ciencias</h2>
        <hr>
        <ul>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-user-md"></i> Ciencias de la salud</h2>
        <hr>
        <ul>
            <li><a href="carrera.php?uni=[Nombre universidad]"><?php echo "adsf" ?></a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
        </ul>
    </div>
    <div class="rama-conocimiento">
        <h2><i class="fa fa-cogs"></i> Ingeniería y arquitectura</h2>
        <hr>
        <ul>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-gavel"></i> Ciencias sociales y jurídicas</h2>
        <hr>
        <ul>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
            <li><a href="carrera.php?uni=[Nombre universidad]">[Nombre de carrera]</a></li>
        </ul>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";