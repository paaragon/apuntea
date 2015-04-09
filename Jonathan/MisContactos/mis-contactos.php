<?php ob_start(); ?>

<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Hoja de estilos-->
    <link href="listaEstilos.css" rel="stylesheet" type="text/css" /> 
</head>
<body>

    <div class="col-9" id="principal">
        <h2>
            <i class="fa fa-users"></i> Mis Contatos
        </h2>
        <hr>
        <div>
            <!-- Linea de botones-->
            <p>
                <a href="#" class="boton boton-activo"><span class="fa fa-users"></span> Todos</a>
                <a href="mis-contactos-reco.php" class="boton"><span class="fa fa-star"></span> Recomendados</a>
                
            </p>
            <!-- Form para la busqueda de contactos-->
            <form>
            <div class="form-group ">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar Contacto...">
                    <div class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></div>
                </div>
            </div>
        </form>
        </div>
        <hr>
        
        <!--Division principal de la lista de amigos-->
        <!--HE INTENTADO HACERLO COMO EN FACEBOOK
        QUE TE APARECE 2 DIV POR FILA EN EL CSS LO INTENTE 
        HACER PERO NO ME SALIA! INTENTAR PONERLO-->
        <div class="p_bar">
            <div class="fila col-6">
                <!-- Se añade fila para que tenga mejor aspecto-->
                <div class="profile fila ">
                    <div class="picture "><img src="avatar.jpg" /></div>

                    <div class="description">
                        <p class="name">Cholo 1</p>
                        <a href="perfil-usuario.php" class="color-green">@cho1_</a>
                        <button class="green border-green">Mensaje</button>
                        <p class="pretext">Hola Mundo
                        </p>
                        <p class="amigos">1245 Amigos</p>
                    </div>

                </div>
            </div>
            <div class="fila col-6 ">
                <div class="profile fila">
                    <div class="picture"><img src="avatar.jpg" /></div>

                    <div class="description">
                        <p class="name">Cholo 1</p>
                        <a href="perfil-usuario.php" class="color-green">@cho1_</a>
                        <button class="green border-green">Mensaje</button>
                        <p class="pretext">Adios Mundo!
                        </p>
                        <p class="amigos">450 Amigos</p>
                    </div>

                </div>
            </div>

            <div class="fila col-6 ">
                <div class="profile fila">
                    <div class="picture "><img src="avatar.jpg" /></div>

                    <div class="description">
                        <p class="name">Cholo 1</p>
                        <a href="perfil-usuario.php" class="color-green">@cho1_</a>
                        <button class="green border-green">Mensaje</button>
                        <p class="pretext">Vamos vamos </p>
                        <p class="amigos">15 Amigos</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>





<div class="col-3">
    <?php require "inicio/busqueda-contactos.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
