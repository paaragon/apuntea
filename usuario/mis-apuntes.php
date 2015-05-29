<?php
require "../controladores/ControladorUsuario.php";
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

        <?php foreach ($variables["apuntes"] as $apunte) { ?>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte-propio.php?id=<?php echo $apunte->id ?>"><?php echo $apunte["titulo"] ?> </a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> <?php echo $apunte["likes"] ?></span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> <?php echo $apunte["dislikes"] ?></span>
                    <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte["visualizaciones"] ?></span>
                    <!--poner la clase en funcion de si es favorito o no   -->
                    <span class="col-1"><span id="f<?php echo $apunte->id; ?>"  class="fa fa-star 
                                              <?php if (isset($apunte->usuariointeractuaapunte->favorito) == 1) echo "apunte-favorito" ?>"></span></span>

                    <span class="col-1"><span id="f<?php echo $apunte->id; ?>"  class="fa fa-trash-o"></span></span>
                </p>
                <div class="clear"></div>
            </div>

        <?php } ?>

    </div>
</div>


<script>

    $(document).ready(function () {
        $('.fa-star').on("click", function () {

            star = $(this);
            id = $(this).attr("id").substring(1);

            $.post('../servicios/usuarioHandler.php?action=favorito', {id: id}, function (data) {

                if (data == 1) {

                    star.addClass('apunte-favorito');
                } else if (data == 0) {

                    star.removeClass('apunte-favorito');
                }
            });
        });


        $('.fa-trash-o').on("click", function () {

            id = $(this).attr("id").substring(1);  
            
            var r = confirm("Seguro que quieres borrar un apunte?");
            if (r == true) {
               
                $.post('../servicios/usuarioHandler.php?action=borrarapunte', {id: id}, function (data) {
                    alert(data);
                });
            }
        });
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
