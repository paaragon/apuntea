<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->anadirAsignatura();

ob_start();
?>


<form action="../servicios/adminHandler.php?action=anadirAsignatura" method="post">

    <h3>Datos de la asignatura:</h3>
    <label>Nombre:</label>
    <input type="text" name="nombre" required=""  placeholder="Nombre de la asignatura" class="campo-formulario">
    <label>Curso:</label>
    <input type="number" name="curso" required=""  placeholder="Curso de la asignatura" class="campo-formulario">
    <label><span class="fa fa-university"></span> Universidad:</label>

    <select class="campo-formulario" name="universidad" id="select-universidad">
        <?php foreach ($variables["universidades"] as $universidad): ?>
            <option value="<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></option>
        <?php endforeach; ?>
    </select>
    <label><span class="fa fa-graduation-cap"></span>Carrera:<img src="../img/loading.GIF" id="load-carrera"></label>
    <select class="campo-formulario" name="carrera" id="select-carrera"></select>

    <hr>

    <script>

        $(document).on("ready", function () {
            getCarreras();
        });

        $("#select-universidad").on("change", function () {

            getCarreras();

        });

        function getCarreras() {
            $("#load-carrera").show();
            $("#select-carrera").html("");

            idUniversidad = $("#select-universidad").val();

            $.post("../servicios/adminHandler.php?action=getCarreras", {idUniversidad: idUniversidad}, function (data) {

                //Borramos su html interno
                $("#select-carrera").html("");

                //Insertamos las carreras obtenidas 
                for (var i = 0; i < data.length; i++) {

                    $("#select-carrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");

                }

                $("#load-carrera").hide();
            }, "json");
        }


    </script>

    <input type="submit" value="Aceptar asignatura nueva" class="campo-formulario">

</form>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
