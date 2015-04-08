<?php ob_start(); ?>
<body>
   <div class="col-9" id="principal">
    <div>
        <p>
            <a href="inicio/aportaciones.php" class="boton boton-activo"><span class="fa fa-cloud-upload"></span> Mis aportes</a>
            <a href="inicio/novedades.php" class="boton"><span class="fa fa-star"></span> Novedades</a>
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
</body>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
