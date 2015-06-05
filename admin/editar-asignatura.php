<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();
$variables = $controlador->asignatura();
ob_start();
?>

<div class="col-9">
    <h2>
        <span class="fa fa-file-text-o"></span> Editar asignatura
    </h2>
    <hr>
    <div class="fila">

        <form action="../servicios/adminHandler.php?action=editarAsignatura&idAsignatura=<?php echo $variables["asignaturas"]->id ?>"  method="post">
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
                <input type="submit" value="Guardar cambios" class="campo-formulario">
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
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
