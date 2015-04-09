<?php ob_start(); ?>
<html>
    <head>
        <title>Perfil</title>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="perfilEstilo.css" rel="stylesheet" type="text/css" /> 
    </head>
    <body>
        <div class="col-9 " id="principal">
            <!--Div principal--->

            <div class="profile col-12">
                <!--Div para el fondo del perfil-->
                <div class="fondo "><img src="fondo.jpg"/></div>
                <!--Div para el avatar del perfil-->
                <div class="avatar"><img src="avatar.jpg"/></div>
                <!--Eventos relacionados con el perfil-->
                <!--AÑADIR AL CSS PARA QUE ENVIE LOS ELEMENTOS DE LA LISTA A LA DERECHA-->
                <ul class="social">

                    <li class="posts">
                        <h2>388</h2>
                        <hr>
                        <small>posts</small>
                    </li>
                    <li class="comments">
                        <h2>38</h2>
                        <hr>
                        <small>comments</small>
                    </li>
                    <li class="files">
                        <h2>38</h2>
                        <hr>
                        <small>files</small>
                    </li>
                </ul>
                <div class ="clear"> </div>
                <!--Contiene los elementos principales del perfil social-->
                <div class="description">

                    <h3>MI PERFIL </h3>
                    <hr>
                    <p> Aqui se puede contar estados... etc!
                    </p>
                    <div class ="clear"> </div>
                    <!--Principal social dentro del pefil-->
                    <div class =" col-7 fila ">
                        <h2><i class="fa fa-child"></i> Social</h2>
                        <hr>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-smile-o"></span>
                                    <strong>Actividad social
                                        reciente hace unos momentos                                  
                                     </strong>
                                    
                                </span>
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span> 
                                <!--AÑADIR AL CSS PARA ALINEARO MAS A LA DERECHA Y SE VEA COMO SI FUERA REAL-->
                                <small>0 days ago</small>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-smile-o"></span>
                                    <strong>Actividad social
                                        reciente hace unos dias                                
                                     </strong>
                                </span>
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                                <small>0 days ago</small>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-smile-o"></span>
                                    <strong>Actividad social
                                        reciente hace unos semanas                                
                                     </strong>
                                </span>
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                                <small>0 days ago</small>
                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-smile-o"></span>
                                    <strong>Actividad social
                                        reciente hace unos meses                                
                                     </strong>
                                </span>
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span>
                                <small>0 days ago</small>
                            </p>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <!--Principal actividades dentro del perfil-->
                    <div class =" col-5 fila " >
                        <h2><i class="fa fa-cogs"></i> Actividades</h2>
                        <hr>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-file-text-o"></span>
                                    <strong><a href="ver-apunte-propio.php">Publicacion de apuntes</a></strong>
                                </span>
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                            </p>
                            <div class="clear"></div>
                        </div>
                        <div class="fila">
                            <p>
                                <span class="col-11">
                                    <span class="fa fa-users"></span>
                                    <strong><a href="mis-contactos.php">Se ha hecho amigo de Pepito </a></strong>
                                </span
                                <span class="col-1"><span class="fa fa-eye"></span> 999</span>

                            </p>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

    </body>
</html>


<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
