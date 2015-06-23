<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->grupoAdmin();

ob_start();
?>

<div id="principal">
    <?php if (isset($variables["grupo"])): ?>
        <h2>
            <span class="fa fa-group"></span>
            <?php echo $variables["grupo"]->nombre ?>
        </h2>
        <hr>
        <p class="col-6">
            <a href="peticiones-grupo.php?id=<?php echo $variables["grupo"]->id ?>" class="boton">Ver <span class="distintivo"><?php echo count($variables["peticiones"]) ?></span> peticiones nuevas</a>
        </p>
        <form action="../servicios/usuarioHandler.php?action=anadirUsuarioGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>" method="post">
            <p class="col-6">
                <span class="col-6">
                    <input type="text" class="campo-formulario" name="nick" placeholder="Nick del usuario">
                </span>
                <span class="col-6">
                    <input type="submit" class="campo-formulario" value="+ Añadir miembro">
                </span>
            </p>
        </form>
        <div class="clearfix"></div><br>
        <form action="../servicios/usuarioHandler.php?action=editarGrupo" method="post">
            <legend>Modificar privacidad:</legend>
            <label>Privacidad del grupo:</label><br>
            <input type="hidden" name="idGrupo" value="<?php echo $variables["grupo"]->id ?>">
            <label><input name="privacidad" value="0" type="radio" <?php echo ($variables["grupo"]->privacidad == 0) ? "checked=''" : "" ?>> Privado <small>(Solo el administrador puede añadir miembros al grupo y nadie puede solicitar entrar)</small></label><br>
            <label><input name="privacidad" value="1" type="radio" <?php echo ($variables["grupo"]->privacidad == 1) ? "checked=''" : "" ?>> Restringido <small>(Solo el administrador puede añadir miembros al grupo pero cualquier usuario puede solicitar entrar)</small></label><br>
            <label><input name="privacidad" value="2" type="radio" <?php echo ($variables["grupo"]->privacidad == 2) ? "checked=''" : "" ?>> Público <small>(Cualquiera puede unirse)</small></label><br>
            <br>
            <input type="submit" value="Cambiar privacidad" class="form-control btn btn-primary">
        </form>
        <h3 class="col-6">Miembros</h3>
        <br>
        <div id="conversaciones-recientes">
            <div>
                <?php
                if (isset($variables["usuarios"])) {
                    foreach ($variables["usuarios"] as $user) {
                        ?>
                        <div class="picture fila">
                            <p>
                                <img src="../img/usuarios/perfil/<?php echo $user->usuario->avatar ?>" class="profile-img">
                            </p>
                            <div class="status"><a href ="../servicios/usuarioHandler.php?action=borrarUsuarioGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $user->usuario_id ?>" ><span class="fa fa-trash" title="Añadir administrador"></span></a></div>
                            <?php if ($user->isadmin == 0) { ?>
                                <div class="status"><a href ="../servicios/usuarioHandler.php?action=anadirAdminGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $user->usuario_id ?>" ><span class="fa fa-plus"></span></a></div>
                            <?php } else { ?>
                                <div class="status"><a href ="../servicios/usuarioHandler.php?action=eliminarAdminGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $user->usuario_id ?>" ><span class="fa fa-minus" title="Quitar administrador"></span></a></div>
                            <?php } ?>
                            <h4><a href="perfil-usuario.php?id=<?php echo $user->usuario->id ?>"><?php echo $user->usuario->nombre ?></a></h4>
                        </div>
                        <?php
                    }
                } else {
                    echo "No hay usuarios en este grupo";
                }
                ?>
            </div>
        </div>
        <div class="clear"></div>

        <div>
            <h3>
                <br>Aportaciones
            </h3>
            <div>
                <?php
                if (count($variables["apuntes"]) > 0) {
                    foreach ($variables["apuntes"] as $apunte) {
                        ?>
                        <div class="fila">
                            <p>
                                <span class="col-7">
                                    <span class="fa fa-file-text-o"></span>
                                    <strong><a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><?php echo $apunte->titulo ?></a></strong>
                                </span>
                                <?php
                                $like = new Like($apunte);
                                $dislike = new Dislike($apunte);
                                $fav = new Fav($apunte);
                                ?>
                                <span class="col-1"><?php echo $like->generateLike(); ?></span>
                                <span class="col-1"><?php echo $dislike->generateDislike(); ?></span>
                                <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte->visualizaciones ?></span>
                                <span class="col-1"><?php echo $fav->generateFav(); ?></span>
                                <span class="col-1"><a href="../servicios/usuarioHandler.php?action=eliminarApunteGrupo&idApunte=<?php echo $apunte->id ?>&idGrupo=<?php echo $variables["grupo"]->id ?>&admin=1"><span class="fa fa-trash-o"></span></a></span>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <?php
                    }
                } else
                    echo "No hay aportaciones a este grupo";
                ?>
                <form action="../servicios/usuarioHandler.php?action=anadirApunteGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $user->usuario_id ?>&admin=1"  method="post">
                    <legend>Añadir apuntes al grupo:</legend>
                    <label>Apuntes:</label>
                    <select name="apunte" class="form-control">
                        <?php foreach ($variables["misapuntes"] as $apun): ?>
                            <option value="<?php echo $apun->id ?>"><?php echo $apun->titulo ?></option>
                        <?php endforeach; ?>
                    </select><br>
                    <input type="submit" value="Añadir apunte" class="form-control btn btn-primary">
                </form>
            </div>
        </div>
        <div id="comentarios-apuntes">
            <div class="fila">
                <form action="../servicios/usuarioHandler.php?action=anadirComentarioGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>" method="post">
                    <h3><span class="fa fa-comment"></span> Añadir comentario</h3>
                    <textarea class="campo-formulario" name="comentario"></textarea>
                    <input type="hidden" name="isAdmin" value="1">
                    <input type="submit" class="campo-formulario" value="Añadir comentario">
                </form>
            </div>
            <div class="fila">
                <?php
                if (isset($variables["comentarios"])) {
                    foreach ($variables["comentarios"] as $comentario) {
                        ?>
                        <h3><?php echo $comentario->usuario->nombre ?>   <small><?php echo date("d-m-Y H:i", strtotime($comentario->fecha)) ?></small></h3>
                        <p>
                            <?php echo $comentario->texto ?>
                        </p>
                    </div>
                    <?php
                }
            } else
                echo "No hay comentarios en este grupo";
            ?>
        </div>
    <?php else: ?>
        <h2>
            <span class="fa fa-group"></span>
            Grupo no encontrado
        </h2>
    <?php endif; ?>
</div>
<script>

    $(document).ready(function () {
        $("#conversaciones-recientes > div").width(<?php echo isset($variables["usuarios"]) ? count($variables["usuarios"]) * 178 : 0 ?>);

<?php if (count($variables["apuntes"]) > 0): ?>
    <?php echo $like->generateAjaxScript(); ?>
    <?php echo $dislike->generateAjaxScript(); ?>
    <?php echo $fav->generateAjaxScript(); ?>
<?php endif; ?>
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
