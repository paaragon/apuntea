<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->peticiones();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-user-plus"></span> Peticiones de amistad
    </h2>
    <hr>
    <div>
        <?php if (count($variables["peticiones"]) > 0): ?>
            <?php foreach ($variables["peticiones"] as $peticion): ?>
                <?php $usuario = $peticion->fetchAs("usuario")->alice ?>
                <div class="fila">
                    <p>
                        <span class="col-8">
                            <a href="perfil-usuario.php?id=<?php echo $usuario->id ?>"><?php echo $usuario->nombre ?> @<?php echo $usuario->nick ?></a> Quiere ser tu amigo
                        </span>
                        <span class="col-4"><a href="../servicios/usuarioHandler.php?action=aceptarPeticion&user=<?php echo $usuario->id ?>">Aceptar</a></span>
                    </p>
                    <div class="clear"></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <blockquote><h3>No tienes peticiones de amistad.</h3></blockquote>
        <?php endif; ?>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
