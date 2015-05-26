<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<h2>
    <span class="fa fa-edit"></span> Redactar apuntes:
</h2>
<hr>
<div class="alerta-exito fila">
    <p>Apuntes creados con éxito. Ahora puede empezar a redactarlos.</p>
</div>  
<div id="head-apunte">
    <span class="col-10">
        <a href="#">[Universidad]</a> / 
        <a href="#">[Carrera]</a> /
        <a href="#">[Asignatura]</a>
    </span><span class="col-2"><a href="ver-apunte-propio.php"><span class="fa fa-floppy-o"></span> Guardar</a></span>
    <div class="clear"></div>
</div>
<div id="contenido-apunte">
    <textarea id="area-apunte" autofocus=""></textarea>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
