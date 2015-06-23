<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$variables = $controlador->universidades();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-university"></span> Universidades
    </h2>
    <hr>
    <div>
        <p>
            <a href="universidad-nueva.php" class="boton">Añadir nueva</a>
        </p>
        <div class="clear"></div>
    </div>
    <?php
    if (count($variables["universidades"]) > 0):
        foreach ($variables["universidades"] as $universidad):
            ?>
            <div class="fila">
                <p>
                    <span class="col-8">
                        <strong><a href="perfil-universidad.php?id=<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></a></strong>
                    </span>
                    <span class="col-2"><span class="fa fa-file"></span> <strong><?php echo $variables['uniapun'][$universidad->id] ?></strong></span>
                    <span class="col-2"><a href="../servicios/adminHandler.php?action=borrarUniversidad&idUniversidad=<?php echo $universidad->id ?>"><span class="fa fa-trash"></span></a></span>
                </p>
                <div class="clear"></div>
            </div>
            <?php
        endforeach;
    else:
        echo "<blockquote><h3>No hay universidades disponibles</h3></blockquote>";
    endif;
    ?>
</div>

<div class="col-3">
    <canvas id="myChart1"></canvas>
    <h4 class="text-center"><strong>Universidades / apuntes (%)</strong></h4>
    <canvas id="myChart2"></canvas>
    <h4 class="text-center"><strong>Universidades / usuarios (%)</strong></h4>
</div>
<div class="clear"></div>
<script>
    $(document).on("ready", function () {

        //Gráfica 1----------------------------------------------------
        var data1 = [<?php echo $variables["chart1"]["data"] ?>]

        var ctx = document.getElementById("myChart1").getContext("2d");
        var myLineChart1 = new Chart(ctx).Pie(data1);
        
        //Gráfica 2
        var data2 = [<?php echo $variables["chart2"]["data"] ?>]

        var ctx = document.getElementById("myChart2").getContext("2d");
        var myLineChart1 = new Chart(ctx).Pie(data2);
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
