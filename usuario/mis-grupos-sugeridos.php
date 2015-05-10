<?php 

session_start();

require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->misGruposSug();


ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-users"></span> Mis grupos
    </h2>
    <hr>
    <div>
        <p>
            <a href="mis-grupos.php" class="boton"><span class="fa fa-users"></span> Tus grupos</a>
            <a href="#" class="boton boton-activo"><span class="fa fa-question-circle "></span> Grupos sugeridos</a>
        </p>
    </div>
    <div>
        <?php
        if (count($variables["gruposSugeridos"]) > 0):
            foreach ($variables["gruposSugeridos"] as $grupos):
        ?>
        <div class="fila">
            <p>
                <span class="col-8">
                   <?php
                   if ($grupos["privacidad"] == 1) {
                       echo '<span class = "fa fa-globe"></span>';
                   } 
                   else if ($grupos["privacidad"] == 2) {
                       echo '<span class = "fa fa-circle-o-notch"></span>';
                   } else {
                       echo '<span class="fa fa-lock"></span>';
                   }
                   ?>
                    <strong><?php $grupos["nombre"] ?></strong>
                </span>
                <span class="col-1"><span class="fa fa-users"></span>103</span>
                <a href="ver-grupo.php"> Unirse</a>
            </p>
            <div class="clear"></div>
        </div> 
    </div>
    <?php
        endforeach;
    else:
        echo "No existen sugerencias de grupos.";
    endif;
    ?>
    
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
