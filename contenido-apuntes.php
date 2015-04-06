<?php ob_start(); ?>
<section id="presentacion">
    <h1>Carreras</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Carreras</li>
</ol>
<hr>
<form>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <div class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></div>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
            Selecciona la universidad
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="carreras.php">Todas</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="universidad.php">[Nombre universidad]</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="universidad.php">[Nombre universidad]</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="universidad.php">[Nombre universidad]</a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="universidad.php">[Nombre universidad]</a></li>
        </ul>
    </div>
</form>
<section>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-paint-brush"></i> Artes y humanidades</h2>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-rocket"></i> Ciencias</h2>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-user-md"></i> Ciencias de la salud</h2>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
        </ul>
    </div>
    <div class="rama-conocimiento">
        <h2><i class="fa fa-cogs"></i> Ingeniería y arquitectura</h2>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
        </ul>
    </div>

    <div class="rama-conocimiento">
        <h2><i class="fa fa-gavel"></i> Ciencias sociales y jurídicas</h2>
        <hr>
        <ul>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
            <li><a href="carrera.php">[Nombre de carrera]</a></li>
        </ul>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
