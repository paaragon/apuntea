<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->editarCarrera();

ob_start();
?>

<h2>
    <span class="fa fa-graduation-cap"></span> Editar carrera
</h2>
<hr>
<?php if (isset($variables["carrera"])): ?>
    <form action="perfil-carrera.php" method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required="" class="campo-formulario" placeholder="Introduce el nuevo nombre" value="<?php echo $variables["carrera"]->nombre ?>">
        <input type="submit" value="Guardar cambios" class="campo-formulario">
    </form>
<?php else: ?>
    <blockquote><h3>Carrera no encontrada.</h3></blockquote>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

