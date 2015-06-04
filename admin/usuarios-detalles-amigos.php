<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
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
                    <a href="usuarios-detalles-grupos.php" class="boton">Grupos</a>
                    <a href="usuarios-detalles-amigos.php" class="boton boton-activo">Amigos</a>
                </p>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                        <strong><a href="usuarios-detalles.php"> Rodolfo langostino</a></strong>
                    </span>
                    <span class="col-1"> UCM</span>
                    <span class="col-2"><span class="fa fa-file"></span> 13</span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                        <strong><a href="usuarios-detalles.php"> Sinchan42</a></strong>
                    </span>
                    <span class="col-1"> UCM</span>
                    <span class="col-2"><span class="fa fa-file"></span> 7</span>            </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                        <strong><a href="usuarios-detalles.php"> Chiquito</a></strong>
                    </span>
                    <span class="col-1"> UCM</span>
                    <span class="col-2"><span class="fa fa-file"></span> 5</span>            </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                        <strong><a href="usuarios-detalles.php"> Matutano-man</a></strong>
                    </span>
                    <span class="col-1"> UCM</span>
                    <span class="col-2"><span class="fa fa-file"></span> 101</span>            </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                        <strong><a href="usuarios-detalles.php"> Uno_que_pasaba_por_aqui</a></strong>
                    </span>
                    <span class="col-1"> UCM</span>
                    <span class="col-2"><span class="fa fa-file"></span> -1</span>            </p>
                <div class="clear"></div>
            </div>
    </div>
    <div class="fila">
        <h3>Opciones de administrador:</h3>

        <h4>Enviar mensaje al usuario:</h4>
        <form action="usuarios-detalles.php" method="post">
            <textarea class="campo-formulario"></textarea>
            <input type="submit" class="campo-formulario" value="Enviar mensaje">
        </form>
        <p>
            <a href="usuarios.php" class="boton campo-formulario">Eliminar usuario</a>
        </p>
    </div>
</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    </p>
</div>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
