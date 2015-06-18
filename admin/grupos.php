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

    <?php
    if (count($variables["grupos"]) > 0) {
        foreach ($variables["grupos"] as $gru) {
            //echo "<a class='btn btn-primary col-xs-12 grupo' href='ver-grupos.php'>$gru->nombre</a>";
            echo "<div class='fila'><a class='btn btn-primary col-xs-12 grupo' href='ver-grupo.php?idGrupo=" . $gru->id . "'>$gru->nombre</a></div>";
        }
    } else {
        echo "<blockquote><h3>No hay grupos.</h3></blockquote>";
    }
    ?>
</div>
<div class="col-3">
    <h4 class="text-center"><strong>Grupos con mas participantes</strong></h4>
    <canvas id="myChart1"></canvas>
    <hr>
    <h4 class="text-center"><strong>Grupos con mas apuntes</strong></h4>
    <canvas id="myChart2"></canvas>
</div>

<script>

    $(document).on("ready", function () {

        //Gráfica 1----------------------------------------------------
        var data1 = {
            labels: [<?php echo $variables["chart1"]["label"] ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $variables["chart1"]["data"] ?>]
                }
            ]
        };

        var canvas1 = document.getElementById("myChart1");
        canvas1.width = $("#myChart1").width() - 50;
        canvas1.height = 300;

        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart2 = new Chart(ctx).Bar(data1);

        //Gráfica 2----------------------------------------------------
        var data2 = {
            labels: [<?php echo $variables["chart2"]["label"] ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $variables["chart2"]["data"] ?>]
                }
            ]
        };

        var canvas2 = document.getElementById("myChart2");
        canvas2.width = $("#myChart2").width() - 50;
        canvas2.height = 300;

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart2 = new Chart(ctx).Bar(data2);//,{scaleBeginAtZero : false});

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
</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
