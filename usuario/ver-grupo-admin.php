<?php ob_start(); ?>

<div id="principal">
    <h2>
        <span class="fa fa-group"></span> Grupo 1
    </h2>
    <hr>
    <h3 class="col-6">Miembros</h3>
    <br>
     <h5 class="col-3">
         <form method="post">
            <span>
            <input type="text" class="campo-formulario" placeholder="Nombre usuario">
            </span>  
        </form> 
    </h5>
    <h5 class="col-3">
         <form method="post">
            <span>
            <input type="submit" class="campo-formulario" value="+ Añadir miembro">
            </span>  
        </form> 
    </h5>
    <div id="conversaciones-recientes">
        
        <div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status"><span class="fa fa-trash"></span></div>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status"><span class="fa fa-trash"></span></div>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
               <div class="status"><span class="fa fa-trash"></span></div>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status"><span class="fa fa-trash"></span></div>
                <h4><a href="perfil-usuario.php">[Usuario]</a></h4>
            </div>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <div class="status"><span class="fa fa-trash"></span></div>
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
        <div><p><a href="anadir-comentario.php" data-toggle="modal" data-target="#comentariosModal"><span class="fa fa-comment"></span> Añadir comentario</a></p></div>
        <h3 class="col-11">[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <h3 class="col-1">
            <span class="col-5"><span class="fa fa-trash-o"></span></span>
        </h3>
        <div class="clear"></div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
        <h3 class="col-11">[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <h3 class="col-1">
            <span class="col-5"><span class="fa fa-trash-o"></span></span>
        </h3>
         <div class="clear"></div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
        <h3 class="col-11">[Comentario] <small>[Usuario] - [Fecha]</small></h3>
        <h3 class="col-1">
            <span class="col-5"><span class="fa fa-trash-o"></span></span>
        </h3>
         <div class="clear"></div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sed elit eget dui maximus hendrerit non sed leo. Etiam vitae laoreet sem. Praesent et viverra massa. Ut pellentesque nisl at sapien consequat, ac vulputate lectus cursus. Suspendisse potenti. Quisque sit amet pharetra nulla. Fusce nibh neque, euismod nec fringilla eget, rhoncus tempor urna. Curabitur et molestie arcu.
        </p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="comentariosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Añadir comentario</h4>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <strong>Título:</strong>
                        <input type="text" name="titulo" class="control-formulario" placeholder="Título del comentario">
                        <strong>Comentario:</strong>
                        <textarea name="comentario" class="control-formulario" placeholder="Pon aquí tu comentario"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Añadir</button>
                </div>
            </div>
        </div>
    </div>   
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
