<?php 

session_start();

require __DIR__ . "/../controladores/ControladorAdmin.php";

$controlador = new ControladorAdmin();


$controlador = new ControladorAdmin();

$carrera = (isset($_GET["carrera"])) ? filter_input(INPUT_GET, "carrera", FILTER_SANITIZE_NUMBER_INT) : "";

$variables = $controlador->asignatura($carrera);

ob_start(); 

?>
<div class="col-9">

     <h2>
        <span class="fa fa-file-text-o"></span> Asignaturas
    </h2>
    <hr>
    <p>
        <a href="asignaturas-nuevas.php" class="boton">Añadir asignatura</a>
    </p>
    <form action="asignaturas.php" method="post">
        <label>Nombre:</label>
        <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario">
        <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
        <select class="campo-formulario">
            <option value="Informatica">Informatica</option>
            <option value="Derecho">Derecho</option>
            <option value="Medicina">Medicina</option>
            <option value="Chuletas">Chuletas</option>
        </select>
        <label><span class="fa fa-university"></span> Universidad:</label>
        <select class="campo-formulario">
            <option value="UCM">UCM</option>
            <option value="UPM">UPM</option>
            <option value="URJC">URJC</option>
            <option value="UAM">UAM</option>
        </select>
    </form>
    <h3>Listado de asginaturas</h3>
    
     <?php foreach ($variables["asignaturas"] as $asignatura): ?>
        <div class="fila">
            <p>
                <span class="col-10">
                    <strong><a href="asignatura.php?id=<?php echo $asignatura->id ?>"><?php echo $asignatura->nombre ?></a> <small>/ <a href="perfil-carrera.php?id=<?php echo $asignatura->carrera->id ?>"><?php echo $asignatura->carrera->nombre ?></a></small></strong>
                </span>
                <span class="col-1"><span class="fa fa-file"></span> <strong>13</strong></span>
                <span class="col-1 minus-color"><a href="../servicios/adminHandler.php?action=borrarAsignatura&idAsignatura=<?php echo $asignatura->id ?>"><span class="fa fa-trash"></span></a></span>
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


       
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

