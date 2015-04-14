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
                <a href="usuarios-detalles.php" class="boton boton-activo">Apuntes</a>
                <a href="usuarios-detalles-grupos.php" class="boton">Grupos</a>
                <a href="#" class="boton">Amigos</a>
            </p>
        </div>
        <div class="col-md-11">
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Rodolfo langostino</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 13</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Sinchan42</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 7</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Chiquito</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 5</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Matutano-man</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> 101</span>            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-9">
                    <img class="col-1" src="../img/no-user.jpg" class="img-responsive mini-logo">
                    <strong><a href="usuarios-detalles.php"> Uno_que_pasaba_por_aqui</a></strong>
                </span>
                <span class="col-1"> UCM</span>
                <span class="col-2"><span class="fa fa-file"></span> -1</span>            </p>
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