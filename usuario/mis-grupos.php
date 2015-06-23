<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->misGrupos();
$icons = ["fa-lock", "fa-circle-o-notch", "fa-globe"];
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
            <a href="crear-grupo.php" class="boton"><span class="fa fa-plus"></span> Crear un grupo</a>
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
                            <?php $admin = ($grupos->isadmin == 1) ? "-admin" : "" ?>
                            <a href="ver-grupo<?php echo $admin ?>.php?id=<?php echo $grupos->grupo_id ?>">
                                <span class="fa <?php echo $icons[$grupos->grupo->privacidad] ?>"></span>
                                <strong><?php echo $grupos->grupo->nombre ?></strong>
                                <?php echo ($grupos->isadmin == 1) ? '(Administrador del grupo)' : "" ?>
                            </a>
                        </span>
                        <span class="col-4"><span class="fa fa-users"></span> <?php echo $controlador->countMiembros($grupos->grupo_id) ?></span>
                    </p>
                    <div class="clear"></div>
                </div>

                <?php
            endforeach;
        else:
            echo "<blockquote><h3>No tienes ningun grupo</h3></blockquote>";
        endif;
        ?>
    </div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
