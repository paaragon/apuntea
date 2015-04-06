<?php
if ($_POST["opcion"] == "universidades") {
    $res = '<li><a href="universidad.php">[Nombre universidad]</a></li>';
} else if ($_POST["opcion"] == "carreras") {
    $res = '<li><a href="carrera.php">[Nombre universidad] / [Nombre carrera]</a></li>';
} else {
    $res = '<li><a href="asignatura.php">[Nombre universidad] / [Nombre carrera]</a></li>';
}
ob_start();
?>
<section id="presentacion">
    <h1>Resultados de búsqueda</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Búsqueda</li>
    <li>Búsqueda</li>
    <li><?php echo $_POST["consulta"] ?></li>
</ol>
<hr>
<section>
    <h2><?php echo ucfirst($_POST["opcion"]) ?></h2>
    <ul>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
        <li><a href="<?php echo $url ?>">[Resultado]</a></li>
    </ul>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
