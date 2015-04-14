<!--Busqueda de contacto-->
<div class="panel">
    <div class="panel-cabecera"><strong>Buscar Amigos</strong></div>
    <div class="panel-cuerpo">
        <!--Form cifrado para la busqueda-->
        <form action="#" method="post">
            <!-- <form class="form-horizontal" action="#" method="post">-->
            <label>Alias:</label>
            <input type="text" class="campo-formulario" placeholder="Alias" name="alias">
            <label>Nombre:</label>
            <input type="text" class="campo-formulario" placeholder="Nombre" name="nombre">
            <label>Apellidos:</label>
            <input type="text" class="campo-formulario" placeholder="Apellidos" name="apellidos">
            <label>Ciudad:</label>
            <input type="text" class="campo-formulario" placeholder="Ciudad" name="ciudad">
            <label>Universidad:</label>
            <input type="text" class="campo-formulario" placeholder="Universidad" name="universidad">
            <label>Facultad:</label>
            <input type="text" class="campo-formulario" placeholder="Facultad" name="facultad">
            <label>Carrera:</label>
            <input type="text" class="campo-formulario" placeholder="Carrera" name="carrera">
            <input type="submit" class="campo-formulario" value="Buscar">
        </form>
    </div>
</div>
<!--Invitacion  para un amigo-->
<div class="panel">
    <div class="panel-cabecera"><strong>Invita a un amigo</strong></div>
    <div class="panel-cuerpo">
        <p>
        <form action="resultado-busqueda.php" method="post">
            <!--Datos para pedir datos-->
            <label>Correo electrónico:</label>
            <input type="text" class="campo-formulario" placeholder="Ingresa el correo de un amigo" name="invita">
            <!--Boton para enviar-->
            <input type="submit" class="campo-formulario" value="Invitar">
            </p>
        </form>
    </div>
</div>