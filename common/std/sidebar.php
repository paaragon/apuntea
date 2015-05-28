<div class="panel">
    <div class="panel-cabecera"><strong>Acceder</strong></div>
    <div class="panel-cuerpo">
        <form action="usuario/inicio.php" method="post">
            <input type="text" class="campo-formulario" id="username" placeholder="Usuario">
            <br>
            <input type="password" class="campo-formulario" id="password" placeholder="Contraseña">
            <input type="submit" class="campo-formulario" value="Entrar">
        </form>
        <form action="admin/inicio.php" method="post">
            <input type="submit" class="campo-formulario" value="Entrar como administrador">
        </form>
        <p><small>El boton "Entrar como administrador" no aparecerá en la versión final. El mismo formulario de login servirá para ambos tipos de usuarios."</small></p>
        <hr>
        <div>
            <p>
                <strong>¿Aún no estas registrado?</strong> haz click en el siguiente botón para registrarte<br><br>
                <a class="campo-formulario boton" href="registrarse">Registrarse</a>
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