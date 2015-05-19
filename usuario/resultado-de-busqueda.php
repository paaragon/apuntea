<?php

require __DIR__ . "/../controladores/ControladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->resultadoBusqueda();

ob_start();
?>
<section>
    <h1><span class="fa fa-search"></span> Resultado de búsqueda:</h1>
</section>
<section>
    <div class="alerta-info fila">
        <p><strong>Resultados de: </strong><?php echo $variables["busqueda"]?></p>
    </div>
    
    <div class="fila">
    <h3>Resultados de apuntes: </h3>
    <?php foreach ($variables["apuntes"] as $apunte) { ?>
        <div class="fila">
            <p>
                <span class="col-6">
                    <span class="fa fa-file-text"></span>
                    <a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><?php echo $apunte["titulo"] ?></a>
                   
                </span>
                <span class="col-3">
                    <a href="universidad.php?id=<?php echo $apunte->asignatura->carrera->universidad_id ?>">
                        <span class="fa fa-university"></span><?php echo $apunte->asignatura->carrera->universidad->siglas ?>
                    </a>
                </span>
                <span class="col-3">
                    <a href="carrera.php?id=<?php echo $apunte->asignatura->carrera->id ?>">
                        <span class="fa fa-graduation-cap"></span> <?php echo $apunte->asignatura->carrera->nombre ?>
                    </a>
                </span>
            </p>
            <div class="clear"></div>
        </div>
    <?php } ?>
    </div> 
    
         
    
    <div class="fila">
    <h3>Resultados de usuarios: </h3>
     <?php foreach ($variables["usuarios"] as $usuario) { ?>
        <div class="fila">
            <p>
                <span class="col-6">
                    <span class="fa fa-user"></span>
                    <a href="perfil-usuario.php?id=<?php echo $usuario->id ?>"><?php echo $usuario["nick"] ?></a>
                   
                </span>
                <span class="col-3"><a href="universidad.php?id=<?php echo $usuario->carrera->universidad->universidad_id ?>"><span class="fa fa-university"></span><?php echo $usuario->carrera->universidad->siglas ?></a></span>
                <span class="col-3"><a href="carrera.php?id=<?php echo $usuario->carrera->id ?>"><span class="fa fa-graduation-cap"></span><?php echo $usuario->carrera->nombre ?></a></span>
            </p>
            <div class="clear"></div>
        </div>
    <?php } ?>
    </div>   
    
    <div class="fila">
    <h3>Resultados de universidades: </h3>
    <?php foreach ($variables["universidades"] as $universidad) { ?>
        <div class="fila">
            <p>
                <span class="col-6">
                    <span class="fa fa-university"></span>
                    <a href="universidad.php?id=<?php echo $universidad->id ?>"><?php echo $universidad["siglas"] ?></a>
                   
                </span>
                 <span class="col-3" title="alumnos">
                     <span class="fa fa-users"></span> 
                     <span class="distintivo"><?php  if( isset($variables['unialum'][$universidad->id])) echo $variables['unialum'][$universidad->id]?></span>
                </span>
                <span class="col-3" title="apuntes">
                    <span class="fa fa-file"></span> 
                    <span class="distintivo"><?php if( isset($variables['uniapun'][$universidad->id])) echo $variables['uniapun'][$universidad->id]?></span>
                </span>
            </p>
            <div class="clear"></div>
        </div>
    <?php } ?>
    </div> 
    
    
   <div class="fila">
    <h3>Resultados de carreras: </h3>
     <?php foreach ($variables["carreras"] as $carrera) { ?>
        <div class="fila">
            <p>
                <span class="col-6">
                    <span class="fa fa-graduation-cap"></span>
                    <a href="carrera.php?id=<?php echo $carrera->id ?>"><?php echo $carrera["nombre"] ?></a>
                   
                </span>
               
                <span class="col-2"><span class="fa fa-users"></span> <span class="distintivo"> <?php echo count($carrera->ownUsuarioList) ?></span></span>
                <span class="col-2"><span class="fa fa-file"></span> <span class="distintivo">
                    <?php if( isset($variables['carapuntes'][$carrera->id])) echo $variables['carapuntes'][$carrera->id] ?></span>
                </span>
                 <span class="col-2">
                    <span class="fa fa-university"></span>
                    <a href="universidad.php?id=<?php echo $carrera->universidad->id ?>"><?php echo $carrera->universidad["siglas"] ?></a>
                   
                </span>
                
            </p>
            <div class="clear"></div>
        </div>
    <?php } ?>
    </div>   
</section>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
