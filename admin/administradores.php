<?php
/* GRAFICA
 * Usuarios+/dia
 */
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->administradores();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-empire"></span> Administradores
    </h2>
    <hr>

    <div>
        <a href="anadir-admin.php" class="boton">Añadir administrador</a>
    </div>
    <?php if (count($variables["administrador"]) > 0): ?>
        <?php
        foreach ($variables["administrador"] as $usuario):
            ?>
            <div class="col-6 contacto" >

                <div class="fila">
                    <p>
                        <strong class="nombre"><?php echo $usuario->nombre . " " . $usuario->apellidos ?></strong> 
                    </p>

                    <p>
                        <a href="mensajes.php?id=<?php echo $usuario->id ?>" class="btn btn-primary">Enviar mensaje</a>
                        <a href="../servicios/adminHandler.php?action=eliminarAdmin&id=<?php echo $usuario->id ?>" class="btn btn-danger">Eliminar admin</a>
                    </p>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    <?php else: ?>
        <blockquote><h3>No hay usuarios.</h3></blockquote>
    <?php endif; ?>
</div>


<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
