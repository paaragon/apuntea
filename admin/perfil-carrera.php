<?php ob_start(); ?>

<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> [Nombre carrera] <small><a href="perfil-universidad.php">/ [UCM]</a></small>
    </h2>
    <hr>
    <p>
        <a href="editar-carrera.php" class="boton">Editar carrera</a>
        <a href="carreras.php" class="boton">Eliminar carrera</a>
    </p>
    <div class="col-6">
        <h3>Alumnos:</h3>
        <hr>
        <div class="fila">
            <div class="col-3"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-9">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="usuarios-detalles.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-3"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-9">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="usuarios-detalles.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-3"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-9">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="usuarios-detalles.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-3"><p><img src="../img/no-user.jpg" class="img-responsive"/></p></div>
            <div class="col-9">
                <p>
                    <strong>Cholo 1</strong> 
                    <small><a href="usuarios-detalles.php" class="color-green">@user1</a></small>
                </p>
                <blockquote>
                    <p>
                        Adios Mundo!
                    </p>
                </blockquote>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="col-6">
        <h3>Apuntes:</h3>
        <hr>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <label><a href="ver-apunte.php">Tema 1</a></label>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                <span class="col-1"><span class="fa fa-trash-o"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <label><a href="ver-apunte.php">Tema 1</a></label>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                <span class="col-1"><span class="fa fa-trash-o"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <label><a href="ver-apunte.php">Tema 1</a></label>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                <span class="col-1"><span class="fa fa-trash-o"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <label><a href="ver-apunte.php">Tema 1</a></label>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                <span class="col-1"><span class="fa fa-trash-o"></span></span>
            </p>
            <div class="clear"></div>
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
