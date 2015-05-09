<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-cloud-upload"></span> Añadir apuntes:
    </h2>
    <hr>
    <!--Creacion principal para subir archivo -->
    <form action="apuntes-subidos.php" method="post">
        <h3>Datos de los apuntes:</h3>
        <label>Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre de los apuntes" class="campo-formulario" required="">
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
        <h3><span class="fa fa-key"></span>Permisos:</h3>
        <span class="col-4">
            <label><span class="fa fa-eye"></span> Visualización:</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion" checked=""> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion"> Algunos usuarios</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion"> Público</label>
            <hr>
            <label>Lectores y grupos:</label>
            <input type="text" name="lector-1" disabled="" value="[Lector 1]" class="campo-formulario">
            <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
            <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
        </span>
        <span class="col-4">
            <label><span class="fa fa-edit"></span> Modificación:</label>
            <label class="campo-formulario"><input type="radio" name="modificacion" checked=""> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="modificacion"> Alguno usuarios</label>
            <hr>
            <label>Usuarios que modifiquen:</label>
            <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
            <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
            <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
            <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
        </span>
        <span class="col-4">
            <label><span class="fa fa-key"></span> Edición de permisos:</label>
            <label class="campo-formulario"><input type="radio" name="edicion-permisos" checked=""> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="edicion-permisos"> Alguno usuarios</label>
            <hr>
            <label>Usuarios que editen permisos:</label>
            <input type="text" name="modificador-1" disabled="" value="[Usuario 1]" class="campo-formulario">
            <input type="text" name="modificador-2" disabled="" value="[Grupo 1]" class="campo-formulario">
            <input type="text" placeholder="Nombre de nuevo usuario o grupo" class="campo-formulario">
            <a href="#"><span class="fa fa-plus"></span> Añadir lector</a>
        </span>
        <input type="submit" value="Crear y redactar" class="campo-formulario">
    </form>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
