<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
<div class="col-9">
    <h2>
        <span class="fa fa-users"></span> Grupos
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
    </div>
    <div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-circle-o-notch"></span>
                        <strong> Grupo Bachillerato</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 137</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo-admin.php">
                        <span class="fa fa-globe"></span>
                        <strong> Grupo Biblioteca (Administrador)</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 115</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-lock"></span>
                        <strong> Grupo Universidad</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 178</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo-admin.php">
                        <span class="fa fa-circle-o-notch"></span>
                        <strong> Grupo Clase 1ºB (Administrador)</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 68</span>
            </p>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <p>
                <span class="col-8">
                    <a href="ver-grupo.php">
                        <span class="fa fa-globe"></span>
                        <strong> Grupo Grado en Ingenieria Informatica</strong>
                    </a>
                </span>
                <span class="col-4"><span class="fa fa-users"></span> 238</span>
            </p>
            <div class="clear"></div>
        </div>
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
