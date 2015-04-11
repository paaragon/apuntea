<?php ob_start(); ?>
<div class="col-9" id="principal">
    <div>
        <p>
            <a href="mis-grupos.php" class="boton"><span class="fa fa-users"></span> Tus grupos</a>
            <a href="#" class="boton boton-activo"><span class="fa fa-question-circle "></span> Grupos sugeridos</a>
        </p>
    </div>
     <div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-globe"></span>
                    <strong> Grupo Grado en Ingeniería de Computadores</strong>
                </span>
                <span class="col-1"><span class="fa fa-users"></span>103</span>
                <a class=boton:hover> Unirse</a>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-circle-o-notch"></span>
                    <strong> Grupo Clase 2ºA</strong>
                </span>
                <span class="col-1"><span class="fa fa-users"></span>137</span>
                <a class=boton:hover><span class="fa fa-question-circle"></span> Pedir permiso</a>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-circle-o-notch"></span>
                    <strong> Grupo Apuntes AW</strong>
                </span>
                <span class="col-1"><span class="fa fa-users"></span>42</span>
                <a class=boton:hover><span class="fa fa-question-circle"></span> Pedir permiso</a>
            </p>
            <div class="clear"></div>
        </div>
         <div class="fila">
            <p>
                <span class="col-8">
                    <span class="fa fa-globe"></span>
                    <strong> Grupo Grado en Ingeniería del Software</strong>
                </span>
                <span class="col-1"><span class="fa fa-users"></span>103</span>
                <a class=boton:hover>Unirse</a>
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