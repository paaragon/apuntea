<?php
require "../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();
$variables = $controlador->universidades();

ob_start();
?>
<h1>Universidades</h1>
<hr>
<section>
    <?php foreach ($variables["universidades"] as $uni): ?>
        <div class="teaser">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-1">
                        <p>
                            <img src="../img/universidades/<?php echo ($uni->imagenperfil != NULL) ? $uni->imagenperfil : "university.png" ?>" class="imagen-responsive">
                        </p>
                    </div>
                    <div class="col-7">
                        <h3><?php echo $uni->nombre ?></h3>
                    </div>
                    <p class="col-3 go-icon">
                        <span class="teaser-icon"><a href="universidad.php?id=<?php echo $uni->id ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
