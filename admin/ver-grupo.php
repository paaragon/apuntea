<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->getGrupo();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-group"></span> <?php echo $variables["grupo"]->nombre; ?>
    </h2>
    <hr>
    <p><a id="eliminar" class="boton" href="#">Eliminar grupo</a> <a id="mensaje" class="boton" href="#">Enviar mensaje al administrador</a></p>
    <h3>Miembros</h3>
    <div id="conversaciones-recientes">
        <div>
            <?php
            if (isset($variables['miembros'])) {
                foreach ($variables['miembros'] as $m) {
                    echo "<div class='picture fila'>
                          <p>
                          <img src='../img/usuarios/perfil/" . $m->avatar . "' class='profile-img'>
                          </p>
                          <h4><a href='usuarios-detalles.php'>" . $m->nick . "</a></h4>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>

    <div>
        <h3>
            <br>Aportaciones
        </h3>
    </div>
    <div id="comentarios-apuntes">
        <h3>
            <br>Comentarios
        </h3>
        <?php
        foreach ($variables['comentarios'] as $c) {
            $autor = $c->usuario->nick;
            echo "<div class='fila'>
                        <h3>" . $c->titulo . "<small> [ " . $autor . " - " . date("d/m/Y", strtotime($c->fecha) ) . " ] </small></h3>
                            <p>" . $c->texto . "</p>
                  </div>";
        }
        ?>
    </div>
</div>

<script>

    $(document).on("ready", function() {
        $("#eliminar").on("click", function() {
            var r = confirm("¿Está seguro?");
            if (r == true) {
                window.location = "../servicios/adminHandler.php?action=removeGrupo&id=<?php echo $variables['grupo']->id; ?>";
            }
        });
        
        $("#mensaje").on("click", function() {
            window.location = "../servicios/adminHandler.php?action=sendToAdmin&id=<?php echo $variables['grupo']->id; ?>";
        });
    });

</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
