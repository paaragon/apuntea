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
                    <div class="col-5"><p><img src="../img/usuarios/perfil/<?php echo $usuario->avatar ?>" class="img-responsive"/></p></div>
                    <div class="col-7">
                        <p>
                            <strong class="nombre"><?php echo $usuario->nombre . " " . $usuario->apellidos ?></strong> 
                            <small><a href="usuarios-detalles.php?id=<?php echo $usuario->id ?>" class="color-green nick">@<?php echo $usuario->nick ?></a></small>
                        </p>
                        
                        <p>
                           <a href="mensajes.php?id=<?php echo $usuario->id ?>" class="boton">Enviar mensaje</a>
                        </p>
                    </div>
                    <div class="clear"></div>
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
