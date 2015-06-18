<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->grupoAdmin();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-key"></span> Peticiones de acceso al <a href="ver-grupo-admin.php"><?php echo $variables["grupo"]->nombre ?></a>
    </h2>
    <hr>
    <?php
    if (isset($variables["peticiones"])) {
        foreach ($variables["peticiones"] as $peticiones) {
            ?>
            <div class="fila">
                <p>
                    <span class="col-8">
                        <a href="perfil-usuario.php"><?php echo $peticiones->usuario->nombre ?></a> quiere acceder al grupo
                    </span>
                    <span class="col-2">
                        <a href ="../servicios/usuarioHandler.php?action=aceptarPeticionGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $peticiones->usuario->id ?>" class="boton">Aceptar</a>
                    </span>
                    <span class="col-2">
                        <a href ="../servicios/usuarioHandler.php?action=borrarUsuarioGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $peticiones->usuario->id ?>" class="boton">Rechazar</a>
                    </span>
                </p>
                <div class="clear"></div>
            </div>
            <?php
        }
    } else
        echo "No hay peticiones pendientes";
    ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
