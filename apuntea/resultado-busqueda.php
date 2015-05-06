<section>
    <h1>Resultados de búsqueda</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Búsqueda</li>
    <li>[Consulta]</li>
</ul>
<hr>
<section>
    <h2>Resultado de la búsqueda</h2>
    <ul>
        <li><a href="universidad.php">Resultado (Universidad)</a></li>
        <li><a href="carrera.php">Resultado (Carrera)</a></li>
        <li><a href="asignatura.php">Resultado (Asignatura)</a></li>
    </ul>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
