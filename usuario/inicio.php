<?php

/*Empexamos session*/
session_start();
$_SESSION["idUsuario"] = 1;

require __DIR__ . "/../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

//Nuevos amigos
//Nuevos amigos en grupos
//Modificaciones de archivos
//Nuevas subidas de amigos
//nuevas subidas de archivos a tus grupos
//Has sido añadido
//$variables = $controlador->inicio();


ob_start(); ?>
<div id="principal">
    <h2>
        <span class="fa fa-newspaper-o"></span> Novedades
    </h2>
    <hr>
    <div>
        <!-- NUEVOS AMIGOS -->
        <?php 
            $novedades = $controlador->inicio();
            foreach ($novedades["nuevosAmigos"] as $amigo):
        ?>
                <div class="fila">
                    <p>
                        <span class="col-10">
                            <span class="fa fa-users"></span>
                            <strong><em><a href="perfil-usuario.php?id=<?php $amigo->id?>">@<?php echo $amigo->nick ?></a></em> se ha añadido a tu lista de amigos</strong>
                        </span>
                    </p>
                <div class="clear"></div>
                </div>
        <?php endforeach; ?>
        
        <!-- NUEVOS CONTACTOS EN TUS GRUPOS -->
        <?php
            foreach ($novedades["nuevosContactosGrupo"] as $contacto):
        ?>
                <div class="fila">
                    <p>
                        <span class="col-10">
                            <span class="fa fa-users"></span>
                            <strong><em><a href="perfil-usuario.php?id=<?php $contacto->id?>">@<?php echo $contacto->nick ?></a></em> se ha añadido a tu grupo " ... "</strong>
                        </span>
                    </p>
                    <div class="clear"></div>
                </div>
        <?php endforeach; ?>
        
        <!-- NUEVOS APUNTES SUBIDOS POR TUS AMIGOS -->
        <?php 
             foreach($novedades["nuevosApuntes"] as $nuevoApunte) :
                 $amigoApunte = R::findOne("usuario", "id = ?", [$nuevoApunte->usuario_id]);
          ?>     
                <div class="fila">
                   <p>
                       <span class="col-10">
                           <span class="fa fa-user-plus"></span>
                           <strong><em><a href="perfil-usuario.php?id=<?php $amigoApunte->id?>">@<?php echo $amigoApunte->nick ?></a></em> ha añadido un nuevo apunte <em><a href="ver-apunte.php?id=<?php$nuevoApunte->id?>"><?php echo $nuevoApunte->titulo ?></a></em></strong>
                       </span>  
                       <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                       <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
                   </p>
                   <div class="clear"></div>
               </div>
        <?php endforeach;?>
    </div>
</div>
<div class="col-3">
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
