<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->misGruposSug();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-plus"></span> Crear un grupo
    </h2>
    <hr>
    <div>
        <p>
            <a href="mis-grupos.php" class="boton"><span class="fa fa-users"></span> Tus grupos</a>
            <a href="mis-grupos-sugeridos.php" class="boton"><span class="fa fa-question-circle "></span> Grupos sugeridos</a>
            <a href="#" class="boton boton-activo"><span class="fa fa-plus"></span> Crear un grupo</a>
        </p>
    </div>
    <div>
        <form action="../servicios/usuarioHandler.php?action=crearGrupo" method="post">
            <br>
            <label>Nombre del grupo:</label>
            <input type="text" name="nombre" placeholder="Introduzca el nombre del grupo" class="form-control">
            <br>
            <label>Privacidad del grupo:</label><br>
            <label><input name="privacidad" value="0" type="radio"> Privado <small>(Solo el administrador puede añadir miembros al grupo y nadie puede solicitar entrar)</small></label><br>
            <label><input name="privacidad" value="1" type="radio"> Restringido <small>(Solo el administrador puede añadir miembros al grupo pero cualquier usuario puede solicitar entrar)</small></label><br>
            <label><input name="privacidad" value="2" type="radio"> Público <small>(Cualquiera puede unirse)</small></label><br>
            <br>
            <input type="submit" value="Crear grupo" class="form-control btn btn-primary">
        </form>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
