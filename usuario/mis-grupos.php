<?php ob_start(); ?>
<div class="col-9" id="principal">
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
                    <span class="fa fa-circle-o-notch"></span>
                    <strong> Grupo Bachillerato</strong>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 137</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-globe"></span>
                    <strong> Grupo Biblioteca</strong>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 115</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-lock"></span>
                    <strong> Grupo Universidad</strong>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 178</span>
            </p>
            <div class="clear"></div>
        </div>
         <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-circle-o-notch"></span>
                    <strong> Grupo Clase 1ºB</strong>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 68</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-globe"></span>
                <strong> Grupo Grado en Ingenieria Informatica</strong>
            </span>
            <span class="col-4"><span class="fa fa-users"></span> 238</span>
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