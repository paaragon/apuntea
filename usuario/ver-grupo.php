<?php

require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->grupo();

ob_start();
?>

<div id="principal">
    <h2>
        <span class="fa fa-group"></span>
		<?php echo $variables["grupo"]->nombre ?>
    </h2>
    <hr>
    <h3>Miembros</h3>
    <div id="conversaciones-recientes">
        <div>
		<?php
        if (isset($variables["usuarios"])){
            foreach ($variables["usuarios"] as $user){
                ?>
            <div class="picture fila">
                <p>
                    <img src="../img/no-user.jpg" class="profile-img">
                </p>
                <h4><a href="perfil-usuario.php"><?php echo $user->usuario->nombre ?></a></h4>
            </div>
		<?php
			}
		}else echo "No hay usuarios en este grupo";
		?>

        </div>
    </div>
    <div class="clear"></div>

    <div>
        <h3>
            <br>Aportaciones
        </h3>
        <div>
		<?php
        if ($variables["apuntes"] > 0){
            foreach ($variables["apuntes"] as $apunte){
                ?>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-file-text-o"></span>
                        <strong><a href="ver-apunte.php"><?php echo $apunte->titulo ?></a></strong>
                    </span>

                    <span class="col-1"><span class="fa fa-thumbs-o-up"></span> <?php echo $apunte["likes"] ?></span>
                    <span class="col-1"><span class="fa fa-thumbs-o-down"></span> <?php echo $apunte->dislikes ?></span>
                    <span class="col-1"><span class="fa fa-eye"></span> <?php echo $apunte->visualizaciones ?></span>
                    <span class="col-1"><span class="fa fa-star"></span></span>
                </p>
                <div class="clear"></div>
            </div>
					<?php
			}
		}else echo "No hay aportaciones a este grupo";
		?>
        </div>
    </div>
    <div id="comentarios-apuntes">

        <div class="fila">
            <form action="../servicios/usuarioHandler.php?action=anadirComentarioGrupo&idGrupo=<?php echo $variables["grupo"]->id ?>" method="post">
                <h3><span class="fa fa-comment"></span> Añadir comentario</h3>
                <textarea class="campo-formulario" name="comentario"></textarea>
                <input type="submit" class="campo-formulario" value="añadir comentario">
            </form>
        </div>
        <div class="fila">
		<?php
        if (isset($variables["comentarios"])){
            foreach ($variables["comentarios"] as $comentario){
        ?>
            <h3><?php echo $comentario->usuario->nombre ?>   <small><?php echo $comentario->fecha ?></small></h3>
            <p>
				<?php echo $comentario->texto ?>
			</p>
        </div>
		<?php
			}
		}else echo "No hay comentarios en este grupo";
		?>
    </div>  
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
