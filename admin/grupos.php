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
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>

<script>
    $(document).on("ready", function () {

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
