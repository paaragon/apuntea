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
        <?php
           $variables = $controlador->nuevosContactos();
            foreach ($variables["nuevosContactos"] as $contacto):
                ?>
                <div class="fila">
                    <p>
                    <span class="col-10">
                        <span class="fa fa-users"></span>
                        <strong><em><a href="perfil-usuario.php?id=<?php $contacto->id?>">@<?php echo $contacto->nick ?></a></em> se ha añadido a tu lista de amigos</strong>
                    </span>
                </p>
                <div class="clear"></div>
                </div>
                <?php
            endforeach;
            /*
            $variables1 = $controlador->nuevosContactosGrupo();
            foreach ($variables1["nuevosContactosGrupo"] as $resultado):
                ?>
                <div class="fila">
                    <p>
                    <span class="col-10">
                        <span class="fa fa-users"></span>
                        <strong><em><a href="perfil-usuario.php?id=<?php $resultado->id?>">@<?php echo $resultado->nick ?></a></em> se ha añadido a tu grupo de amigos...</strong>
                    </span>
                </p>
                <div class="clear"></div>
                </div>
                <?php
            endforeach;*/
     
        ?>
        
        <div class="fila">
            <p>
                <span class="col-10">
                    <span class="fa fa-plus-square"></span>
                    <strong> <em>MrSlide22</em> ha añadido el archivo <em> Tema 3</em></strong>
                </span>
                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-10">
                    <span class="fa fa-file-text-o"></span>
                    <strong> <em> Kherdu </em> forma parte del grupo <em> Apuntes Aplicaciones Web</em></strong>
                </span>
                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-10">
                    <span class="fa fa-user-plus"></span>
                    <strong> <em> McMachote </em> te ha incluido en el grupo <em> Proyecto AW</em></strong>
                </span>
                <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
                <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            </p>
            <div class="clear"></div>
        </div>

    </div>
</div>
<div class="col-3">
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
