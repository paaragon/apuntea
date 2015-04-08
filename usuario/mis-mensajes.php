<?php ob_start(); ?>

<div class="col-9" id="principal">
    <div>
        <p>
            
            <a href="generar-mensaje.php" class="boton"><span class="fa fa-envelope-o"></span> Nuevo mensaje</a>
        </p>
    </div>
   
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            </p>
            <hr>
            <div class="clear"></div>
            
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div>
    
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            
            </p>
            <hr>
            <div class="clear"></div>
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div> 
    
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            
            </p>
            <hr>
            <div class="clear"></div>
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div> 
    
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            
            </p>
            <hr>
            <div class="clear"></div>
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div> 
    
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            
            </p>
            <hr>
            <div class="clear"></div>
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div> 
    
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <a href="ver-mensaje.php">Mensaje Recibido de:<strong> Pepe </strong></a>
            
            </p>
            <hr>
            <div class="clear"></div>
            <p id="resumen-mensaje"> <!--   añadir en css alinear a la izquierda esta etiqueta -->
                Pequeño resumen del texto del mensaje. 
            </p>
     
        </div>
 
</div>

<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";

