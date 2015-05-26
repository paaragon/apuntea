<?php ob_start(); ?>
<div class="col-9" id="principal">
    <div class="fila profile">
        <!--Div para el fondo del perfil-->
        <div id="fondo"><img src="../img/fondo-user.jpg"/></div>
        <!--Div para el avatar del perfil-->
        <div id="avatar"><img src="../img/no-user.jpg"/></div>
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
    </div>
    <div class="description">
        <h2 class="col-9">[Nombre y apellidos]</h2>
        <div class="clear"></div>
        <hr>
        <blockquote>
            <p> 
                Aqui se puede contar estados... etc!
            </p>
        </blockquote>
    </div><br>
    <div>
        <div class="clear"></div>
        <section>
            <h2><i class="fa fa-info-circle"></i> Info</h2>
            <div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre completo:</strong> [Nombre completo]</li>
                    <li class="list-group-item"><strong>Edad:</strong> [Edad]</li>
                    <li class="list-group-item"><strong>Universidad:</strong> [Nombre universidad]</li>
                    <li class="list-group-item"><strong>Carrera:</strong> [Nombre carrera]</li>
                </ul>
            </div>
        </section>

        <section>
            <div>
                <p>
                    <a href="usuarios-detalles.php" class="boton">Apuntes</a>
                    <a href="usuarios-detalles-grupos.php" class="boton boton-activo">Grupos</a>
                    <a href="usuarios-detalles-amigos.php" class="boton">Amigos</a>
                </p>
            </div>
            <div>
                <div class="fila">
                    <p>
                        <span class="col-7">
                            <span class="fa fa-lock"></span>
                            <strong><a href="ver-grupo.php"> Grupo Bachillerato</a></strong>
                        </span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-7">
                            <span class="fa fa-globe"></span>
                            <strong><a href="ver-grupo.php"> Grupo Biblioteca</a></strong>
                        </span>
                    </p>
                    <div class="clear"></div>
                </div>
                <div class="fila">
                    <p>
                        <span class="col-7">
                            <span class="fa fa-lock"></span>
                            <strong><a href="ver-grupo.php"> Grupo Universidad</a></strong>
                        </span>
                    </p>
                    <div class="clear"></div>
                </div>
            </div>
        </section>
        <div class="fila">
            <h3>Opciones de administrador:</h3>

            <h4>Enviar mensaje al usuario:</h4>
            <form action="usuarios-detalles.php" method="post">
                <textarea class="campo-formulario"></textarea>
                <input type="submit" class="campo-formulario">
            </form>
            <p>
                <a href="usuarios.php" class="boton campo-formulario">Eliminar usuario</a>
            </p>
        </div>
    </div>
</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
