<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();
$variables = $controlador->editarAsignatura();
ob_start();
?>

<div class="col-12">
    <h2>
        <span class="fa fa-file-text-o"></span> Editar asignatura
    </h2>
    <hr>
    <?php if (isset($variables["asignatura"])): ?>
        <div class="fila">

            <form action="../servicios/adminHandler.php?action=editarAsignatura&idAsignatura=<?php echo $variables["asignatura"]->id ?>"  method="post">
                <label>Nombre:</label>
                <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario" value="<?php echo $variables["asignatura"]->nombre ?>">

                <label><span class="fa fa-university"></span> Universidad:</label>
                <select class="campo-formulario" name="universidad" id="select-universidad">
                    <?php foreach ($variables["universidades"] as $universidad): ?>
                        <?php $selected = ($universidad->id == $variables["asignatura"]->id) ? "selected=''" : "" ?>
                        <option value="<?php echo $universidad->id ?>" <?php echo $selected ?>><?php echo $universidad->siglas ?></option>
                    <?php endforeach; ?>
                </select>
                <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
                <select class="campo-formulario" name="carrera" id="select-carrera"></select>
                <input type="submit" value="Guardar cambios" class="campo-formulario">
            </form>
        </div>
    <?php else: ?>
        <blockquote><h3>Asignatura no encontrada.</h3></blockquote>
    <?php endif; ?>
</div>
<script>
    getCarreras();

    $("#select-universidad").on("change", getCarreras);

    function getCarreras() {
        $("#select-carrera").html("");
        $("#select-carrera").append("<option value=''>Todas</option>");
        idUniversidad = $("#select-universidad").val();

        $.post("../servicios/adminHandler.php?action=getCarreras", {idUniversidad: idUniversidad}, function (data) {
            //Insertamos las carreras obtenidas
            for (var i = 0; i < data.length; i++) {
                if (data[i]["id"] == <?php echo $variables["asignatura"]->carrera->id ?>) {
                    $("#select-carrera").append("<option value='" + data[i]["id"] + "' selected=''>" + data[i]["nombre"] + "</option>");
                } else {
                    $("#select-carrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            }
        }, "json");
    }
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
