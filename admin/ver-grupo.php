<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->getGrupo();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-group"></span> <?php echo $variables["grupo"]->nombre; ?>
    </h2>
    <hr>
    <div class="col-9">
        <p><a id="eliminar" class="boton" href="#">Eliminar grupo</a> <a id="mensaje" class="boton" href="#">Enviar mensaje al administrador</a></p>
        <h3>Miembros</h3>
        <div id="conversaciones-recientes">
            <div>
                <?php
                if (isset($variables['miembros'])) {
                    foreach ($variables['miembros'] as $m) {
                        echo "<div class='picture fila'>
                          <p>
                          <img src='../img/usuarios/perfil/" . $m->avatar . "' class='profile-img'>
                          </p>
                          <h4><a href='usuarios-detalles.php?id=" . $m->id . "'>" . $m->nick . "</a></h4>
                          </div>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="clear"></div>

        <div>
            <h3>Aportaciones</h3>
            <div>
                <?php foreach ($variables["aportaciones"] as $ap): ?>
                    <div class="fila">
                        <p>
                            <span class="col-9">
                                <span class="fa fa-file-text-o"></span>
                                <strong><a href="ver-apunte.php?id=<?php echo $ap->id ?>"><?php echo $ap->titulo ?></a></strong>
                            </span>
                            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> <?php echo $ap->likes ?></span>
                            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> <?php echo $ap->dislikes ?></span>
                            <span class="col-1"><span class="fa fa-eye"></span> <?php echo $ap->visualizaciones ?></span>

                        </p>
                        <div class="clear"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="comentarios-apuntes">
            <h3>
                <br>Comentarios
            </h3>
            <?php
            foreach ($variables['comentarios'] as $c) {
                $autor = $c->usuario->nick;
                echo "<div class='fila'>
                        <h3>" . $c->titulo . "<small> [ " . $autor . " - " . date("d/m/Y", strtotime($c->fecha)) . " ] </small></h3>
                            <p>" . $c->texto . "</p>
                  </div>";
            }
            ?>
        </div>
    </div>
    <div class="col-3">
        <h4 class="text-center"><strong>Miembros que mas apuntes han compartido en este grupo</strong></h4>
        <canvas id="myChart1"></canvas>
        <hr>
        <h4 class="text-center"><strong>Apuntes mejor valorados del grupo</strong></h4>
        <canvas id="myChart2"></canvas>
    </div>
</div>

<script>

    $(document).on("ready", function() {
        
        <?php
$chart1 = $variables["chart1"];
$primer_elem = array_shift($chart1);
//$miembros = $variables['miembros'];

$etiquetas1 = '"' . $primer_elem["nick"] . '"';
$valores1 = $primer_elem["num"];

foreach ($chart1 as $elem) {

    $etiquetas1 .= ', "' . $elem["nick"] . '"';
    $valores1 .=  ', ' . $elem["num"];
}

$chart2 = $variables["chart2"];
$primer_elemento = array_shift($chart2);
$aportes = $variables["aportaciones"];

$etiquetas2 = '"' . $aportes[$primer_elemento["apId"]]->titulo . '"';
$valores2 = $primer_elemento["puntuacion"];

foreach ($chart2 as $elem) {

    $etiquetas2 .= ', "' . $aportes[$elem["apId"]]->titulo . '"';
    $valores2 .=', ' . $elem["puntuacion"];
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
        var myLineChart2 = new Chart(ctx).Bar(data1);

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
        var myLineChart2 = new Chart(ctx).Bar(data2);//,{scaleBeginAtZero : false});

        $("#eliminar").on("click", function() {
            var r = confirm("¿Está seguro?");
            if (r == true) {
                window.location = "../servicios/adminHandler.php?action=removeGrupo&id=<?php echo $variables['grupo']->id; ?>";
            }
        });

        $("#mensaje").on("click", function() {
            window.location = "../servicios/adminHandler.php?action=sendToAdmin&id=<?php echo $variables['grupo']->id; ?>";
        });
    });

</script>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
