<?php ob_start(); ?>
<section>
    <h1>Carreras</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Carreras</li>
</ul>
<hr>
<form>
    <input type="text" class="campo-formulario" placeholder="Buscar carrera...">
    <label>Universidad: </label>
    <select class="campo-formulario campo-en-linea" name="universidad">
        <option value="todas">Todas</option>
        <option value="[Nombre universidad]">[Nombre universidad]</option>
        <option value="[Nombre universidad]">[Nombre universidad]</option>
        <option value="[Nombre universidad]">[Nombre universidad]</option>
    </select>
</form>
<section>

    <div>
        <h2><span class="fa fa-paint-brush"></span> Artes y humanidades</h2>
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
        <h2><span class="fa fa-rocket"></span> Ciencias</h2>
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
        <h2><span class="fa fa-user-md"></span> Ciencias de la salud</h2>
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
        <h2><span class="fa fa-cogs"></span> Ingeniería y arquitectura</h2>
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
        <h2><span class="fa fa-gavel"></span> Ciencias sociales y jurídicas</h2>
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
