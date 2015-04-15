<?php ob_start(); ?>
<form action="asignatura.php" method="post" class="col-9">
    <h3>Datos de la asignatura:</h3>
    <label>Nombre:</label>
    <input type="text" name="nombre" placeholder="Nombre de la asignatura" class="campo-formulario">
    <label><span class="fa fa-university"></span> Universidad:</label>
    <select class="campo-formulario">
        <option value="UCM">UCM</option>
        <option value="UPM">UPM</option>
        <option value="URJC">URJC</option>
        <option value="UAM">UAM</option>
    </select>
    <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
    <select class="campo-formulario">
        <option value="Informatica">Informatica</option>
        <option value="Derecho">Derecho</option>
        <option value="Medicina">Medicina</option>
        <option value="Chuletas">Chuletas</option>
    </select>
    <hr>
    <input type="submit" value="Aceptar asignatura nueva" class="campo-formulario">
</form>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
