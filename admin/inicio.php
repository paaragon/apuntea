<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();

$variables = $controlador->inicio();

ob_start();
?>
<h2>
    <span class="fa fa-home"></span> Inicio
</h2>
<hr>
<div class="row">
    <div class="col-md-4">
        <canvas id="myChart1"></canvas>
        <h4 class="text-center"><strong>Nº usuarios registrados en los últimos 7 meses</strong></h4>
    </div>
    <div class="col-md-4">
        <canvas id="myChart2"></canvas>
        <h4 class="text-center"><strong>Universidades / apuntes (%)</strong></h4>
    </div>
    <div class="col-md-4">
        <canvas id="myChart3"></canvas>
        <h4 class="text-center"><strong>Nº apuntes en los últimos 7 meses</strong></h4>
    </div>
</div>
<div class="col-3">
    <h3>Cifras:</h3>
    <div class="fila">
        <div class="col-8">
            <ul class="no-style-list">
                <li><strong>Nº universidades</strong></li>
                <li><strong>Nº carreras</strong></li>
                <li><strong>Nº asignaturas</strong></li>
                <li><strong>Nº apuntes</strong></li>
            </ul>
        </div>
        <div class="col-4">
            <ul class="no-style-list">
                <li><?php echo $variables['numuniversidades'] ?></li>
                <li><?php echo $variables['numcarreras'] ?></li>
                <li><?php echo $variables['numasignaturas'] ?></li>
                <li><?php echo $variables['numapuntes'] ?></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="col-9">
    <h3>Última actividad:</h3>
    <?php if (count($variables["grupos"]) > 0 || count($variables["usuarios"]) > 0 || count($variables["apuntes"]) > 0): ?>
        <?php foreach ($variables["grupos"] as $g): ?>
            <div class="fila">
                <p>
                    <span class="col-11">
                        <a href="ver-grupo.php?id=<?php echo $g->id ?>"><span class="fa fa-circle-o-notch"></span> <?php echo $g["nombre"] ?> </a> ha sido creado
                    </span>
                    <span class="col-1"><span class="fa fa-users"></span><?php echo count($g->ownUsuariogrupoList) ?></span>
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <?php foreach ($variables["usuarios"] as $u): ?>
            <div class="fila">
                <p>
                    <span class="col-11">
                        <a href="usuarios-detalles.php?id=<?php echo $u->id ?>"><span class="fa fa-users"></span> <?php echo $u["nick"] ?> </a> se ha registrado
                    </span>
                    <span class="col-1"><span class="fa fa-file"></span><?php echo count($u->ownApunteList) ?> </span>
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <?php foreach ($variables["apuntes"] as $a): ?>
            <div class="fila">
                <p>
                    <span class="col-9">
                        <a href="ver-apunte.php?id=<?php echo $a->id ?>"><span class="fa fa-file"></span> <?php echo $a["titulo"] ?> </a> se han añadido
                    </span>
                    <span class="col-1"><span class="fa fa-thumbs-up"></span><?php echo $a->likes ?></span>
                    <span class="col-1"><span class="fa fa-thumbs-down"></span><?php echo $a->dislikes ?></span>
                    <span class="col-1"><span class="fa fa-eye"></span><?php echo $a->visualizaciones ?></span>
                </p>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <blockquote><h4>Sin actividad reciente.</h4></blockquote>
    <?php endif; ?>
</div>
<div class="clear"></div>
<script>
    $(document).on("ready", function () {

        var canvas1 = document.getElementById("myChart1");
        var canvas2 = document.getElementById("myChart2");
        var canvas3 = document.getElementById("myChart3");

        canvas1.width = $("#main").width() / 3 - 25;
        canvas1.height = 240;
        canvas2.width = $("#main").width() / 3 - 25;
        canvas2.height = 240;
        canvas3.width = $("#main").width() / 3 - 25;
        canvas3.height = 240;

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

        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart2 = new Chart(ctx).Line(data1);
        //Gráfica 2----------------------------------------------------
        var data2 = [<?php echo $variables["chart2"]["data"] ?>]

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart1 = new Chart(ctx).Pie(data2);

        //Gráfica 3----------------------------------------------------
        var data3 = {
            labels: [<?php echo $variables["chart3"]["label"] ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $variables["chart3"]["data"] ?>]
                }
            ]
        };

        var ctx = document.getElementById("myChart3").getContext("2d");
        var myLineChart3 = new Chart(ctx).Line(data3);
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
