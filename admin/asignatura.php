<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->asignatura();

ob_start();
?>
<?php if (isset($variables["asignatura"])): ?>
    <div class="col-12">
        <section>
            <h2><span class="fa fa-file-text-o"></span>
                <?php echo $variables["asignatura"]->nombre ?> -  <small><?php echo $variables["asignatura"]->curso ?> ª Curso - <a href="perfil-universidad.php?id=<?php echo $variables["asignatura"]->carrera->universidad->id ?>"> <?php echo $variables["asignatura"]->carrera->universidad->siglas ?>
                    </a> / <a href="perfil-carrera.php?id=<?php echo $variables["asignatura"]->carrera->id ?>"> <?php echo $variables["asignatura"]->carrera->nombre ?></a></small></h2>
        </section>
        <hr>
        <p>
            <a href="editar-asignatura.php?id=<?php echo $variables["asignatura"]->id ?>" class="boton">Editar asignatura</a>
            <a href="../servicios/adminHandler.php?action=borrarAsignatura&idAsignatura=<?php echo $variables["asignatura"]->id ?>" class="boton">Eliminar asignatura</a>
        </p>
        <div>
            <h3><span class="fa fa-file-text-o"></span> Apuntes:</h3>

            <?php
            if (count($variables["apuntes"]) > 0) {
                foreach ($variables["apuntes"] as $apunte) {
                    ?>
                    <div class="fila">
                        <p>
                            <span class="col-6">
                                <span class="fa fa-file-text-o"></span>
                                <a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><?php echo $apunte->titulo ?></a>
                            </span>

                            <span class="col-2"><span class="fa fa-thumbs-o-up"></span> <?php echo $apunte->likes ?></span>
                            <span class="col-2"><span class="fa fa-thumbs-o-down"></span> <?php echo $apunte->dislikes ?></span>
                            <span class="col-2"><span class="fa fa-eye"></span> <?php echo $apunte->visualizaciones ?></span>
                        </p>
                        <div class="clear"></div>

                    </div>
                    <?php
                }
            } else
                echo "<blockquote>No hay apuntes que pertenezcan a esta asignatura</blockquote>";
            ?>
        </div>
    </div>
<?php else: ?>
    <blockquote class="col-9"><h3>Asignatura no encontrada.</h3></blockquote>
<?php endif; ?>
<div class="clear"></div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
