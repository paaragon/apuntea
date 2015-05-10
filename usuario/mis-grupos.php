<?php
session_start();

require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->misGrupos();


ob_start();
?>

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
        <?php
        if (count($variables["gruposUsuario"]) > 0):
            foreach ($variables["gruposUsuario"] as $grupos):
                ?>
                <div class="fila">
                    <p>
                        <span class="col-8">
                            <a href="ver-grupo.php">
                                <?php
                                if ($grupos->grupo->privacidad == 1) {
                                    echo '<span class = "fa fa-globe"></span>';
                                } else if ($grupos->grupo->privacidad == 2) {
                                    echo '<span class = "fa fa-circle-o-notch"></span>';
                                } else {
                                    echo '<span class="fa fa-lock"></span>';
                                }
                                ?>
                                <?php if ($grupos->isadmin == 1) { ?>
                                    <strong> <?php echo $grupos->grupo->nombre ?> (Administrador del grupo) </strong>
                                <?php } ?>
                                <?php if ($grupos->isadmin == 0) { ?>
                                    <strong> <?php echo $grupos->grupo->nombre ?> </strong>
                                <?php } ?>
                            </a>
                        </span>
                        <span class="col-4"><span class="fa fa-users"></span> <?php echo $controlador->countMiembros($grupos->grupo_id) ?></span>
                    </p>
                    <div class="clear"></div>
                </div>
            </div>
            <?php
        endforeach;
    else:
        echo "No tienes ningun grupo";
    endif;
    ?>


</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
