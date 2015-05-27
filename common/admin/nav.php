<div>
    <div id="user-info">
        <h3>Administrador Apuntea</h3>
        <p>
            <strong><?php echo $variables["usuario-actual"]->nombre . " " . $variables["usuario-actual"]->apellidos ?></strong><br>
            <small><a href="editar-admin.php">Editar datos de usuario</a></small>
        </p>
    </div>
    <ul>
        <li><a href="inicio.php"><span class="fa fa-home"></span> Inicio</a></li>
        <li><a href="usuarios.php"><span class="fa fa-users"></span> Usuarios</a></li>
        <li><a href="grupos.php"><span class="fa fa-circle-o-notch"></span> Grupos</a></li>
        <li><a href="universidades.php"><span class="fa fa-university"></span> Universidades</a></li>
        <li><a href="carreras.php"><span class="fa fa-graduation-cap"></span> Carreras</a></li>
        <li><a href="asignaturas.php"><span class="fa fa-folder-open-o"></span> Asignaturas</a></li>
        <li><a href="apuntes.php"><span class="fa fa-files-o"></span> Apuntes</a></li>
        <li><a href="mensajes.php"><span class="fa fa-envelope"></span> Mensajes</a></li>
    </ul>
</div>