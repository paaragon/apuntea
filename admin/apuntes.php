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
                echo "<option class='universidad' value='0' selected=''>Todas</option>";
                foreach ($variables["universidades"] as $uni) {
                    echo "<option class='universidad' value='$uni->id'>$uni->nombre</option>";
                }
                ?>
            </select>
            <label><span class="fa fa-graduation-cap"></span> Carrera:</label>
            <select id="selectCarrera" class="campo-formulario campo-en-linea">
                <option class='carrera' value='0' selected=''>Todas</option>
            </select>
        </form>
    </div >


    <?php
    foreach ($variables["apuntes"] as $a) {
        echo "<div class='fila apunte'>
                        <span class='nombre hide'>" . $a->titulo . "</span>
                        <span class='carrera hide'>" . $a->asignatura->carrera->id . "</span>
                        <span class='universidad hide'>" . $a->asignatura->carrera->universidad->id . "</span>
                        <p>
                            <span class='col-8'>
                                <span class='fa fa-file-text-o'></span>
                                <label><a href='ver-apunte.php?id=" . $a->id . "'>" . $a->titulo . "</a></label>
                                <label class='hide'>$a->asignatura_id</a></label>
                            </span>

                            <span class='col-1'><span class='fa fa-thumbs-o-up'></span> " . $a->likes . "</span>
                            <span class='col-1'><span class='fa fa-thumbs-o-down'></span> " . $a->dislikes . "</span>
                            <span class='col-1'><span class='fa fa-eye'></span> " . $a->visualizaciones . "</span>

                            <span class='col-1'><a href='#'><span class='eliminar fa fa-trash-o' id='e" . $a->id . "'></span></a></span>
                        </p>
                        <div class='clear'></div>
                    </div>";
    }
    ?>
</div>
<div class="col-3">
    <h4 class="text-center"><strong>Apuntes en los últimos 7 meses</strong></h4>
    <canvas id="myChart1"></canvas>
    <hr>
    <h4 class="text-center"><strong>Usuarios con más apuntes</strong></h4>
    <canvas id="myChart2"></canvas>
</div>

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

$primer_elemento = array_shift($chart2);

$etiquetas2 = '"' . $primer_elemento["nick"] . '"';
$valores2 = $primer_elemento["num"];

foreach ($chart2 as $elem) {

    $etiquetas2 .= ', "' . $elem["nick"] . '"';
    $valores2 .=', ' . $elem["num"];
}
?>
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

        var canvas1 = document.getElementById("myChart1");
        canvas1.width = $("#myChart1").width() - 50;
        canvas1.height = 200;
        
        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart2 = new Chart(ctx).Line(data1);
        
        //Gráfica 2----------------------------------------------------
        var data2 = {
            labels: [<?php echo $etiquetas2 ?>],
            datasets: [
                {
                    fillColor: "rgba(70, 181, 82, 0.2)",
                    strokeColor: "rgba(59, 152, 68, 0.5)",
                    pointColor: "rgba(59, 152, 68, 0.6)",
                    pointStrokeColor: "rgba(59, 152, 68, 0.8)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [<?php echo $valores2 ?>]
                }
            ]
        };

        var canvas2 = document.getElementById("myChart2");
        canvas2.width = $("#myChart2").width() - 50;
        canvas2.height = 200;

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart2 = new Chart(ctx).Bar(data2);

        $("#buscador").on("keyup", function () {
            buscar();
        });

        $("#selectUniversidad").on("change", function () {
            var idUni = $("#selectUniversidad").val();
            getCarreras(idUni);
            buscar();
        });

        $("#selectCarrera").on("change", function () {
            buscar();
        });

        $(".eliminar").on("click", function () {
            var r = confirm("¿Está seguro?");
            if (r == true) {
                id = $(this).attr('id').substring(1);
                window.location = "../servicios/adminHandler.php?action=removeApunte&id=" + id;
            }
        });

    });

    function buscar() {
        universidad = $("#selectUniversidad").val();
        carrera = $("#selectCarrera").val();
        consulta = $("#buscador").val();

        $(".apunte").each(function () {
            var uni = $(this).children(".universidad").text();
            var car = $(this).children(".carrera").text();
            var con = $(this).children(".nombre").text();
            if ((universidad == uni || universidad == 0) && (carrera == car || carrera == 0) && (quitaAcentos(con.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) > -1)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function getCarreras(id) {
        $("#selectCarrera").html("<option value='0' selected=''>Todas</option>");
        if (id != 0) {
            $.post("../servicios/adminHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {

                for (i = 0; i < data.length; i++) {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            }, "json");
        }
    }

    function quitaAcentos(str) {
        for (var i = 0; i < str.length; i++) {
            if (str.charAt(i) == "á")
                str = str.replace(/á/, "a");
            if (str.charAt(i) == "é")
                str = str.replace(/é/, "e");
            if (str.charAt(i) == "í")
                str = str.replace(/í/, "i");
            if (str.charAt(i) == "ó")
                str = str.replace(/ó/, "o");
            if (str.charAt(i) == "ú")
                str = str.replace(/ú/, "u");
        }
        return str;
    }
</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

