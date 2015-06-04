<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->listaApuntes();

ob_start();
?>
<section id="presentacion">
    <h1>Apuntes</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Apuntes</li>
</ul>
<hr>
<div id="form">
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
        <option value="-">Todas</option>
    </select>
    <label>Asignatura: </label>
    <select id="selectAsignatura" class="campo-formulario campo-en-linea">
        <option value="">Todas</option>
    </select>
</div>
<section>

    <?php
    $i = 0;
    echo '<div class="rama-conocimiento">';
    echo "<h2><span class='fa " . $variables['ramas'][array_values($variables["apuntes"])[0]->asignatura->carrera->rama] . "'></span> " . array_values($variables["apuntes"])[0]->asignatura->carrera->rama . "</h2>";
    echo '<hr>';
    echo '<ul>';
    $rama = array_values($variables["apuntes"])[0]->asignatura->carrera->rama;

    foreach ($variables["apuntes"] as $apunte) {
        if ($apunte->asignatura->carrera->rama != $rama) {
            echo "</ul>";
            echo "</div>";
            echo '<div class="rama-conocimiento">';
            echo "<h2><span class='fa " . $variables['ramas'][$apunte->asignatura->carrera->rama] . "'></span>" . $asignatura->carrera->rama . "</h2>";
            echo '<hr>';
            echo '<ul>';
            $rama = $apunte->asignatura->carrera->rama;
        }
        echo '<li class="apunte"><a href="apuntes.php?id=' . $apunte->id . '" class="nombre">' . $apunte->titulo . '</a> - <a href="asignatura.php?id=' . $apunte->asignatura->id . '" class="asignatura">' . $apunte->asignatura->nombre . '</a> / <a href="carrera.php?id=' . $apunte->asignatura->carrera->id . '" class="carrera">' . $apunte->asignatura->carrera->nombre . '</a> / <a href="universidad.php?id=' . $apunte->asignatura->carrera->universidad->id . '" class="universidad">' . $apunte->asignatura->carrera->universidad->siglas . '</a></li>';
    }
    echo "</ul>";
    echo "</div>";
    ?>
</section>
<script>
    $(document).on("ready", function () {

        $("#selectUniversidad").on("change", function () {
            getCarreras($("#selectUniversidad").val().split("-")[0]);
        });

        $("#selectCarrera").on("change", function () {
            getAsignaturas($("#selectCarrera").val().split("-")[0]);
        });

        $("#selectUniversidad").on("change", function () {
            buscar();
        });

        $("#form").on("change", "#selectCarrera", function () {
            buscar();
        });

        $("#form").on("change", "#selectAsignatura", function () {
            buscar();
        });

        $("#consulta").on("keyup", function () {
            buscar();
        });
    });
    function getCarreras(id) {
        $("#selectCarrera").html("");
        $("#selectCarrera").append('<option value="-">Todas</option>');
        $.post("servicios/standarHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                $("#selectCarrera").append("<option value='" + data[i]["id"] + "-" + data[i]["nombre"] + "'>" + data[i]["nombre"] + "</option>");
            }
        }, "json");
    }

    function getAsignaturas(id) {
        $("#selectAsignatura").html("");
        $("#selectAsignatura").append('<option value="">Todas</option>');
        $.post("servicios/standarHandler.php?action=getAsignaturas", {idCarrera: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                $("#selectAsignatura").append("<option value='" + data[i]["id"] + "-" + data[i]["nombre"] + "'>" + data[i]["nombre"] + "</option>");
            }
        }, "json");
    }

    function buscar() {
        universidad = $("#selectUniversidad").val().split("-")[1];
        carrera = $("#selectCarrera").val().split("-")[1];
        asignatura = $("#selectAsignatura").val();
        consulta = $("#consulta").val();

        $(".apunte").each(function () {
            var uni = $(this).children(".universidad").text();
            var car = $(this).children(".carrera").text();
            var asi = $(this).children(".asignatura").text();
            var con = $(this).children(".nombre").text();
            
            if ((universidad.indexOf(uni) !== -1 || universidad === "") && (carrera.indexOf(car) !== -1 || carrera === "") && (asignatura.indexOf(asi) !== -1 || asignatura === "") && (quitaAcentos(con.toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) > -1)) {
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
