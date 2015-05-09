<?php ob_start(); ?>

<div id="principal">
    <h2>
        <span class="fa fa-group"></span> Grupo 1
    </h2>
    <hr>
    <p><a class="boton" href="grupos.php">Eliminar grupo</a> <a class="boton" href="mensajes.php">Enviar mensaje al administrador</a></p>
    <h3>Miembros</h3>
    <div id="conversaciones-recientes">
        <div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="usuarios-detalles.php">[Usuario]</a></h4>
            </div>
        </div>
    </div>
    <div class="clear"></div>

    <div>
        <h3>
            <br>Aportaciones
        </h3>
        <div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php">Tema 1</a></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php">Tema 1</a></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php">Tema 1</a></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php">Tema 1</a></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php">Tema 1</a></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    
                </p>
                <div class="clear"></div>
            </div>  
        </div>
    </div>
    <div id="comentarios-apuntes">
        <div class="fila">
            <form action="ver-grupo.php" method="post">
                <h3><span class="fa fa-comment"></span> Añadir comentario</h3>
                <textarea class="campo-formulario" name="comentario"></textarea>
                <input type="submit" class="campo-formulario" value="añadir comentario">
            </form>
        </div>
        <div class="fila">
            <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
            </p>
        </div>
        <div class="fila">
            <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
            </p>
        </div>
        <div class="fila">
            <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
            </p>
        </div>
        <div class="fila">
            <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
            </p>
        </div>
        <div class="fila">
            <h3>[Comentario] <small>[Usuario] - [Fecha]</small></h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
            </p>
        </div>
    </div>  
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
