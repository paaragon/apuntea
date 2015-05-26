<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-key"></span> Peticiones de acceso al <a href="ver-grupo-admin.php">[Nombre de grupo]</a>
    </h2>
    <hr>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-8">
                <a href="perfil-usuario.php">[Nombre de usuario]</a> quiere acceder al grupo
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Aceptar</a>
            </span>
            <span class="col-2">
                <a href="peticiones-grupo.php" class="boton">Rechazar</a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
