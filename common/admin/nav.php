<div>
    <div id="user-info">
        <h3>Administrador Apuntea</h3>
        <p>
            <strong><?php echo $variables["usuario-actual"]->nombre . " " . $variables["usuario-actual"]->apellidos ?></strong><br>
            <small><a href="editar-admin.php">Editar datos de usuario</a></small>
        </p>
    </div>
    <ul>
        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/inicio.php' || $_SERVER["REQUEST_URI"] == '/admin/inicio.php'): ?>
            <li><a href="inicio.php" class="activo"><span class="fa fa-home"></span> Inicio</a></li>
        <?php else: ?>
            <li><a href="inicio.php"><span class="fa fa-home"></span> Inicio</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/usuarios.php' || $_SERVER["REQUEST_URI"] == '/admin/usuarios.php'): ?>
            <li><a href="usuarios.php" class="activo"><span class="fa fa-users"></span> Usuarios</a></li>
        <?php else: ?>
            <li><a href="usuarios.php"><span class="fa fa-users"></span> Usuarios</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/administradores.php' || $_SERVER["REQUEST_URI"] == '/admin/administradores.php'): ?>
            <li><a href="administradores.php" class="activo"><span class="fa fa-empire"></span> Administradores</a></li>
        <?php else: ?>
            <li><a href="administradores.php"><span class="fa fa-empire"></span> Administradores</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/grupos.php' || $_SERVER["REQUEST_URI"] == '/admin/grupos.php'): ?>
            <li><a href="grupos.php" class="activo"><span class="fa fa-circle-o-notch"></span> Grupos</a></li>
        <?php else: ?>
            <li><a href="grupos.php"><span class="fa fa-circle-o-notch"></span> Grupos</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/universidades.php' || $_SERVER["REQUEST_URI"] == '/admin/universidades.php'): ?>
            <li><a href="universidades.php" class="activo"><span class="fa fa-university"></span> Universidades</a></li>
        <?php else: ?>
            <li><a href="universidades.php"><span class="fa fa-university"></span> Universidades</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/carreras.php' || $_SERVER["REQUEST_URI"] == '/admin/carreras.php'): ?>
            <li><a href="carreras.php" class="activo"><span class="fa fa-graduation-cap"></span> Carreras</a></li>
        <?php else: ?>
            <li><a href="carreras.php"><span class="fa fa-graduation-cap"></span> Carreras</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/asignaturas.php' || $_SERVER["REQUEST_URI"] == '/admin/asignaturas.php'): ?>
            <li><a href="asignaturas.php" class="activo"><span class="fa fa-folder-open-o"></span> Asignaturas</a></li>
        <?php else: ?>
            <li><a href="asignaturas.php"><span class="fa fa-folder-open-o"></span> Asignaturas</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/apuntes.php' || $_SERVER["REQUEST_URI"] == '/admin/apuntes.php'): ?>
            <li><a href="apuntes.php" class="activo"><span class="fa fa-files-o"></span> Apuntes</a></li>
        <?php else: ?>
            <li><a href="apuntes.php"><span class="fa fa-files-o"></span> Apuntes</a></li>
        <?php endif; ?>

        <?php if ($_SERVER["REQUEST_URI"] == '/apuntea/admin/mensajes.php' || $_SERVER["REQUEST_URI"] == '/admin/mensajes.php'): ?>
            <li><a href="mensajes.php" class="activo"><span class="fa fa-envelope"></span> Mensajes</a></li>
        <?php else: ?>
            <li><a href="mensajes.php"><span class="fa fa-envelope"></span> Mensajes</a></li>
            <?php endif; ?>
    </ul>
</div>