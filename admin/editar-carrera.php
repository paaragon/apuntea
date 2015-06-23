<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->editarCarrera();
$ramas = array('Artes y humanidades', 'Ciencias', 'Ciencias de la salud', 'Ingeniería y arquitectura', 'Ciencias sociales y jurídicas');
ob_start();
?>

<h2>
    <span class="fa fa-graduation-cap"></span> Editar carrera
</h2>
<hr>
<?php if (isset($variables["carrera"])): ?>
    <form action="../servicios/adminHandler.php?action=editarCarrera" method="post">
        <input type="hidden" value="<?php echo $variables["carrera"]->id ?>" name="idCarrera">
        <label>Nombre:</label>
        <input type="text" name="nombre" required="" class="campo-formulario" placeholder="Introduce el nuevo nombre" value="<?php echo $variables["carrera"]->nombre ?>">
        <label>Universidad:</label>
        <select class="campo-formulario" name="universidad">
            <?php foreach ($variables["universidades"] as $universidad): ?>
                <option value="<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></option>
            <?php endforeach; ?>
        </select>
        <label>Rama:</label>
        <select class="campo-formulario" name="rama">
            <?php foreach ($ramas as $rama): ?>
                <?php if ($variables["carrera"]->rama == $rama): ?>
                    <option value="<?php echo $rama ?>" selected=""><?php echo $rama ?></option>
                <?php else: ?>
                    <option value="<?php echo $rama ?>"><?php echo $rama ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Guardar cambios" class="campo-formulario">
    </form>
<?php else: ?>
    <blockquote><h3>Carrera no encontrada.</h3></blockquote>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

