<div>
    <div id="user-info">
        <p><img src="../img/usuarios/perfil/<?php echo $variables["usuario-actual"]->avatar ?>" id="img-perfil-user"></p>
        <h3><a href="perfil-usuario.php?id=<?php echo $variables["usuario-actual"]->id ?>"><?php echo $variables["usuario-actual"]->nombre . " " . $variables["usuario-actual"]->apellidos ?></a></h3>
    </div>
    <ul>
        <li><a href="inicio.php"><span class="fa fa-newspaper-o"></span> Novedades</a></li>
        <li><a href="mis-apuntes.php"><span class="fa fa-file-text"></span> Mis apuntes</a></li>
        <li><a href="mis-grupos.php"><span class="fa fa-users"></span> Mis grupos</a></li>
        <li><a href="mis-contactos.php"><span class="fa fa-user"></span> Mis contactos</a></li>
        <li><a href="mis-mensajes.php"><span class="fa fa-envelope"></span> Mensajes</a></li>
        <li><a href="mi-configuracion.php"><span class="fa fa-cog"></span> Configuración</a></li>
    </ul>
</div>