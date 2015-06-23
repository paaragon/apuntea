<?php
require __DIR__ . "/../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-newspaper-o"></span> Novedades
    </h2>
    <hr>
    <div>
        <!-- NUEVOS AMIGOS -->
        <?php foreach ($variables["nuevosAmigos"] as $amigo): ?>
            <div class="fila">
                <p>
                    <span class="col-10">
                        <span class="fa fa-users"></span>
                        <strong><em><a href="perfil-usuario.php?id=<?php echo $amigo->id ?> ">@<?php echo $amigo->nick ?></a></em> se ha añadido a tu lista de amigos</strong>
                    </span>
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <!-- NUEVOS CONTACTOS EN TUS GRUPOS -->
        <?php
        foreach ($variables["nuevosContactosGrupo"] as $contacto):
            $grupo = R::findOne("grupo", "id = ?", [$contacto->grupo_id]);
            ?>
            <div class="fila">
                <p>
                    <span class="col-10">
                        <span class="fa fa-users"></span>
                        <strong><em><a href="perfil-usuario.php?id=<?php echo $contacto->usuario->id ?>">@<?php echo $contacto->usuario->nick ?></a></em> se ha añadido a tu grupo <a href="ver-grupo.php?id=<?php echo $grupo->id ?>"><?php echo $grupo->nombre ?></a></strong>
                    </span>
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <!-- NUEVOS APUNTES SUBIDOS POR TUS AMIGOS -->
        <?php
        foreach ($variables["nuevosApuntes"] as $nuevoApunte) :
            $amigoApunte = R::findOne("usuario", "id = ?", [$nuevoApunte->usuario_id]);
            ?>     
            <div class="fila">
                <p>
                    <span class="col-10">
                        <span class="fa fa-user-plus"></span>
                        <strong><em><a href="perfil-usuario.php?id=<?php echo $amigoApunte->id ?>">@<?php echo $amigoApunte->nick ?></a></em> ha añadido un nuevo apunte <em><a href="ver-apunte.php?id=<?php echo $nuevoApunte->id ?>"><?php echo $nuevoApunte->titulo ?></a></em></strong>
                    </span>  
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <?php if ($variables["nuevosAmigos"] == null) echo "<blockquote><h3>No tienes actividad reciente</h3></blockquote>" ?>

    </div>
</div>
<div class="col-3">
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
