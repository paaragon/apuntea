<?php
session_start();
require __DIR__ . "../controladores/controladorUsuario.php";

$controlador = new ControladorUsuario();

$variables = $controlador->resultadoBusqueda();

ob_start();
?>
<section>
    <h1><span class="fa fa-search"></span> Resultado de búsqueda:</h1>
</section>
<section>
    <div class="alerta-info fila">
        <p><strong>Resultados de:</strong> [Cadena de texto que se insertó en la búsqueda]</p>
    </div>
    <?php foreach ($variables["apuntes"] as $apunte) { ?>
        <div class="fila">
            <p>
                <span class="col-6">
                    <span class="fa fa-user"></span>
                    <a href="ver-apunte.php?id=<?php echo $apunte->id ?>"><?php echo $apunte->titulo ?></a>
                </span>
                <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
                <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
            </p>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-user"></span>
                <a href="perfil-usuario.php">[Ejemplo resultado usuario]</a>
            </span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-user"></span>
                <a href="perfil-usuario.php">[Ejemplo resultado usuario]</a>
            </span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-university"></span>
                <a href="universidad.php">[Ejemplo resultado universidad]</a>
            </span>
            <span class="col-3" title="alumnos"><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3" title="apuntes"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-graduation-cap"></span>
                <a href="carrera.php">[Ejemplo resultado carrera]</a>
            </span>
            <span class="col-3" title=""><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-graduation-cap"></span>
                <a href="carrera.php">[Ejemplo resultado carrera]</a>
            </span>
            <span class="col-3" title=""><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-user"></span>
                <a href="perfil-usuario.php">[Ejemplo resultado usuario]</a>
            </span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-file-text"></span>
                <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
            </span>

            <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-2"><span class="fa fa-eye"></span> 999</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-user"></span>
                <a href="perfil-usuario.php">[Ejemplo resultado usuario]</a>
            </span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-university"></span>
                <a href="universidad.php">[Ejemplo resultado universidad]</a>
            </span>
            <span class="col-3" title="alumnos"><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3" title="apuntes"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-graduation-cap"></span>
                <a href="carrera.php">[Ejemplo resultado carrera]</a>
            </span>
            <span class="col-3" title=""><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-graduation-cap"></span>
                <a href="carrera.php">[Ejemplo resultado carrera]</a>
            </span>
            <span class="col-3" title=""><span class="fa fa-users"></span> <span class="distintivo">653</span></span>
            <span class="col-3"><span class="fa fa-file"></span> <span class="distintivo">653</span></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-user"></span>
                <a href="perfil-usuario.php">[Ejemplo resultado usuario]</a>
            </span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-university"></span> [Universidad]</a></span>
            <span class="col-3"><a href="universidad.php"><span class="fa fa-graduation-cap"></span> [Carrera]</a></span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-6">
                <span class="fa fa-file-text"></span>
                <a href="ver-apunte-propio.php"> [Ejemplo resultado apuntes]</a>
            </span>

            <span class="col-2"><span class="fa fa-thumbs-o-up"></span> 20</span>
            <span class="col-2"><span class="fa fa-thumbs-o-down"></span> 2</span>
            <span class="col-2"><span class="fa fa-eye"></span> 999</span>
        </p>
        <div class="clear"></div>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
