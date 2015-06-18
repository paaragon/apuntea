<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->peticionesApuntes();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-key"></span> Peticiones de visualizacion de apuntes
    </h2>
    <hr>
    <?php
    if (isset($variables["peticiones"])) {
        foreach ($variables["peticiones"] as $peticiones) {
            ?>
            <div class="fila">
                <p>
                    <span class="col-8">
                        <a href="perfil-usuario.php"><?php echo $peticiones->usuario->nombre ?></a> quiere acceder al apunte <a href="ver-apunte.php?id=<?php echo $peticiones->apunte->id ?>"><?php echo $peticiones->apunte->titulo ?></a>
                    </span>
                    <span class="col-2">
                        <a href ="../servicios/usuarioHandler.php?action=aceptarPeticionApunte&idPeticion=<?php echo $peticiones->id ?>" class="boton">Aceptar</a>
                    </span>
                    <span class="col-2">
                        <a href ="../servicios/usuarioHandler.php?action=borrarPeticionApunte&idPeticion=<?php echo $peticiones->id ?>" class="boton">Rechazar</a>
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
