<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();
$variables = $controlador->carrera();

ob_start();
?>
<section>
    <h1><?php echo $variables["carrera"]->nombre ?></h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="universidad.php?id=<?php echo $variables["carrera"]->universidad_id ?>"><?php echo $variables["carrera"]->universidad->siglas ?></a></li>
    <li><?php echo $variables["carrera"]->nombre ?></li>
</ul>
<hr>
<form action="carrera.php" method="post">
    <input class="campo-formulario" name="buscar" type="text" placeholder="Buscar asignatura..." id="buscar">
</form>
<section>
    <?php if (count($variables["asignaturas"]) > 0): ?>
        <?php
        $i = array_values($variables["asignaturas"])[0]->curso;
        echo '<div>';
        echo "<h2>" . $i . "º Curso</h2>";
        echo '<hr>';
        echo '<ul>';
        $curso = $i;

        foreach ($variables["asignaturas"] as $asignatura) {
            if ($asignatura->curso != $curso) {
                $i++;
                echo "</ul>";
                echo "</div>";
                echo '<div>';
                echo "<h2><h2>" . $i . "º Curso</h2>";
                echo '<hr>';
                echo '<ul>';
                $curso = $i;
            }
            echo '<li class="asignatura"><a href="asignatura.php?id=' . $asignatura->id . '">' . $asignatura->nombre . '</a></li>';
        }
        echo "</ul>";
        echo "</div>";
        ?>
    <?php else: ?>
        <blockquote>Esta carrera todavía no tiene ninguna asignatura</blockquote>
    <?php endif; ?>
</section>
<script>
    $(document).on("ready", function () {

        $("#buscar").on("keyup", function (ev) {
            ev.preventDefault();

            var consulta = $(this).val();

            $(".asignatura").each(function () {
                if (quitaAcentos($(this).text().toLowerCase()).indexOf(quitaAcentos(consulta.toLowerCase())) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

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
