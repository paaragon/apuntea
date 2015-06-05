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

<?php
$chart1 = array_reverse($variables["chart1"]);

$primer_mes = key($chart1);
$primer_valor = array_shift($chart1);

$etiquetas1 = '"' . $primer_mes . '"';
$valores1 = $primer_valor;

foreach ($chart1 as $month => $value) {

    $etiquetas1 .= ', "' . $month . '"';
    $valores1 .=', ' . $value;
}

$chart2 = $variables["chart2"];

$elem = array_shift($chart2);

$i = 1;
$data2 = '{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
foreach ($chart2 as $elem) {
    $i -= 0.2;
    $data2 .= ',{value: ' . $elem["num"] . ', color: "rgba(70, 181, 82, ' . $i . ')", highlight: "rgba(70, 181, 82, ' . ($i - 0.1) . ')", label: "' . $elem["siglas"] . '" }';
}

$chart3 = array_reverse($variables["chart3"]);

$primer_mes = key($chart3);
$primer_valor = array_shift($chart3);

$etiquetas3 = '"' . $primer_mes . '"';
$valores3 = $primer_valor;

foreach ($chart3 as $month => $value) {

    $etiquetas3 .= ', "' . $month . '"';
    $valores3 .=', ' . $value;
}
?>

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
            labels: [<?php echo $etiquetas1 ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $valores1 ?>]
                }
            ]
        };

        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart2 = new Chart(ctx).Line(data1);
        //Gráfica 2----------------------------------------------------
        var data2 = [<?php echo $data2 ?>]

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart1 = new Chart(ctx).Pie(data2);

        //Gráfica 3----------------------------------------------------
        var data3 = {
            labels: [<?php echo $etiquetas3 ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $valores3 ?>]
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
