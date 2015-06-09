<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->universidades();

ob_start();
?>
<section>
    <h1>Universidades</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Universidades</li>
</ul>
<hr>
<section>
    <?php if (count($variables["universidades"]) > 0): ?>
        <?php foreach ($variables["universidades"] as $uni): ?>
            <div class="teaser">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-1">
                            <p>
                                <img src="img/universidades/<?php echo ($uni->imagenperfil != NULL) ? $uni->imagenperfil : "university.png" ?>" class="imagen-responsive">
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
    <?php else: ?>
        <blockquote><h3>No hay universidades.</h3></blockquote>
    <?php endif; ?>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
