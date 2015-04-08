<?php ob_start(); ?>

<div class="col-9">
    <div class="col-4" id="gente">
        <div class="fila">
            <p>
                <span>
                   <img src="../img/carnet.PNG"  id="foto-user">
                   <a href="#" class="fa fa-envelope-square">  Pepe </a>  
                </span>
            </p>
            <hr>
            <p>
                <span>
                  <img src="../img/carnet.PNG"  id="foto-user">
                  <a href="#" class="fa fa-envelope-square"> Juan </a>  
                </span>
            </p>
             <hr>
            <p>
                <span>
                  <img src="../img/carnet.PNG"  id="foto-user">
                  <a href="#" class="fa fa-envelope-square"> Antonio </a>   
                </span>
            </p>
             <hr>
            <p>
                <span>
                  <img src="../img/carnet.PNG"  id="foto-user">
                  <a href="#"  class="fa fa-envelope-square"> Jose </a>  
                </span>
            </p>
             <hr>
            <p>
                <img src="../img/carnet.PNG"  id="foto-user">
                <a href="#" class="fa fa-envelope-square"> Pablo </a>  
                </span>
            </p>
        </div>
      
    </div>
    <div class="col-7" id="hilo-msg">
    
        <div class="fila">
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <hr>
            <p>
                <span>Mensaje de prueba 1</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <hr>
            <p>
                <span>Mensaje de prueba 2</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <hr>
            <p>
                <span>Mensaje de prueba 3</span>
            
            </p>
            <hr>
            <h3>
                <span>Mensaje de prueba de: <strong>Pepe</strong></span>
            </h3>
            <hr>
            <p>
                <span>Mensaje de prueba 4</span>
            
            </p>
            <hr>
            <div id="msg-container">
                <h3> Crear mensaje nuevo</h3>
                <hr>
                <input type="text" name="mensaje" value="" />
                
                
                
            </div>
        </div>
    </div>    
    
</div>

<div class="col-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";