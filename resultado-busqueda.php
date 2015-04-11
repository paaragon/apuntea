<?php
if ($_POST["opcion"] == "universidades") {
    $url = "universidad.php";
    $res = '<li><a href="universidad.php">[Nombre universidad]</a></li>';
} else if ($_POST["opcion"] == "carreras") {
    $url = "carrera.php";
    $res = '<li><a href="carrera.php">[Nombre universidad] / [Nombre carrera]</a></li>';
} else {
    $url = "asignatura.php";
    $res = '<li><a href="asignatura.php">[Nombre universidad] / [Nombre carrera]</a></li>';
}
ob_start();
?>
<section>
    <h1>Resultados de búsqueda</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Búsqueda</li>
    <li><?php echo $_POST["consulta"] ?></li>
</ul>
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
