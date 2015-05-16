<?php
session_start();

require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->anadirAsignatura();

ob_start();
?>


<form action="../servicios/adminHandler.php?action=anadirAsignatura" method="post">

    <h3>Datos de la asignatura:</h3>
    <label>Nombre:</label>
    <input type="text" name="nombre" placeholder="Nombre de la asignatura" class="campo-formulario">
    <label>Curso:</label>
    <input type="number" name="curso" placeholder="Curso de la asignatura" class="campo-formulario">
    <label><span class="fa fa-university"></span> Universidad:</label>
    <select class="campo-formulario" name="universidad">
        <?php foreach ($variables["universidades"] as $universidad): ?>
            <option value="<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></option>
        <?php endforeach; ?>
    </select>
     <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
    <select class="campo-formulario" name="carrera">
        <?php foreach ($variables["carrera"] as $carrera): ?>
            <option value="<?php echo $carrera->id ?>"><?php echo $carrera->nombre ?></option>
        <?php endforeach; ?>
    </select>
     
     <hr>
    <input type="submit" value="Aceptar asignatura nueva" class="campo-formulario">

</form>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
