<?php
require "../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->perfilUsuario();

ob_start();
?>
<div id="principal">
    <?php if (isset($variables["usuario"])): ?>
        <div class="fila profile">
            <!--Div para el fondo del perfil-->
            <div id="fondo"><img src="../img/usuarios/portada/<?php echo $variables["usuario"]->imagenportada ?>"/></div>
            <!--Div para el avatar del perfil-->
            <div id="avatar"><img src="../img/usuarios/perfil/<?php echo $variables["usuario"]->avatar ?>"/></div>
            <!--Eventos relacionados con el perfil-->
            <!--AÑADIR AL CSS PARA QUE ENVIE LOS ELEMENTOS DE LA LISTA A LA DERECHA-->
            <ul id="actividad">
                <li id="actividad-1">
                    <span><?php echo count($variables["usuario"]->alias('bob')->ownContactoList) + count($variables["usuario"]->alias('alice')->ownContactoList) ?></span>
                    <small>Amigos</small>
                </li>
                <li id="actividad-2">
                    <span><?php echo count($variables["usuario"]->ownApunteList) ?></span>
                    <small>Apuntes</small>
                </li>
                <li id="actividad-3">
                    <span><?php echo count($variables["usuario"]->ownComentarioapunteList) ?></span>
                    <small>Comentarios</small>
                </li>
            </ul>
            <div class ="clear"></div>
            <!--Contiene los elementos principales del perfil social-->
            <div class="description">
                <h2 class="col-sm-7"><?php echo $variables["usuario"]->nombre . " " . $variables["usuario"]->apellidos ?></h2>
                <p class="col-sm-5 text-right">
                    <a href="mis-mensajes.php?id=<?php echo $variables["usuario"]->id ?>" class="boton">Enviar mensaje</a>
                    <?php if (!$variables["sonAmigos"]): ?>
                        <a href="../servicios/usuarioHandler.php?action=enviarSolicitud&alice=<?php echo $variables["currentuser"] ?>&bob=<?php echo $variables["idUsuario"] ?>" class="boton">Enviar petición de amistad</a>
                    <?php endif; ?>
                </p>
                <div class="clear"></div>
                <hr>
                <blockquote>
                    <p> 
                        <?php echo $variables["usuario"]->estado ?>
                    </p>
                </blockquote>
                <div class="clear"></div>
                <div>
                    <h3><span class="fa fa-file-text-o"></span> Apuntes:</h3>
                    <?php if (count($variables["apuntes"]) > 0): ?>
                        <?php foreach ($variables["apuntes"] as $apunte): ?>
                            <?php
                            $like = new Like($apunte);
                            $dislike = new Dislike($apunte);
                            $fav = new Fav($apunte);
                            ?>
                            <div class="fila">
                                <p>
                                    <span class="col-8">
                                        <span class="fa fa-file-text-o"></span>
                                        <a href="ver-apunte.php?id=<?php echo $apunte->id ?>"> <?php echo $apunte->titulo ?></a>
                                    </span>

                                    <span class="col-1"><?php echo $like->generateLike(); ?></span>
                                    <span class="col-1"><?php echo $dislike->generateDislike(); ?></span>
                                    <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte["visualizaciones"] ?></span>
                                    <!--poner la clase en funcion de si es favorito o no   -->
                                    <span class="col-1"><?php echo $fav->generateFav(); ?></span>
                                </p>
                                <div class="clear"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <blockquote>Este usuario no tiene apuntes que puedas ver.</blockquote>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php elseif ($variables["idUsuario"] != ""): ?>
        <blockquote class="text-danger"><h4><span class="fa fa-lock"></span> No puedes acceder a este perfil porque es privado. <a href="../servicios/usuarioHandler.php?action=enviarSolicitud&alice=<?php echo $variables["currentuser"] ?>&bob=<?php echo $variables["idUsuario"] ?>">Envía una solicitud de amistad</a> para poder ver el perfil.</h4></blockquote>
                <?php else: ?>
        <blockquote><h4>Usuario no encontrado.</h4></blockquote> 
    <?php endif; ?>
</div>
<script>

    $(document).ready(function () {
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
