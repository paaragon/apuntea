<?php ob_start(); ?>
<div class="col-7">
    <img src="../img/no-user.jpg" class="img-responsive img-circle mini-logo">
    <h2 class ="col-11">
        <strong> Usuario 1 </strong>
    </h2>  
    <h2 class="col-1"><span class="fa fa-trash"></span></h2>
    <div class="clear"></div>
   
    
    <section>
    <h2><i class="fa fa-info-circle"></i> Info</h2>
    <div class="col-md-11">
        <ul class="list-group">
            <li class="list-group-item"><strong>Nombre completo:</strong> [Nombre completo]</li>
            <li class="list-group-item"><strong>Edad:</strong> [Edad]</li>
            <li class="list-group-item"><strong>Universidad:</strong> [Nombre universidad]</li>
            <li class="list-group-item"><strong>Carrera:</strong> [Nombre carrera]</li>
        </ul>
    </div>
    </section>
    
    <section>
        <div>
            <p>
                <a href="usuarios-datalles.php" class="boton boton-activo">Apuntes</a>
                <a href="#" class="boton">Grupos</a>
                <a href="usuarios-detalles-amigos.php" class="boton">Amigos</a>
            </p>
        </div>
        <div class="col-md-11">
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-lock"></span>
                        <strong><a href="ver-grupo.php"> Grupo Bachillerato</a></strong>
                    </span>
                    <span class="col-1"><a class=boton:hover> Moderar</a></span>
                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-globe"></span>
                        <strong><a href="ver-grupo.php"> Grupo Biblioteca</a></strong>
                    </span>
                    <span class="col-1"><a class=boton:hover> Moderar</a></span>

                </p>
                <div class="clear"></div>
            </div>
            <div class="fila">
                <p>
                    <span class="col-7">
                        <span class="fa fa-lock"></span>
                        <strong><a href="ver-grupo.php"> Grupo Universidad</a></strong>
                    </span>
                    <span class="col-1"><a class=boton:hover> Moderar</a></span>

                </p>
                <div class="clear"></div>
            </div>
        </div>
    </section>
</div>

<div class="col-4">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
    
   
</div>

<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";