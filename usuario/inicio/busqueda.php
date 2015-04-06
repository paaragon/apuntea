<div class="panel panel-default">
    <div class="panel-heading"><strong>Búsqueda</strong></div>
    <div class="panel-body">
        <form action="resultado-busqueda.php" method="post">
            <label><input type="radio" name="opcion" value="universidades" checked> Universidades</label><br>
            <label><input type="radio" name="opcion" value="carreras"> Carreras</label><br>
            <label><input type="radio" name="opcion" value="asignaturas"> Asignaturas</label><br><br>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                <input type="text" class="form-control" name="consulta" placeholder="Escribe aquí tu consulta">
            </div>
            <br>
            <input type="submit" class="btn btn-primary form-control" value="Buscar">
        </form>
    </div>
</div>