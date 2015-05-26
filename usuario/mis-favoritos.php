<?php ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-file-text-o"></span> Mis apuntes
    </h2>
    <hr>
    <div>
        <p>
            <a href="mis-apuntes.php" class="boton"><span class="fa fa-cloud-upload"></span> Subidos</a>
            <a href="mis-favoritos.php" class="boton boton-activo"><span class="fa fa-star"></span> Favoritos</a>
        </p>
    </div>
    <div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <strong><a href="ver-apunte.php">Tema 1</a></strong>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <strong><a href="ver-apunte.php">Tema 1</a></strong>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-file-text-o"></span>
                    <strong><a href="ver-apunte.php">Tema 1</a></strong>
                </span>

                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                <span class="col-1"><span class="fa fa-star apunte-favorito"></span></span>
            </p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
