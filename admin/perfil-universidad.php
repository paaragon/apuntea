<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->universidad();

ob_start();
?>
<div id="principal" class="col-9">
    <?php if (isset($variables["universidad"])): ?>
        <div class="fila profile">
            <div id="fondo"><img class="img-responsive" src="../img/universidades/portada/<?php echo $variables["universidad"]->imagenportada ?>"></div>
            <div id="avatar"><img src="../img/universidades/perfil/<?php echo $variables["universidad"]->imagenperfil ?>" class="img-responsive"></div>
            <ul id="actividad">
                <li id="actividad-1">
                    <span> <?php echo $variables["numCarreras"] ?></span>
                    <small>Carreras</small>
                </li>
                <li id="actividad-2">
                    <span> <?php echo $variables["numAsign"] ?></span>
                    <small>Asignaturas</small>
                </li>
                <li id="actividad-3">
                    <span> <?php echo $variables["numAlumnos"] ?></span>
                    <small>Alumnos</small>
                </li>
            </ul>
            <div class ="clear"></div><br>
            <div class="description">
                <h2 class="col-6"><?php echo $variables["universidad"]->nombre ?></h2>
                <p class="col-6">
                    <a href="editar-universidad.php?id=<?php echo $variables["universidad"]->id ?>" class="boton">Editar universidad</a>
                    <a href="../servicios/adminHandler.php?action=borrarUniversidad&idUniversidad=<?php echo $variables["universidad"]->id ?>" class="boton">Eliminar universidad</a>
                </p>
                <div class="clear"></div>
                <hr>
                <div class="col-7">
                    <h2><span class="fa fa-users"></span> Alumnos</h2>
                    <hr>   
                    <?php
                    if ($variables["numAlumnos"] != 0) {
                        foreach ($variables["usuarios"] as $usuarios) {
                            ?>
                            <div class="fila">
                                <div class="col-3"><p><img src="../img/usuarios/perfil/<?php echo $usuarios->avatar ?>" class="img-responsive"/></p></div>
                                <div class="col-9">
                                    <p>
                                        <strong><?php echo $usuarios->nombre ?></strong>
                                        <small><a href="usuarios-detalles.php?id=<?php echo $usuarios->id ?>" class="color-green">@<?php echo $usuarios->nick ?></a></small>
                                    </p>
                                    <blockquote>
                                        <p>
                                            <?php echo $usuarios->estado ?>
                                        </p>
                                    </blockquote>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                    } else
                        echo "No hay alumnos que pertenezcan a esta universidad";
                    ?>
                </div>
                <!--Principal actividades dentro del perfil-->
                <div class=" col-5">
                    <h2><span class="fa fa-cogs"></span> Actividades</h2>
                    <hr>
                    <?php
                    foreach ($variables["usuariosNuevos"] as $nuevoUsuario) :
                        ?>  
                        <div class="fila">
                            <p>
                                <span class="col-10">
                                    <span class="fa fa-users"></span>
                                    <strong><a href="usuarios-detalles.php?id=<?php echo $nuevoUsuario->id ?>'>"><?php echo $nuevoUsuario->nick ?></a> se ha añadido como alumno</strong>
                                </span>
                                <span class="col-2"><span class="fa fa-eye"></span> 999</span>
                            </p>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach;
                    ?> 
                    <?php
                    foreach ($variables["apuntesNuevos"] as $nuevoApunte) :
                        $userApunte = R::findOne("usuario", "id= ?", [$nuevoApunte->usuario_id]);
                        ?>     
                        <div class="fila">
                            <p>
                                <span class="col-10">
                                    <span class="fa fa-user-plus"></span>
                                    <strong><em><a href="perfil-usuario.php?id=<?php echo $userApunte->id ?>">@<?php echo $userApunte->nick ?></a></em> ha añadido un nuevo apunte <em><a href="ver-apunte.php?id=<?php echo $nuevoApunte->id ?>"><?php echo $nuevoApunte->titulo ?></a></em></strong>
                                </span>  
                            </p>
                            <div class="clear"></div>
                        </div>
                    <?php endforeach;
                    ?>
                </div>
                <div class="clear"></div>
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
        </div>
    <?php else: ?>
        <blockquote><h3>Universidad no encontrada.</h3></blockquote>
    <?php endif; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
