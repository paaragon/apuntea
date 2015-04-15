<?php ob_start(); ?>

<div id="principal">
    <h2>
        <span class="fa fa-group"></span> Grupo 1
    </h2>
    <hr>
    <h3>Miembros</h3>
    <div id="conversaciones-recientes">
        <div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
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
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php">Tema 1</a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    <span class="col-1"><span class="fa fa-star"></span></span>
                    <span class="col-1"><span class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php">Tema 1</a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
                    <span class="col-1"><span class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php">Tema 1</a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    <span class="col-1"><span class="fa fa-star"></span></span>
                    <span class="col-1"><span class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php">Tema 1</a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
                    <span class="col-1"><span class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php">Tema 1</a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                    <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                    <span class="col-1"><span class="fa fa-star"></span></span>
                    <span class="col-1"><span class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>  
        </div>
    </div>
    <div id="comentarios-apuntes">
        <div class="fila">
            <form action="ver-apunte-propio.php" method="post">
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
require "../common/usuario/layout.php";
