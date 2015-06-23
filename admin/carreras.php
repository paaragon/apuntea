<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$universidad = (isset($_GET["universidad"])) ? filter_input(INPUT_GET, "universidad", FILTER_SANITIZE_NUMBER_INT) : "";

$variables = $controlador->carreras($universidad);

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> Carreras
    </h2>
    <hr>
    <div>
        <div class="col-10">
            <label> Universidad:</label> 
            <select class="campo-formulario campo-en-linea" id="universidad-select">
                <option value="todas" selected="">Todas</option>
                <?php foreach ($variables["universidades"] as $uni): ?>
                    <?php $selected = ($universidad == $uni->id) ? "selected=''" : "" ?>
                    <option value="<?php echo $uni->id ?>" <?php echo $selected ?>><?php echo $uni->siglas ?></option>
                <?php endforeach; ?>
            </select>


        </div>
        <div>
            <a href="anadir-carrera.php" class="boton">Añadir carrera</a>
        </div>
        <div class="clear"></div>
    </div>
    <?php if (count($variables["carreras"]) > 0): ?>
        <?php foreach ($variables["carreras"] as $carrera):
            ?>
            <div class="fila">
                <p>
                    <span class="col-10">
                        <strong><a href="perfil-carrera.php?id=<?php echo $carrera->id ?>"><?php echo $carrera->nombre ?></a> <small>/
                                <a href="perfil-universidad.php?id=<?php echo $carrera->universidad->id ?>"><?php echo $carrera->universidad->siglas ?></a></small></strong>
                    </span>
                    <span class="col-1"><span class="fa fa-user"></span> <?php echo count($carrera->ownUsuarioList) ?></span>
                    <span class="col-1"><span id="f<?php echo $carrera->id . '-' . $carrera->nombre; ?>" class="fa fa-trash-o"></span></span>
                </p> 
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <blockquote><h3>No hay carreras.</h3></blockquote>
    <?php endif; ?>
</div>
<div class="col-3">
    <div>
        <canvas id="myChart1"></canvas>
        <h4 class="text-center"><strong>Carreras con mas usuarios</strong></h4>
    </div>
    <div>
        <canvas id="myChart2"></canvas>
        <h4 class="text-center"><strong>Carreras con mas apuntes </strong></h4>
    </div>
</div>
<div class="clear"></div>
<script>
    $(document).ready(function () {
        $("#universidad-select").on("change", function () {
            window.location = "carreras.php?universidad=" + $(this).val();
        });

        $('.fa-trash-o').on("click", function () {

            id = $(this).attr("id").substring(1).split('-');
            var r = confirm("Seguro que quieres borrar esta carrera " + id[1] + '?');
            if (r == true) {

                window.location.href = '../servicios/adminHandler.php?action=borrarCarrera&id=' + id[0];
            }
        });

        var canvas1 = document.getElementById("myChart1");
        var canvas2 = document.getElementById("myChart2");

        canvas1.width = $("#main").width() / 4;
        canvas1.height = 240;
        canvas2.width = $("#main").width() / 4;
        canvas2.height = 240;

        //Gráfica 1----------------------------------------------------
        var data1 = [<?php echo $variables["chart1"]["data"] ?>]

        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart1 = new Chart(ctx).Pie(data1);

        //Gráfica 2----------------------------------------------------
        var data2 = [<?php echo $variables["chart2"]["data"] ?>]



        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart2 = new Chart(ctx).Pie(data2);
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
