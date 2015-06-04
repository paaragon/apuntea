<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->subirApuntes();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-cloud-upload"></span> Añadir apuntes:
    </h2>
    <hr>
    <!--Creacion principal para subir archivo -->
    <form action="../servicios/usuarioHandler.php?action=subirApunte" method="post" autocomplete="off">
        <h3>Datos de los apuntes:</h3>
        <label>Nombre:</label>
        <input type="text" name="nombre" placeholder="Nombre de los apuntes" class="campo-formulario" required="">
        <label><span class="fa fa-university"></span> Universidad:</label>
        <select id="selectUniversidad" name="universidad" class="campo-formulario">
            <?php
            foreach ($variables["universidades"] as $uni) {
                if ($uni->id == $variables["usuario"]->carrera->universidad_id) {
                    echo "<option value='$uni->id' selected>$uni->nombre</option>";
                } else {
                    echo "<option value='$uni->id'>$uni->nombre</option>";
                }
            }
            ?>
        </select>
        <label id="labelCarrera"><span class="fa fa-graduation-cap"></span>Carrera:</label>
        <select id="selectCarrera" name="carrera" class="campo-formulario" required=""></select>
        <label><span class="fa fa-graduation-cap"></span>Asignatura:</label>
        <select id="selectAsignatura" name="asignatura" class="campo-formulario" required=""></select>
        <hr>
        <h3><span class="fa fa-key"></span>Permisos:</h3>
        <span class="col-4">
            <label><span class="fa fa-eye"></span> Visualización:</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion" checked="" value="0"> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion" value="1"> Algunos usuarios</label>
            <label class="campo-formulario"><input type="radio" name="visualizacion" value="2"> Público</label>
            <hr>
            <span id="lectores">
                <label>Lectores:</label>
                <select id="selectPermiso1" class="campo-formulario">
                    <?php
                    foreach ($variables["contactos"] as $con) {
                        echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                    }
                    ?>
                </select>
            </span>
        </span>
        <span class="col-4">
            <label><span class="fa fa-edit"></span> Modificación:</label>
            <label class="campo-formulario"><input type="radio" name="modificacion" checked="" value="0"> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="modificacion" value="1"> Alguno usuarios</label>
            <hr>
            <span id="modificar">
                <label>Usuarios que modifiquen:</label>
                <select id="selectPermiso2" class="campo-formulario">
                    <?php
                    foreach ($variables["contactos"] as $con) {
                        echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                    }
                    ?>
                </select>
            </span>
        </span>
        <span class="col-4">
            <label><span class="fa fa-key"></span> Edición de permisos:</label>
            <label class="campo-formulario"><input type="radio" name="edicion-permisos" checked="" value="0"> Solo yo</label>
            <label class="campo-formulario"><input type="radio" name="edicion-permisos"  value="1"> Alguno usuarios</label>
            <hr>
            <span id="permisos">
                <label>Usuarios que editen permisos:</label>
                <select id="selectPermiso3" class="campo-formulario">
                    <?php
                    foreach ($variables["contactos"] as $con) {
                        echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                    }
                    ?>
                </select>
            </span>
        </span>
        <input type="submit" value="Crear y redactar" class="campo-formulario">
    </form>
</div>

<script>
    getCarreras($("#selectUniversidad").val());

    $(document).on("ready", function () {

        $("#selectPermiso1 option").on("click", function () {
            id = $(this).val();
            nombre = $(this).text();
            $("#lectores").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
            $("#lectores").append('<input name="lector[]" type="hidden" value="' + id + '">');
            $(this).remove();
        });

        $("#selectPermiso2 option").on("click", function () {
            id = $(this).val();
            nombre = $(this).text();
            $("#modificar").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
            $("#modificar").append('<input name="modificador[]" type="hidden" value="' + id + '">');
            $(this).remove();
        });

        $("#selectPermiso3 option").on("click", function () {
            id = $(this).val();
            nombre = $(this).text();
            $("#permisos").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
            $("#permisos").append('<input name="permisor[]" type="hidden" value="' + id + '">');
            $(this).remove();
        });

        $("#selectUniversidad").on("change", function () {
            getCarreras($("#selectUniversidad").val());
        });

        $("#selectCarrera").on("change", function () {
            getAsignaturas($("#selectCarrera").val());
        });

        $('input[type=radio][name=visualizacion]').change(function () {
            if (this.value == '1') {
                $("#lectores").show();
            }
            else {
                $("#lectores").hide();
            }
        });

        $('input[type=radio][name=edicion-permisos]').change(function () {
            if (this.value == '1') {
                $("#permisos").show();
            }
            else {
                $("#permisos").hide();
            }
        });

        $('input[type=radio][name=modificacion]').change(function () {
            if (this.value == '1') {
                $("#modificar").show();
            }
            else {
                $("#modificar").hide();
            }
        });

        $("#lectores").hide();
        $("#permisos").hide();
        $("#modificar").hide();

    });

    function getCarreras(id) {
        $("#selectCarrera").html("");
        $.post("../servicios/usuarioHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                if (data[i]["id"] ==<?php echo ($variables["usuario"]->carrera_id == NULL) ? -1 : $variables["usuario"]->carrera_id ?>) {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "' selected>" + data[i]["nombre"] + "</option>");
                    getAsignaturas(data[i]["id"]);
                }
                else {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            }
        }, "json");
    }

    function getAsignaturas(id) {
        $("#selectAsignatura").html("");
        $.post("../servicios/usuarioHandler.php?action=getAsignaturas", {idCarrera: id}, function (data) {

            if (data.length > 0) {
                $('#spanCarrera').remove();
                for (i = 0; i < data.length; i++) {
                    $("#selectAsignatura").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            } else {
                $("#labelCarrera").append(" <span id='spanCarrera' class='text-warning'>Esta carrera aún no tiene asignaturas</span>");
            }
        }, "json");

    }
</script>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
