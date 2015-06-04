<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->verApunte();
$apunte = $variables["apunte"];
ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-file-o"></span> <?php echo $apunte->titulo ?>
    </h2>
    <hr>
    <div id="head-apunte">
        <p>
            <span class="col-10">
                <a href="perfil-universidad.php?id=<?php echo $apunte->asignatura->carrera->universidad->id ?>"><?php echo $apunte->asignatura->carrera->universidad->siglas ?></a> / 
                <a href="perfil-carrera.phpid=<?php echo $apunte->asignatura->carrera->id ?>"><?php echo $apunte->asignatura->carrera->nombre ?></a> /
                <a href="asignatura.php?id=<?php echo $apunte->asignatura->id ?>"><?php echo $apunte->asignatura->nombre ?></a>
            </span>
        </p>
        <div class="clear"></div>
    </div>
    <br>
    <hr>
    <div id="contenido-apunte">

        <h1 class="text-center"><?php echo $apunte->titulo ?></h1>
        <div>
            <?php echo $apunte->contenido ?>
        </div>
    </div>
    <div>
        <?php foreach (array_reverse($apunte->ownComentarioapunteList) as $comentario): ?>
            <div class="fila">
                <h4><a href="usuarios-detalles.php?id=<?php echo $comentario->usuario->id ?>"><?php echo $comentario->usuario->nombre ?></a> <small><?php echo date("d-m-Y", strtotime($comentario->fecha)) ?></small></h4>
                <p>
                    <?php echo $comentario->texto ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-3">
    <h2>Autor:</h2>
    <div class="fila">
        <div class="col-5"><p><img src="../img/usuarios/perfil/<?php echo $apunte->usuario->avatar ?>" class="img-responsive"/></p></div>
        <div class="col-7">
            <p>
                <strong>Cholo 1</strong> 
                <small><a href="usuarios-detalles.php?id=<?php echo $apunte->usuario->id ?>" class="color-green">@<?php echo $apunte->usuario->nick ?></a></small>
            </p>
            <blockquote>
                <p>
                    <?php echo $apunte->usuario->estado ?>
                </p>
            </blockquote>
            <p>
                <span class="distintivo"><?php echo count($apunte->usuario->alias('alice')->ownContactoList) + count($apunte->usuario->alias('bob')->ownContactoList) ?></span> Amigos<br><br>
            </p>
        </div>
        <a href="mensajes.php?id=<?php echo $apunte->usuario->id ?>" class="boton col-xs-12">Enviar mensaje</a>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <span class="col-3"><span class="fa fa-thumbs-o-up"></span> <?php echo $apunte->likes ?></span>
        <span class="col-3"><span class="fa fa-thumbs-o-down"></span> <?php echo $apunte->dislikes ?></span>
        <span class="col-4"><span class="fa fa-eye"></span> <?php echo $apunte->visualizaciones ?></span>
        <span class="col-1"><a href="../servicios/adminHandler.php?action=removeApunte&id=<?php echo $apunte->id ?>"><span class="fa fa-trash-o"></span></a></span>
        <br>
    </div>
    <h4 class="text-center"><strong>Likes en las últimas semanas</strong></h4>
    <canvas id="myChart1"></canvas>
    <hr>
    <h4 class="text-center"><strong>Dislikes en las últimas semanas</strong></h4>
    <canvas id="myChart2"></canvas>
    <hr>
    <h4 class="text-center"><strong>Favoritos en las últimas semanas</strong></h4>
    <canvas id="myChart3"></canvas>
</div>
<script>
    $(document).on("ready", function () {

<?php

$chart1 = $variables["likes"];

$primer_elemento = array_shift($chart1);

$etiquetas1 = '"' . $primer_elemento["semana"] . '"';
$valores1 = $primer_elemento["num"];

foreach ($chart1 as $elem) {

    $etiquetas1 .= ', "' . $elem["semana"] . '"';
    $valores1 .=', ' . $elem["num"];
}

$chart2 = $variables["dislikes"];

$primer_elemento = array_shift($chart2);

$etiquetas2 = '"' . $primer_elemento["semana"] . '"';
$valores2 = $primer_elemento["num"];

foreach ($chart2 as $elem) {

    $etiquetas2 .= ', "' . $elem["semana"] . '"';
    $valores2 .=', ' . $elem["num"];
}

$chart3 = $variables["favoritos"];

$primer_elemento = array_shift($chart3);

$etiquetas3 = '"' . $primer_elemento["semana"] . '"';
$valores3 = $primer_elemento["num"];

foreach ($chart3 as $elem) {

    $etiquetas3 .= ', "' . $elem["semana"] . '"';
    $valores3 .=', ' . $elem["num"];
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
        var myLineChart2 = new Chart(ctx).Line(data2);
        
        //Gráfica 2----------------------------------------------------
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

        var canvas3 = document.getElementById("myChart3");
        canvas3.width = $("#myChart3").width() - 50;
        canvas3.height = 200;

        var ctx = document.getElementById("myChart3").getContext("2d");
        var myLineChart3 = new Chart(ctx).Line(data3);

    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
