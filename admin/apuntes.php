<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->apuntes();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-file-text-o"></span> Apuntes subidos por los usuarios
    </h2>
    <hr>
    <div class="fila cosa-verde">
        <form action="apuntes.php"> <!-- method="post"> -->
            <!-- <label>Nombre:</label> -->
            <input id="buscador" type="search" name="nombre" placeholder="Busqueda por nombre" class="campo-formulario">
            <label><span class="fa fa-university"></span> Universidad:</label>
            <select id="selectUniversidad" name="universidad" class="campo-formulario campo-en-linea">
                <?php
                echo "<option class='universidad' value='0' selected=''>Todos</option>";
                foreach ($variables["universidades"] as $uni) {
                    echo "<option class='universidad' value='$uni->id'>$uni->nombre</option>";
                }
                ?>
            </select>
            <label><span class="fa fa-graduation-cap"></span> Carrera:</label>
            <select id="selectCarrera" class="campo-formulario campo-en-linea">
                <?php
                echo "<option class='carrera' value='0' selected=''>Todas</option>";
                /* foreach ($variables["carreras"] as $c) {
                    echo "<option class='carrera' value='$c->id'>$c->nombre</option>";
                } */
                ?>
            </select>
            <!-- <input type="submit" class="campo-formulario" value="Buscar"> -->
        </form>
    </div >


    <?php
    foreach ($variables["apuntes"] as $a) {
        echo "<div class='fila apunte'>
                        <p>
                            <span class='col-8'>
                                <span class='fa fa-file-text-o'></span>
                                <label><a href='ver-apunte.php'>" . $a->titulo . "</a></label>
                            </span>

                            <span class='col-1'><span class='fa fa-thumbs-o-up'></span> 20</span>
                            <span class='col-1'><span class='fa fa-thumbs-o-down'></span> 2</span>
                            <span class='col-1'><span class='fa fa-eye'></span> 999</span>

                            <span class='col-1'><a href='apuntes.php'><span class='fa fa-trash-o'></span></a></span>
                        </p>
                        <div class='clear'></div>
                    </div>";
    }
    ?>



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
        $("#buscador").on("keyup", function() {
            consulta = $(this).val();
            $(".apunte").each(function() {
                var cad = $(this).text();
                if (cad.toLowerCase().indexOf(consulta.toLowerCase()) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        $("#selectUniversidad").on("change", function () {
            var idUni = $("#selectUniversidad").val();
            getCarreras(idUni);
            
            /*
             * PRIMER FILTRADO DE APUNTES POR UNIVERSIDAD
             */
            
        });
        
        $("#selectUniversidad").on("change", function () {
            var idCar = $("#selectCarrera").val();
            
            /*
             * SEGUNDO FILTRADO DE APUNTES POR CARRERA
             */
            
        });
        
    });

    function getCarreras(id) {
        $("#selectCarrera").html("");
        if(id != 0){
            $.post("../servicios/usuarioHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            $("#selectCarrera").append("<option value='0' > -- </option>");
            for (i = 0; i < data.length; i++) {
                $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
            }
        }, "json");
        }
        else {
            $("#selectCarrera").append("<option class='carrera' value='0' selected=''>Todas</option>");
        }
    }

</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

