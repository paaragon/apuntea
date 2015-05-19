<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<section>
    <h1>[Nombre de carrera]</h1>
</section>
<ul class="breadcrumb">
    <li><a href="lista-universidades.php">Archivo</a></li>
    <li><a href="universidad.php">[Nombre universidad]</a></li>
    <li>[Nombre carrera]</li>
</ul>
<form action="carrera.php" method="post">
    <input class="campo-formulario" name="buscar" type="text" placeholder="Introduzca el nombe de una carrera">
    <input type="submit" class="campo-formulario" value="Buscar">
</form>
<section>
    <div>
        <h2>1º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
        </ul>
    </div>

    <div>
        <h2>2º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
        </ul>
    </div>

    <div>
        <h2>3º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
        </ul>
    </div>
    <div>
        <h2>4º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php">[Nombre asignatura]</a></li>
        </ul>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";
