<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-file-text-o"></span> Apuntes subidos por los usuarios
    </h2>
    <hr>
    <div class="fila">
        <form action="apuntes.php" method="post">
            <label>Nombre:</label> <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario">
            <label><span class="fa fa-university"></span> Universidad:</label>
            <select class="campo-formulario campo-en-linea">
                <option value="UCM">UCM</option>
                <option value="UPM">UPM</option>
                <option value="URJC">URJC</option>
                <option value="UAM">UAM</option>
            </select>
            <label><span class="fa fa-graduation-cap"></span> Carrera:</label>
            <select class="campo-formulario campo-en-linea">
                <option value="Informatica">Informatica</option>
                <option value="Derecho">Derecho</option>
                <option value="Medicina">Medicina</option>
                <option value="Chuletas">Chuletas</option>
            </select>
            <input type="submit" class="campo-formulario" value="Buscar">
        </form>
    </div >
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>  
    <div class="fila">
        <p>
            <span class="col-8">
                <span class="fa fa-file-text-o"></span>
                <label><a href="ver-apunte.php">Tema 1</a></label>
            </span>

            <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-1"><span class="fa fa-eye"></span> 999</span>

            <span class="col-1"><a href="apuntes.php"><span class="fa fa-trash-o"></span></a></span>
        </p>
        <div class="clear"></div>
    </div>
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

