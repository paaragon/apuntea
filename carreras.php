<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->carreras();

ob_start();
?>
<section>
    <h1>Carreras</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Carreras</li>
</ul>
<hr>
<form action="carreras.php" method="post">
    <input type="text" class="campo-formulario" placeholder="Buscar carrera..." id="consulta">
    <label>Universidad: </label>
    <select class="campo-formulario campo-en-linea" name="universidad" id="universidad">
        <option value="">Todas</option>
        <?php foreach ($variables["universidades"] as $uni): ?>
            <option value="<?php echo $uni->siglas ?>"><?php echo $uni->siglas ?></option>
        <?php endforeach; ?>
    </select>
</form>
<section>
    <?php if (count($variables["universidades"]) > 0): ?>
        <?php
        $i = 0;
        echo '<div class="rama-conocimiento">';
        echo "<h2><span class='fa " . $variables['ramas'][current($variables["carreras"])->rama] . "'></span>" . current($variables["carreras"])->rama . "</h2>";
        echo '<hr>';
        echo '<ul>';
        $rama = current($variables["carreras"])->rama;

        foreach ($variables["carreras"] as $carrera) {
            if ($carrera->rama != $rama) {
                $i++;
                echo "</ul>";
                echo "</div>";
                echo '<div class="rama-conocimiento">';
                echo "<h2><span class='fa " . $variables['ramas'][$carrera->rama] . "'></span>" . $carrera->rama . "</h2>";
                echo '<hr>';
                echo '<ul>';
                $rama = $carrera->rama;
            }
            echo '<li class="carrera"><a class="universidad" href="universidad.php?id=' . $carrera->universidad_id . '">' . $carrera->universidad->siglas . '</a> / <a class="car" href="carrera.php?id=' . $carrera->id . '">' . $carrera->nombre . '</a></li>';
        }
        echo "</ul>";
        echo "</div>";
        ?>
    <?php else: ?>
        <blockquote><h3>No hay carreras.</h3></blockquote>
    <?php endif; ?>
</section>
<script>
    $(document).on("ready", function () {

        $("#universidad").on("change", function () {
            buscar();
        });

        $("#consulta").on("keyup", function () {
            buscar();
        });
    });

    function buscar() {

        universidad = $("#universidad").val();
        consulta = $("#consulta").val();

        $(".carrera").each(function () {
            var uni = $(this).children(".universidad").text();
            var con = $(this).children(".car").text();

            if ((universidad.indexOf(uni) !== -1 || universidad === "") && (quitaAcentos(con.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) > -1)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
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
require "common/std/layout.php";
