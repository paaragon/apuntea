<!--HE VISTO QUE TODA LA BUSQUEDA
LA HACES CON BOOTS, SOLO COPIE EL ESQUELETO HTML
Y NO LE DI FORMATO COMO DIJISTE QUE ESTABAS HACIENDO EL CSS
PARA LAS BUSQUEDAS :)-->


<!--Busqueda de contacto-->
<div class="panel panel-default">
    <div class="panel-heading"><strong>Buscar Amigos</strong></div>
    <div class="panel-body">
        <!--Form cifrado para la busqueda-->
        <form action="resultado-busqueda.php" method="post">
            <!-- <form class="form-horizontal" action="#" method="post">-->
            <div class="form-group">
                <label for="reg-alias" class="col-sm-2 control-label">Alias</label>

                <input type="text" id="reg-alias" class="form-control" placeholder="Alias" name="alias">

            </div>
            <div class="form-group">
                <label for="reg-nombre" class="col-sm-2 control-label">Nombre</label>

                <input type="text" id="reg-nombre" class="form-control" placeholder="Nombre" name="nombre">

            </div>
            <div class="form-group">
                <label for="reg-apellidos" class="col-sm-2 control-label">Apellidos</label>

                <input type="text" id="reg-apellidos" class="form-control" placeholder="Apellidos" name="apellidos">

            </div>
            <div class="form-group">
                <label for="reg-ciudad" class="col-sm-2 control-label">Ciudad</label>

                <input type="text" id="reg-ciudad" class="form-control" placeholder="Ciudad" name="ciudad">

            </div>
            <div class="form-group">
                <label for="reg-universidad" class="col-sm-2 control-label">Universidad</label>

                <input type="text" id="reg-universidad" class="form-control" placeholder="Universidad" name="universidad">

            </div>
            <div class="form-group">
                <label for="reg-facultad" class="col-sm-2 control-label">Facultad</label>

                <input type="text" id="reg-facultad" class="form-control" placeholder="Facultad" name="facultad">

            </div>
            <div class="form-group">
                <label for="reg-carrera" class="col-sm-2 control-label">Carrera</label>

                <input type="text" id="reg-carrera" class="form-control" placeholder="Carrera" name="carrera">

            </div>

            <!-- </form>-->
            <div class ="clear"></div>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                <input type="text" class="form-control" name="consulta" placeholder="Puede buscarlo directamente">
            </div>
            <br>
            <input type="submit" class="btn btn-primary form-control" value="Buscar">
        </form>
    </div>
</div>







<!--Invitacion  para un amigo-->
<div class="panel panel-default">
    <div class="panel-heading"><strong>Invita a un amigo</strong></div>
    <div class="panel-body">
        <form action="resultado-busqueda.php" method="post">
            <!--Datos para pedir datos-->
            <div class="form-group">
                <label for="reg-invita" class="col-sm-2 control-label">Invita</label>

                <input type="text" id="reg-invita" class="form-control" placeholder="Ingresa el correo de un amigo" name="invita">
            </div>
            <p>La invitacion se enviara al correo proporcionado
                en breves momentos,,,
            </p>
            <!--Boton para enviar-->
            <input type="submit" class="btn btn-primary form-control" value="Invitar">
        </form>
    </div>
</div>