<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->grupos();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-users"></span> Grupos
    </h2>
    <hr>
    <div>
        <span>
            <input id="buscador" type="search" class="campo-formulario" placeholder="Busqueda por nombre">
        </span>
    </div>
    <div>
        <form action="apuntes.php" method="post">
            <!-- <label>Nombre:</label> <input type="search" name="nombre" placeholder="Busqueda por nombre" class="campo-formulario"> -->
            <!-- <span class="col-3"><label><span class="fa fa-university"></span> Universidad:</label></span>
            <span class="col-9">
                <select id="selectUniversidad" name="universidad" class="campo-formulario">
                    <?php
                 /*   foreach ($variables["universidades"] as $uni) {
                        echo "<option value='$uni->id'>$uni->nombre</option>";
                    }*/
                    ?>
                </select>
            </span>
            <span class="col-3"><label><span class="fa fa-graduation-cap"></span> Carrera:</label></span>
            <span class="col-9">
                <select id="selectCarrera" name="carrera" class="campo-formulario"></select>
            </span> -->
        </form>

    </div>

    <div>
        <form>
            <span class="campo-formulario col-12" id="grupo-boton">
                <?php
                foreach ($variables["grupos"] as $gru) {
                    //echo "<a class='btn btn-primary col-xs-12 grupo' href='ver-grupos.php'>$gru->nombre</a>";
                    echo "<a class='btn btn-primary col-xs-12 grupo' href='ver-grupo.php?idGrupo=" . $gru->id . "'>$gru->nombre</a>";
                }
                ?>
            </span>
        </form>
    </div>

</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>

<script>
    $(document).on("ready", function() {
        //quitado -> futuro uso?
        //getCarreras($("#selectUniversidad").val());
        
        //quitado -> futuro uso?
        //$("#selectUniversidad").on("change", function() {
        //    getCarreras($("#selectUniversidad").val());
        //});

        $("#buscador").on("keyup", function () {
            consulta = $(this).val();
            $(".grupo").each(function () {
                var cad = $(this).text();
                if (cad.toLowerCase().indexOf(consulta.toLowerCase()) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
            
     });
                    
    //quitado -> futuro uso?
    //function getCarreras(id) {
    //    $("#selectCarrera").html("");
    //    $.post("../servicios/adminHandler.php?action=getCarreras", {idUniversidad: id}, function(data) {
    //        $("#selectCarrera").append("<option value='0'> Todos </option>");
    //        for (i = 0; i < data.length; i++) {
    //            $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
    //        }
    //    }, "json");
    //}
</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
