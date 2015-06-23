<div>
    <div id="user-info">
        <p id="img-perfil-user"><img src="../img/usuarios/perfil/<?php echo $variables["usuario-actual"]->avatar ?>"></p>
        <h3><a href="perfil-usuario.php?id=<?php echo $variables["usuario-actual"]->id ?>"><?php echo $variables["usuario-actual"]->nombre . " " . $variables["usuario-actual"]->apellidos ?></a></h3>
    </div>
    <ul>
        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/inicio.php' || $_SERVER["REQUEST_URI"] == '/usuario/inicio.php'): ?>
            <li><a href="inicio.php" class="activo"><span class="fa fa-newspaper-o"></span> Novedades</a></li>
        <?php else: ?>
            <li><a href="inicio.php"><span class="fa fa-newspaper-o"></span> Novedades</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/mis-apuntes.php' || $_SERVER["REQUEST_URI"] == '/usuario/mis-apuntes.php'): ?>
            <li><a href="mis-apuntes.php" class="activo"><span class="fa fa-file-text"></span> Mis apuntes</a></li>
        <?php else: ?>
            <li><a href="mis-apuntes.php"><span class="fa fa-file-text"></span> Mis apuntes</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/mis-grupos.php' || $_SERVER["REQUEST_URI"] == '/usuario/mis-grupos.php'): ?>
            <li><a href="mis-grupos.php" class="activo"><span class="fa fa-users"></span> Mis grupos</a></li>
        <?php else: ?>
            <li><a href="mis-grupos.php"><span class="fa fa-users"></span> Mis grupos</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/mis-contactos.php' || $_SERVER["REQUEST_URI"] == '/usuario/mis-contactos.php'): ?>
            <li><a href="mis-contactos.php" class="activo"><span class="fa fa-user"></span> Mis contactos</a></li>
        <?php else: ?>
            <li><a href="mis-contactos.php"><span class="fa fa-user"></span> Mis contactos</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/mis-mensajes.php' || $_SERVER["REQUEST_URI"] == '/usuario/mis-mensajes.php'): ?>
            <li>
                <a href="mis-mensajes.php" class="activo">
                    <span class="fa fa-envelope"></span> Mensajes
                    <?php if ($variables["n-mensajes"] > 0): ?>
                        <span class="badge"><span class="fa fa-envelope-o"></span> <?php echo $variables["n-mensajes"] ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="mis-mensajes.php">
                    <span class="fa fa-envelope"></span> Mensajes
                    <?php if ($variables["n-mensajes"] > 0): ?>
                        <span class="badge"><span class="fa fa-envelope-o"></span> <?php echo $variables["n-mensajes"] ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/universidades.php' || $_SERVER["REQUEST_URI"] == '/usuario/universidades.php'): ?>
            <li><a href="universidades.php" class="activo"><span class="fa fa-folder"></span> Archivo</a></li>
        <?php else: ?>
            <li><a href="universidades.php"><span class="fa fa-folder"></span> Archivo</a></li>
        <?php endif; ?>
            
        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/usuario/mi-configuracion.php' || $_SERVER["REQUEST_URI"] == '/usuario/mi-configuracion.php'): ?>
            <li><a href="mi-configuracion.php" class="activo"><span class="fa fa-cog"></span> Configuración</a></li>
        <?php else: ?>
            <li><a href="mi-configuracion.php"><span class="fa fa-cog"></span> Configuración</a></li>
        <?php endif; ?>
    </ul>
</div>