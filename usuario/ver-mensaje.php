<?php ob_start(); ?>

<div class="col-9">
    <div class="col-4" id="gente">
        <div class="fila">
            <p>
                <span>
                <img src="../img/carnet.PNG"  id="foto-user">  
                <hr>
                <a href="#"> Pepe</a>
                </span>
            </p>
          
        </div>
      
    </div>
    <div class="col-7">
    
        <div class="fila">
            <h3>
                <span>
                    Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <p> Recibido el 2/02/02 a las 22:00</p>
            <hr>
            <p>
                <span>Mensaje de prueba 1</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <p> Recibido el 2/02/02 a las 22:00</p>
            <hr>
            <p>
                <span>Mensaje de prueba 2</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <p> Recibido el 2/02/02 a las 22:00</p>
            <hr>
            <p>
                <span>Mensaje de prueba 3</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <p> Recibido el 2/02/02 a las 22:00</p>
            <hr>
            <p>
                <span>Mensaje de prueba 4</span>
            
            </p>
            
        </div>
    </div>
    
</div>


<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
