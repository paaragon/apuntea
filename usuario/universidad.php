<?php ob_start(); ?>
<section id="presentacion">
    <h1>[Nombre universidad]</h1>
</section>
<ul class="breadcrumb">
    <li><a href="lista-universidades.php">Archivo</a></li>
    <li>[Nombre universidad]</li>
</ul>
<form action="#" method="post">
    <input type="text" class="campo-formulario" placeholder="Buscar...">
</form>
<section>

    <div class="rama-conocimiento">
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
require "../common/usuario/layout.php";
