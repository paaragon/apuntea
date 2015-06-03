<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

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
                <li>666</li>
                <li>22</li>
                <li>101</li>
                <li>9122</li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="col-9">
    <h3>Última actividad:</h3>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-users"></span>
                <strong> <em>serfati</em> se ha añadido a tu lista de amigos</strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-pencil-square"></span>
                <strong> <em>irepas01</em> ha modificado el archivo <em> Tema 1</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-plus-square"></span>
                <strong> <em>MrSlide22</em> ha añadido el archivo <em> Tema 3</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-file-text-o"></span>
                <strong> <em> Kherdu </em> forma parte del grupo <em> Apuntes Aplicaciones Web</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-10">
                <span class="fa fa-user-plus"></span>
                <strong> <em> McMachote </em> te ha incluido en el grupo <em> Proyecto AW</em></strong>
            </span>
            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        </p>
        <div class="clear"></div>
    </div>
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
