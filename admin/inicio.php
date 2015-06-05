<?php
require "../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();

$variables = $controlador->inicioAdmin();

ob_start();
?>
<h2>
    <span class="fa fa-home"></span> Inicio
</h2>
<hr>
<div class="row">
    <div class="col-md-4">
        <canvas id="myChart1"></canvas>
        <h4 class="text-center"><strong>Gráfica 1</strong></h4>
    </div>
    <div class="col-md-4">
        <canvas id="myChart2"></canvas>
        <h4 class="text-center"><strong>Gráfica 2</strong></h4>
    </div>
    <div class="col-md-4">
        <canvas id="myChart3"></canvas>
        <h4 class="text-center"><strong>Gráfica 3</strong></h4>
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
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };
        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart1 = new Chart(ctx).Line(data1);

        //Gráfica 2----------------------------------------------------
        var data2 = {
            labels: ["January", "February", "March", "April", "May", "June"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55]
                }
            ]
        };

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart1 = new Chart(ctx).Bar(data2);

        //Gráfica 3----------------------------------------------------
        var data3 = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [50, 200, 70, 100, 15, 250, 200, 220]
                }
            ]
        };
        var ctx = document.getElementById("myChart3").getContext("2d");
        var myLineChart1 = new Chart(ctx).Line(data3);
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
