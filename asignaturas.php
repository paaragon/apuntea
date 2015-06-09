<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->asignaturas();

ob_start();
?>
<section>
    <h1>Asignaturas</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Asignaturas</li>
</ul>
<hr>
<form action="asignaturas.php" method="post" id="form">
    <input type="text" class="campo-formulario" id="consulta" placeholder="Asignatura...">
    <label>Universidad: </label>
    <select id="selectUniversidad" name="universidad" class="campo-formulario campo-en-linea">
        <option value="-">Todas</option>
        <?php foreach ($variables["universidades"] as $uni): ?>
            <option value="<?php echo $uni->id . '-' . $uni->siglas ?>"><?php echo $uni->siglas ?></option>
        <?php endforeach; ?>
    </select> 
    <label>Carrera: </label>
    <select id="selectCarrera" name="carrera" class="campo-formulario campo-en-linea">
        <option value="">Todas</option>
    </select>
</form>
<section>
    <?php if (count($variables["asignaturas"]) > 0): ?>
        <?php
        $i = 0;
        echo '<div class="rama-conocimiento">';
        echo "<h2><span class='fa " . $variables['ramas'][array_values($variables["asignaturas"])[0]->carrera->rama] . "'></span>" . array_values($variables["asignaturas"])[0]->carrera->rama . "</h2>";
        echo '<hr>';
        echo '<ul>';
        $rama = array_values($variables["asignaturas"])[0]->carrera->rama;

        foreach ($variables["asignaturas"] as $asignatura) {
            if ($asignatura->carrera->rama != $rama) {
                echo "</ul>";
                echo "</div>";
                echo '<div class="rama-conocimiento">';
                echo "<h2><span class='fa " . $variables['ramas'][$asignatura->carrera->rama] . "'></span>" . $asignatura->carrera->rama . "</h2>";
                echo '<hr>';
                echo '<ul>';
                $rama = $asignatura->carrera->rama;
            }
            echo '<li class="asignatura"><a href="asignatura.php?id=' . $asignatura->id . '" class="nombre">' . $asignatura->nombre . '</a> - <a href="carrera.php?id=' . $asignatura->carrera->id . '" class="carrera">' . $asignatura->carrera->nombre . '</a> / <a href="universidad.php?id=' . $asignatura->carrera->universidad->id . '" class="universidad">' . $asignatura->carrera->universidad->siglas . '</a></li>';
        }
        echo "</ul>";
        echo "</div>";
        ?>
    <?php else: ?>
        <blockquote><h3>No hay asignaturas.</h3></blockquote>
    <?php endif; ?>
</section>
<script>
    $(document).on("ready", function () {

        $("#selectUniversidad").on("change", function () {
            getCarreras($("#selectUniversidad").val().split("-")[0]);
        });

        $("#selectUniversidad").on("change", function () {
            buscar();
        });

        $("#form").on("change", "#selectCarrera", function () {
            buscar();
        });

        $("#consulta").on("keyup", function () {
            buscar();
        });
    });
    function getCarreras(id) {
        $("#selectCarrera").html("");
        $("#selectCarrera").append('<option value="">Todas</option>');
        $.post("servicios/standarHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                $("#selectCarrera").append("<option value='" + data[i]["nombre"] + "'>" + data[i]["nombre"] + "</option>");
            }
        }, "json");
    }

    function buscar() {
        universidad = $("#selectUniversidad").val().split("-")[1];
        carrera = $("#selectCarrera").val();
        consulta = $("#consulta").val();

        $(".asignatura").each(function () {
            var uni = $(this).children(".universidad").text();
            var car = $(this).children(".carrera").text();
            var con = $(this).children(".nombre").text();

            if ((universidad.indexOf(uni) !== -1 || universidad === "") && (carrera.indexOf(car) !== -1 || carrera === "") && (quitaAcentos(con.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) > -1)) {
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
