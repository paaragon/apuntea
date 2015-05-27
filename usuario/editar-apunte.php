<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->editarApunte();
ob_start();
if($variables["apunte"] != null):
?>
<form action="../servicios/usuarioHandler.php?action=guardarApunte" method="post" id="formulario">
    <div id="head-apunte">
        <span class="col-8">
            <a href="universidad.php?id=<?php echo $variables["apunte"]->asignatura->carrera->universidad->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->universidad->siglas ?></a> / 
            <a href="carrera.php?id=<?php echo $variables["apunte"]->asignatura->carrera->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->nombre ?></a> /
            <a href="asignatura.php?id=<?php echo $variables["apunte"]->asignatura->id ?>"><?php echo $variables["apunte"]->asignatura->nombre ?></a>
        </span>
        <span class="col-2"><a href="javascript:submit();"><span class="fa fa-floppy-o"></span> Guardar</a></span>
        <span class="col-2"><a href="ver-apunte-propio.php"><span class="fa fa-times"></span> Cancelar</a></span>
        <div class="clear"></div>
    </div>
    <div id="contenido-apunte" class="editar-apunte">
        <h2 class="text-center"><?php echo $variables["apunte"]->titulo ?></h2>
        <textarea id="area-apunte" name="contenido"><?php echo $variables["apunte"]->contenido ?></textarea>
        <input type="hidden" value="<?php echo $variables["apunte"]->id ?>" name="apunte">
    </div>
    <h3><span class="fa fa-key"></span>Permisos:</h3>
    <span class="col-4">
        <label><span class="fa fa-eye"></span> Visualización:</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Algunos usuarios</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Público</label>
        <hr>
        <label>Lectores:</label>
        <input type="text" name="lector-1" disabled="" value="[Lector 1]" class="campo-formulario">
        <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    </span>
    <span class="col-4">
        <label><span class="fa fa-edit"></span> Modificación:</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Alguno usuarios</label>
        <hr>
        <label>Usuarios que modifiquen:</label>
        <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
        <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
        <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    </span>
    <span class="col-4">
        <label><span class="fa fa-key"></span> Edición de permisos:</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Solo yo</label>
        <label class="campo-formulario"><input type="radio" name="visualizacion"> Alguno usuarios</label>
        <hr>
        <label>Usuarios que editen permisos:</label>
        <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
        <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
        <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
    </span>
</form>
<script>
    $(document).on("ready", function () {
        CKEDITOR.replace('area-apunte');
    });
    
    function submit(){
        $("#formulario").submit();
    }
</script>
<?php
else:
    echo '<div class="alert alert-warning">Este apunte no existe</div>';
endif;
$contenido = ob_get_clean();
$scripts[] = '<script type="text/javascript" src="../util/ckeditor/ckeditor.js"></script>';
require "../common/usuario/layout.php";
