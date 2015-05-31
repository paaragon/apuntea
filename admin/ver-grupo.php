<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
//$variables = $controlador->anadirCarrera();
$variables = $controlador->getGrupo();//isset($_POST['idGrupo'])...??

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-group"></span> <?php echo $variables["grupo"]->nombre; ?>
    </h2>
    <hr>
    <p><a class="boton" href="grupos.php">Eliminar grupo</a> <a class="boton" href="mensajes.php">Enviar mensaje al administrador</a></p>
    <h3>Miembros</h3>
    <div id="conversaciones-recientes">
        <div>
            <?php
                foreach ($variables['miembros'] as $m) {
                    echo  "<div class='picture fila'>
                          <p>
                          <img src='../img/usuarios/perfil/" . $m->avatar . "' class='img-responsive'>
                          </p>
                          <h4><a href='usuarios-detalles.php'>" . $m->nick . "</a></h4>
                          </div>";
                }
            ?>
        </div>
    </div>
    <div class="clear"></div>

    <div>
        <h3>
            <br>Aportaciones
        </h3>
        <div>
            
            
            <?php
               /* foreach ($variables['comentarios'] as $c) {
                    
                    echo "<div class='fila'>
                            <p>
                                <span class='col-9'>
                                    <span class='fa fa-file-text-o'></span>
                                    <strong><a href='ver-apunte.php'>Tema 1</a></strong>
                                </span>
                                <span class='col-1'><span class='fa fa-thumbs-o-up'></span> 20</span>
                                <span class='col-1'><span class='fa fa-thumbs-o-down'></span> 2</span>
                                <span class='col-1'><span class='fa fa-eye'></span> 999</span>
                            </p>
                            <div class='clear'></div>
                          </div>";
                    
                    
                    
                }*/
            ?>
            
            
            
            
            
            
        </div>
    </div>
    <div id="comentarios-apuntes">
        
        <?php
                foreach ($variables['comentarios'] as $c) {
                    echo "<div class='fila'>
                        <h3>" . $c->titulo . " - " . $c->fecha . "</small></h3>
                        <p>
                            " . $c->texto . "
                        </p>
                    </div>";
                    
                    
                }
                    
                    
            ?>
        
        
        
        
    </div>  
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";
