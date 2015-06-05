<?php
require "../controladores/ControladorUsuario.php";
require "../util/Like.php";
require "../util/Dislike.php";
require "../util/Fav.php";
$controlador = new ControladorUsuario();

$variables = $controlador->misApuntes();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-file-text-o"></span> Mis apuntes
    </h2>
    <hr>
    <div>
        <p>

            <a href="mis-apuntes.php" class="boton boton-activo"><span class="fa fa-cloud-upload"></span> Subidos</a>
            <a href="mis-favoritos.php" class="boton"><span class="fa fa-star"></span> Favoritos</a>
        </p>
    </div>
    <div>
        <?php if (count($variables["apuntes"]) > 0): ?>
            <?php foreach ($variables["apuntes"] as $apunte) { ?>
                <div class="fila">
                    <p>
                        <span class="col-7">
                            <span class="fa fa-file-text-o"></span>
                            <strong><a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><?php echo $apunte["titulo"] ?> </a></strong>
                        </span>
                        <?php
                        $like = new Like($apunte);
                        $dislike = new Dislike($apunte);
                        $fav = new Fav($apunte);
                        ?>
                        <span class="col-1"><?php echo $like->generateLike(); ?></span>
                        <span class="col-1"><?php echo $dislike->generateDislike(); ?></span>
                        <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte["visualizaciones"] ?></span>
                        <!--poner la clase en funcion de si es favorito o no   -->
                        <span class="col-1"><?php echo $fav->generateFav(); ?></span>

                        <span class="col-1"><span id="f<?php echo $apunte->id; ?>" class="fa fa-trash-o"></span></span>
                    </p>
                    <div class="clear"></div>
                </div>

            <?php } ?>
        <?php else: ?>
            <blockquote><h4>No has subido ningún apunte.</h4></blockquote>
        <?php endif; ?>
    </div>
</div>


<script>

    $(document).ready(function () {
<?php if (count($variables["apuntes"]) > 0): ?>
    <?php echo $like->generateAjaxScript(); ?>
    <?php echo $dislike->generateAjaxScript(); ?>
    <?php echo $fav->generateAjaxScript(); ?>
<?php endif; ?>


        $('.fa-trash-o').on("click", function () {

            ap = $(this);
            id = ap.attr("id").substring(1);

            var r = confirm("Seguro que quieres borrar un apunte?");
            if (r == true) {
                $.post('../servicios/usuarioHandler.php?action=borrarapunte', {id: id}, function (data) {
                    ap.closest(".fila").remove();
                });
            }
        });
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
