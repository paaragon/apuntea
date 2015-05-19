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
        
        <?php 
        foreach ($variables["apuntes"] as $apunte) { ?>
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
                <span class="col-1"><span class="fa fa-star" id="f<?php echo $apunte['id']?>"></span></span>
                <!-- <span class="col-1"><span class="fa fa-star apunte-favorito" id="f<?php echo $apunte['id']   ?>"></span></span>
                -->
                <span class="col-1"><span class="fa fa-trash-o"></span></span>
            </p>
            <div class="clear"></div>
        </div>
        
        <?php } ?>
       
    </div>
</div>


<script>
$('.fa-star').on("click", function(){
    
    id = $(this).attr("id").substring(1);
    $.post('../servicios/usuarioHandler.php?action=favorito', {id:id}, function(){
        $(this).addClass('apunte-favorito');
    });
});
</script>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
