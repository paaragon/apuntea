<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();

$universidad = (isset($_GET["universidad"])) ? filter_input(INPUT_GET, "universidad", FILTER_SANITIZE_NUMBER_INT) : "";

$variables = $controlador->carreras($universidad);

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-graduation-cap"></span> Carreras
    </h2>
    <hr>
    <div>
        <div class="col-10">
            <label> Universidad:</label> 
            <select class="campo-formulario campo-en-linea" id="universidad-select">
                <option value="todas" selected="">Todas</option>
                <?php foreach ($variables["universidades"] as $universidad): ?>
                    <option value="<?php echo $universidad->id ?>"><?php echo $universidad->siglas ?></option>
                <?php endforeach; ?>
            </select>
            <!-- aqui hay que añadir que si vuelve a ser todas las vuelva a poner-->

        </div>
        <div>
            <a href="anadir-carrera.php" class="boton">Añadir carrera</a>
        </div>
        <div class="clear"></div>
    </div>
    <?php foreach ($variables["carreras"] as $carrera):
        ?>
        <div class="fila">
            <p>
                <span class="col-9">
                    <strong><a href="perfil-carrera.php?id=<?php echo $carrera->id ?>"><?php echo $carrera->nombre ?></a> <small>/
                            <a href="perfil-universidad.php?id=<?php echo $carrera->universidad->id ?>"><?php echo $carrera->universidad->siglas ?></a></small></strong>
                </span>
                <span class="col-1"><span class="fa fa-user"></span><strong><?php echo count($carrera->ownUsuarioList) ?></strong></span>
                <span class="col-1"><span class="fa fa-file"></span> <strong><?php if (isset($variables['carapuntes'][$carrera->id])) echo $variables['carapuntes'][$carrera->id] ?></strong></span>
                <span class="col-1"><span id="f<?php echo $carrera->id.'-'.$carrera->nombre; ?>" class="fa fa-trash"></span></span>
            </p> 
            <div class="clear"></div>
        </div>
    <?php endforeach; ?>
</div>
<div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
</div>
<div class="clear"></div>
<script>
    $(document).ready(function () {
        $("#universidad-select").on("change", function () {
            window.location = "carreras.php?universidad=" + $(this).val();
        });
        
    $('.fa-trash').on("click", function () {
        
            id = $(this).attr("id").substring(1).split('-');  
            
            var r = confirm("Seguro que quieres borrar esta carrera " + id[1] +'?');
            if (r == true) {
               
                $.post('../servicios/adminHandler.php?action=borrarCarrera', {id: id[0]}, function (data) {
                    alert(data);
                });
            }
        });
    });
</script>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
