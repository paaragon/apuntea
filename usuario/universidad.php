<?php
require "../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();
$variables = $controlador->universidad();

ob_start();
?>
<section>
    <h1><?php echo $variables["universidad"]->nombre ?></h1>
</section>
<ul class="breadcrumb">
    <li><a href="universidades.php">Universidades</a></li>
    <li><?php echo $variables["universidad"]->siglas ?></li>
</ul>
<hr>
<form action="universidad.php" method="post">
    <input type="text" class="campo-formulario" placeholder="Buscar..." id="buscar">
</form>
<section>
    <?php if (count($variables["carreras"]) > 0): ?>
        <?php
        $i = 0;
        echo '<div class="rama-conocimiento">';
        echo "<h2><span class='fa " . $variables['ramas'][$i][1] . "'></span>" . $variables['ramas'][$i][0] . "</h2>";
        echo '<hr>';
        echo '<ul>';
        $rama = $variables["ramas"][$i][0];

        foreach ($variables["carreras"] as $carrera) {
            if ($carrera->rama != $rama) {
                $i++;
                echo "</ul>";
                echo "</div>";
                echo '<div class="rama-conocimiento">';
                echo "<h2><span class='fa " . $variables['ramas'][$i][1] . "'></span>" . $carrera->rama . "</h2>";
                echo '<hr>';
                echo '<ul>';
                $rama = $carrera->rama;
            }
            echo '<li class="carrera"><a href="carrera.php?id=' . $carrera->id . '">' . $carrera->nombre . '</a></li>';
        }
        echo "</ul>";
        echo "</div>";
        ?>
    <?php else: ?>
        <blockquote>Esta universidad todavía no tiene ninguna carrera</blockquote>
    <?php endif; ?>
</section>
<script>
    $(document).on("ready", function () {

        $("#buscar").on("keyup", function (ev) {

            ev.preventDefault();

            var consulta = $(this).val();

            $(".carrera").each(function () {
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
require "../common/usuario/layout.php";
