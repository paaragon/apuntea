<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="principal">
    <div class="fila profile">
        <!--Div para el fondo del perfil-->
        <div id="fondo"><img src="../img/fondo-user.jpg"/></div>
        <!--Div para el avatar del perfil-->
        <div id="avatar"><img src="../img/no-user.jpg"/></div>
        <!--Eventos relacionados con el perfil-->
        <!--AÑADIR AL CSS PARA QUE ENVIE LOS ELEMENTOS DE LA LISTA A LA DERECHA-->
        <ul id="actividad">
            <li id="actividad-1">
                <span>355</span>
                <small>Amigos</small>
            </li>
            <li id="actividad-2">
                <span>355</span>
                <small>Apuntes</small>
            </li>
            <li id="actividad-3">
                <span>355</span>
                <small>Comentarios</small>
            </li>
        </ul>
        <div class ="clear"></div>
        <!--Contiene los elementos principales del perfil social-->
        <div class="description">
            <h2 class="col-sm-9">[Nombre y apellidos]</h2>
            <p class="col-sm-3"><a href="mis-mensajes.php" class="boton">Enviar mensaje</a></p>
            <div class="clear"></div>
            <hr>
            <blockquote>
                <p> 
                    Aqui se puede contar estados... etc!
                </p>
            </blockquote>
            <!--Principal social dentro del pefil-->
            <div class="col-sm-7">
                <h2><i class="fa fa-child"></i> Social</h2>
                <hr>
                <div class="fila">
                    <p>
                        <span class="col-10">
                            <span class="fa fa-smile-o"></span>
                            <strong>Actividad social reciente hace unos momentos</strong>

                        </span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                        <span class="clear"></span>
                        <span class="activity-time">Hace unos minutos</span>
                    </p>
                </div>
            </div>
            <!--Principal actividades dentro del perfil-->
            <div class="col-sm-5">
                <h2><i class="fa fa-cogs"></i> Actividades</h2>
                <hr>
                <div class="fila">
                    <p>
                        <span class="col-10">
                            <span class="fa fa-users"></span>
                            <strong><a href="mis-contactos.php">Se ha hecho amigo de Pepito </a></strong>
                        </span
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                        <span class="clear"></span>
                    </p>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-10">
                            <span class="fa fa-file-text-o"></span>
                            <strong><a href="ver-apunte-propio.php">Publicacion de apuntes</a></strong>
                        </span
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                        <span class="clear"></span>
                    </p>
                </div>
            </div>
            <div class="clear"></div>
            <div>
                <h3><span class="fa fa-file-text-o"></span> Apuntes:</h3>
                <div class="fila">
                    <p>
                        <span class="col-6">
                            <span class="fa fa-file-text-o"></span>
                            <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
                        </span>

                        <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
                        <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-6">
                            <span class="fa fa-file-text-o"></span>
                            <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
                        </span>

                        <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
                        <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-6">
                            <span class="fa fa-file-text-o"></span>
                            <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
                        </span>

                        <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
                        <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-6">
                            <span class="fa fa-file-text-o"></span>
                            <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
                        </span>

                        <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
                        <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-6">
                            <span class="fa fa-file-text-o"></span>
                            <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
                        </span>

                        <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
                        <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
                        <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                    </p>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
