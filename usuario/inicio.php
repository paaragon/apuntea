<?php ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-newspaper-o"></span> Novedades
    </h2>
    <hr>
    <div>
        <p>
            <a href="#" class="boton boton-activo"><span class="fa fa-file-o"></span> Sobre mis aportaciones </a>
            <a href="mis-novedades.php" class="boton"><span class="fa fa-star"></span> Otras Novedades </a>
        </p>
    </div>
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
    </div>
</div>
<div class="col-3">
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
