<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->grupo();

ob_start();
?>
<div id="principal">
    <?php if (isset($variables["grupo"])): ?>
        <h2>
            <span class="fa fa-group"></span>
            <?php echo $variables["grupo"]->nombre ?>
        </h2>
        <hr>
        <h3>Miembros</h3>
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
                                <span class="col-1"><a href="../servicios/usuarioHandler.php?action=eliminarApunteGrupo&idApunte=<?php echo $apunte->id ?>&idGrupo=<?php echo $variables["grupo"]->id ?>"><span class="fa fa-trash-o"></span></a></span>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<blockquote>No hay aportaciones a este grupo</blockquote>";
                }
                ?>
                <br>
                <form action="../servicios/usuarioHandler.php?action=anadirApunteGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>&idUsuario=<?php echo $user->usuario_id ?>&admin=0"  method="post">
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
                    <input type="submit" class="campo-formulario" value="Añadir comentario">
                </form>
            </div>
            <div class="fila">
                <?php
                if (isset($variables["comentarios"])) {
                    foreach ($variables["comentarios"] as $comentario) {
                        ?>
                        <h3><?php echo $comentario->usuario->nombre ?>   <small><?php echo $comentario->fecha ?></small></h3>
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
        <blockquote><h3>No puedes ver la información de este grupo.</h3></blockquote>
    <?php endif; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
