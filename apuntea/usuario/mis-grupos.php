<?php ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-users"></span> Mis grupos
    </h2>
    <hr>
    <div>
        <p>
            <a href="#" class="boton boton-activo"><span class="fa fa-users"></span> Tus grupos</a>
            <a href="mis-grupos-sugeridos.php" class="boton"><span class="fa fa-question-circle "></span> Grupos sugeridos</a>
        </p>
    </div>
    <div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-circle-o-notch"></span>
                        <strong> Grupo Bachillerato</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 137</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo-admin.php">
                        <span class="fa fa-globe"></span>
                        <strong> Grupo Biblioteca (Administrador)</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 115</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-lock"></span>
                        <strong> Grupo Universidad</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 178</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo-admin.php">
                        <span class="fa fa-circle-o-notch"></span>
                        <strong> Grupo Clase 1ºB (Administrador)</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 68</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-globe"></span>
                        <strong> Grupo Grado en Ingenieria Informatica</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 238</span>
            </p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
