<?php
/* Iniciamos sesion con usuario id */


/* DIR... LA RUTA absoluta dsde donde  se llama .. donde esta el archivo */
require __DIR__ . "/../controladores/ControladorUsuario.php";

/* Creamos el controlaor */
$controlador = new ControladorUsuario();

/* Metodo de controladro que nos devuelva las varialbes que necesitamos
  vamos a controlador a rea el metodo */

//Llamamos al metodo que contiene la funcionalidad(variables cde la vista)
//Con todos los contactos
$variables = $controlador->misContactos();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-user"></span> Mis contactos
    </h2>
    <hr>
    <div>
        <!-- Linea de botones-->
        <p>
            <a href="mis-contactos" class="boton boton-activo"><span class="fa fa-users"></span> Todos</a>
            <a href="mis-contactos-reco.php" class="boton"><span class="fa fa-star"></span> Recomendados</a>
        </p>
        <!-- Form para la busqueda de contactos-->
        <form action="mis-contactos.php" method="post">
            <input type="text" class="campo-formulario" placeholder="Buscar Contacto...">
            <input type="submit" class="campo-formulario" value="Buscar">
        </form>
    </div>
    <hr>
    <!--
    1.Controlador.
    2. Obtenido el contenido en variables 
    recorremos el array 
    -->
    <?php
    if (count($variables["contactosUsuario"]) > 0):
        foreach ($variables["contactosUsuario"] as $contacto):
            ?>
            <div class="col-6">
                <div class="fila">
                    <div class="col-5"><p><img src="../img/usuarios/perfil/<?php echo $contacto->avatar ?>" class="img-responsive"/></p></div>
                    <div class="col-7">
                        <p>
                            <strong><?php echo $contacto->nombre ?></strong> 
                            <small><a href="perfil-usuario.php" class="color-green">@<?php echo $contacto->nick ?></a></small>
                        </p>
                        <blockquote>
                            <p>
                                <?php echo $contacto->estado ?>
                            </p>
                        </blockquote>
                        <p>
                            <span class="distintivo">
                                <?php
                                /* Tabla que referencia a la tabla del propio contacto(dame todos los alice->veo donde alice
                                  es id */
                                echo count($contacto->alias('alice')->ownContactoList)+count($contacto->alias('bob')->ownContactoList);
                                ?>

                            </span> Amigos<br><br>
                            <a href="mis-mensajes.php" class="boton">Enviar mensaje</a>
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php
        endforeach;
    else:
        echo "No tienes ningun contacto";
    endif;
    ?>


</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
