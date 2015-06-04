<div class="panel">
    <div class="panel-cabecera"><strong>Acceder</strong></div>
    <div class="panel-cuerpo">
        <form action="servicios/standarHandler.php?action=doLogin&url=<?php echo $variables["url"] ?>" method="post">
            <input type="text" name="username" class="campo-formulario" placeholder="Usuario" required>
            <br>
            <input type="password" name="password" class="campo-formulario" placeholder="Contraseña" required>
            <?php
            if (isset($_SESSION["login-error"])) {
                echo '<p class="text-danger">' . $_SESSION["login-error"] . '</p>';
                unset($_SESSION["login-error"]);
            }
            ?>
            <input type="submit" class="campo-formulario" value="Entrar">
        </form>
        <blockquote>
            <h4>Inicia sesión con una de estas redes sociales:</h4>
            <h1>
                <a href="util/1353/fbconfig.php"><i class="fa fa-facebook-square"></i></a>
                <a href="registrado.php"><i class="fa fa-twitter-square"></i></a>
            </h1>
        </blockquote>
        <hr>
        <div>
            <p>
                <strong>¿Aún no estas registrado?</strong> haz click en el siguiente botón para registrarte<br><br>
                <a class="campo-formulario boton" href="registrarse.php">Registrarse</a>
            </p>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-cabecera"><strong>Búsqueda</strong></div>
    <div class="panel-cuerpo">
        <form action="resultado-busqueda.php" method="post">
            <label><input type="radio" name="opcion" value="universidades" checked> Universidades</label><br>
            <label><input type="radio" name="opcion" value="carreras"> Carreras</label><br>
            <label><input type="radio" name="opcion" value="asignaturas"> Asignaturas</label><br><br>
            <input type="text" class="campo-formulario" name="consulta" placeholder="Escribe aquí tu consulta">
            <br>
            <input type="submit" class="campo-formulario" value="Buscar">
        </form>
    </div>
</div>

<script>
    $(document).on("ready", function () {

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus();
        });
    });
</script>