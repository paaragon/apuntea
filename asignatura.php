<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->getAsignatura();

ob_start();
?>

<div class="col-9">
    <section>
        <h1><span class="fa fa-file-text-o"></span
            
            
           
            <small> <?php echo $variables["asignatura"]->nombre ?> -  <?php echo $variables["asignatura"]->curso ?> ª Curso - <a href="perfil-universidad.php"> <?php echo $variables["asignatura"]->carrera->universidad->nombre ?>
            </a> / <a href="perfil-universidad.php"> <?php echo $variables["asignatura"]->carrera->nombre?>]</a></small></h1>
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
            echo "No hay apuntes que pertenezcan a esta universidad";
        ?>
    </div>
</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>

<div class="clear"></div>


<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
