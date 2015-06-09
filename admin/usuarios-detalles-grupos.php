<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->usuario();

ob_start();
if (isset($variables["usuario"])):
    $usuario = $variables["usuario"];
    $carrera = $variables["carrera"];
    $universidad = $variables["universidad"];
    ?>
    <div class="col-9" id="principal">
        <div class="fila profile">
            <!--Div para el fondo del perfil-->
            <div id="fondo"><img src="../img/usuarios/portada/<?php echo $usuario->imagenportada ?>"/></div>
            <!--Div para el avatar del perfil-->
            <div id="avatar"><img src="../img/usuarios/perfil/<?php echo $usuario->avatar ?>"/></div>
            <ul id="actividad">
                <li id="actividad-1">
                    <span><?php echo count($usuario->alias('alice')->ownContactoList) + count($usuario->alias('bob')->ownContactoList) ?> </span>
                    <small>Amigos</small>
                </li>
                <li id="actividad-2">
                    <span><?php echo count($variables["apuntes"]) ?> </span>
                    <small>Apuntes</small>
                </li>
            </ul>
        </div>
        <div class="description">
            <h2 class="col-9"><?php echo $usuario->nombre . " " . $usuario->apellidos ?></h2>
            <div class="clear"></div>
            <hr>
            <blockquote>
                <p> 
                    <?php echo $usuario->estado ?>
                </p>
            </blockquote>
        </div><br>
        <div>
            <div class="clear"></div>
            <section>
                <h2><i class="fa fa-info-circle"></i> Info</h2>
                <div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nombre completo:</strong> <?php echo $usuario->nombre . " " . $usuario->apellidos ?></li>
                        <li class="list-group-item"><strong>Universidad:</strong> <?php echo $universidad->nombre ?></li>
                        <li class="list-group-item"><strong>Carrera:</strong> <?php echo $carrera->nombre ?> </li>
                    </ul>
                </div>
            </section>

            <section>
                <div>
                    <p>
                        <a href="usuarios-detalles.php?id=<?php echo $usuario->id ?>" class="boton">Apuntes</a>
                        <a href="usuarios-detalles-grupos.php?id=<?php echo $usuario->id ?>" class="boton boton-activo">Grupos</a>
                        <a href="usuarios-detalles-amigos.php?id=<?php echo $usuario->id ?>" class="boton">Amigos</a>
                    </p>
                </div>
                <div>
                    <?php if (isset($variables["grupos"])): ?>
                        <?php foreach ($variables["grupos"] as $grupo): ?>
                            <div class="fila">
                                <p>
                                    <span class="col-7">
                                        <span class="fa fa-lock"></span>
                                        <strong><a href="ver-grupo.php?id=<?php echo $grupo->id ?>"> <?php echo $grupo->nombre ?></a></strong>
                                    </span>
                                </p>
                                <div class="clear"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <blockquote>Este usuario no pertenece a ningún grupo.</blockquote>
                    <?php endif; ?>
                </div>
            </section>
            <div class="fila">
                <h3>Opciones de administrador:</h3>
                <p>
                    <a href="mensajes.php?id=<?php echo $usuario->id ?>" class="boton campo-formulario">Enviar mensaje al usuario</a>
                    <a href="../servicios/adminHandler.php?action=borrarUsuario&idUsuario=<?php echo $usuario->id ?>" class="boton campo-formulario">Eliminar usuario</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-3">
        <h4 class="text-center"><strong>Nº apuntes subidos en los 2 últimos meses</strong></h4>
        <canvas id="myChart1"></canvas>
        <hr>
        <h4 class="text-center"><strong>Apuntes más populares</strong></h4>
        <canvas id="myChart2"></canvas
    </div>

    <script>
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

    $etiquetas2 = '"' . $primer_elemento["titulo"] . '"';
    $valores2 = $primer_elemento["likes"];

    foreach ($chart2 as $elem) {

        $etiquetas2 .= ', "' . $elem["titulo"] . '"';
        $valores2 .=', ' . $elem["likes"];
    }
    ?>


        var canvas1 = document.getElementById("myChart1");

        canvas1.width = $("#myChart1").width() - 50;
        canvas1.height = 200;

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
        var myLineChart1 = new Chart(ctx).Line(data1);

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
    </script>
<?php else: ?>
    <blockquote><h3>Usuario no encontrado.</h3></blockquote>
<?php endif; ?>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
