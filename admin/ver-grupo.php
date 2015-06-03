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
                          <h4><a href='usuarios-detalles.php?id=" . $m->id . "'>" . $m->nick . "</a></h4>
                          </div>";
                }
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>

    <div>
        <h3>Aportaciones</h3>
        <div>
            <?php foreach ($variables["aportaciones"] as $ap): ?>
                <div class="fila">
                    <p>
                        <span class="col-9">
                            <span class="fa fa-file-text-o"></span>
                            <strong><a href="ver-apunte.php?id=<?php echo $ap->id ?>"><?php echo $ap->titulo ?></a></strong>
                        </span>
                        <span class="col-1"><span class="fa fa-thumbs-o-up"></span> <?php echo $ap->likes ?></span>
                        <span class="col-1"><span class="fa fa-thumbs-o-down"></span> <?php echo $ap->dislikes ?></span>
                        <span class="col-1"><span class="fa fa-eye"></span> <?php echo $ap->visualizaciones ?></span>

                    </p>
                    <div class="clear"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="comentarios-apuntes">
        <h3>
            <br>Comentarios
        </h3>
        <?php
        foreach ($variables['comentarios'] as $c) {
            $autor = $c->usuario->nick;
            echo "<div class='fila'>
                        <h3>" . $c->titulo . "<small> [ " . $autor . " - " . date("d/m/Y", strtotime($c->fecha)) . " ] </small></h3>
                            <p>" . $c->texto . "</p>
                  </div>";
        }
        ?>
    </div>
</div>

<script>

    $(document).on("ready", function () {
        $("#eliminar").on("click", function () {
            var r = confirm("¿Está seguro?");
            if (r == true) {
                window.location = "../servicios/adminHandler.php?action=removeGrupo&id=<?php echo $variables['grupo']->id; ?>";
            }
        });

        $("#mensaje").on("click", function () {
            window.location = "../servicios/adminHandler.php?action=sendToAdmin&id=<?php echo $variables['grupo']->id; ?>";
        });
    });

</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
