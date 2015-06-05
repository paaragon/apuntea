<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->asignatura();

ob_start();
?>
<div class="col-9">

    <div class="fila">
        <form action ="asignaturas.php" method="post">

            <h2>
                <span class="fa fa-file-text-o"></span> Asignaturas
            </h2>
            <hr>
            <p>
                <a href="asignaturas-nuevas.php" class="boton">Añadir asignatura</a>
            </p>

            <label>Nombre:</label>
            <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario">

            <label><span class="fa fa-university"></span> Universidad:</label>
            <select class="campo-formulario" name="universidad" id="select-universidad">
                <?php foreach ($variables["universidades"] as $universidad): ?>
                    <option value="<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></option>
                <?php endforeach; ?>
            </select>
            <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
            <select class="campo-formulario" name="carrera" id="select-carrera"></select>

            <p>
                <input type="submit" value="Buscar" class="campo-formulario">
            </p>
            <script>
                //Llamada al metodo cuando
                /*
                 * Cuando ocurre un evento ejecuta la funcion asociada
                 * @param {change} cuando haya un camibo en el selec-universidad
                 * @param {function} funcion que se va ejecutar asociada al
                 * 
                 */

                $(document).on("ready", function () {
                    getCarreras();
                });

                $("#select-universidad").on("change", function () {

                    getCarreras();

                });

                function getCarreras() {
                    $("#select-carrera").html("");

                    idUniversidad = $("#select-universidad").val();

                    $.post("../servicios/adminHandler.php?action=getCarrerasFromUni&id=" + idUniversidad, function (data) {

                        //Borramos su html interno
                        $("#select-carrera").html("");

                        //Insertamos las carreras obtenidas 
                        for (var i = 0; i < data.length; i++) {

                            $("#select-carrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");

                        }


                    }, "json");
                }


            </script>


        </form>
    </div>


    <h3>Listado de todas las asignaturas</h3>

    <?php foreach ($variables["asignaturas"] as $asignatura): ?>
        <div class="fila">
            <p>
                <span class="col-10">
                    <strong>
                        <a href="asignatura.php?id=<?php echo $asignatura->id ?>"><?php echo $asignatura->nombre ?></a> 
                        <small>/ <a href="perfil-carrera.php?id=<?php echo $asignatura->carrera->id ?>"><?php echo $asignatura->carrera->nombre ?></a></small>
                        <small>/ <a href="perfil-universidad.php?id=<?php echo $asignatura->carrera->universidad->id ?>"><?php echo $asignatura->carrera->universidad->siglas ?></a></small>

                    </strong>
                </span>
                <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
                <span class="col-1 minus-color"><a href="../servicios/adminHandler.php?action=borrarAsignatura&idAsignatura=<?php echo $asignatura->id ?>"><span class="fa fa-trash"></span></a></span>
            </p> 
            <div class="clear"></div>
        </div>
    <?php endforeach; ?>



</div>

<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>



<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

