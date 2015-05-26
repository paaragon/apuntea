<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-user"></span> Mis contactos
    </h2>
    <hr>
    <div>
        <!-- Linea de botones-->
        <p>
            <a href="mis-contactos.php" class="boton"><span class="fa fa-users"></span> Todos</a>
            <a href="mis-contactos-reco.php" class="boton boton-activo"><span class="fa fa-star"></span> Recomendados</a>
        </p>
        <!-- Form para la busqueda de contactos-->
        <form action="mis-contactos.php" method="post">
            <input type="text" class="campo-formulario" placeholder="Buscar Contacto...">
            <input type="submit" class="campo-formulario" value="Buscar">
        </form>
    </div>
    <hr>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <div class="fila">
            <div class="col-5"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-7">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="perfil-usuario.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
                <p>
                    <span class="distintivo">450</span> Amigos<br><br>
                    <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
