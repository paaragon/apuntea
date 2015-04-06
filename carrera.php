<?php ob_start(); ?>
<section id="presentacion">
    <h1>[Nombre de carrera]</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="carreras.php">Carreras</a></li>
    <?php
    if (isset($_GET["uni"])) {
        $uni = "&uni=" . $_GET["uni"];
        echo '<li><a href="universidad.php">' . $_GET["uni"] . '</a></li>';
    } else {
        $uni = "";
    }
    ?>
    <li>[Nombre de carrera]</li>
</ol>
<hr>
<form>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar...">
            <div class="input-group-addon"><a href="#"><i class="fa fa-search"></i></a></div>
        </div>
    </div>
</form>
<section>

    <div>
        <h2>1º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
        </ul>
    </div>

    <div>
        <h2>2º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
        </ul>
    </div>

    <div>
        <h2>3º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
        </ul>
    </div>
    <div>
        <h2>4º Curso</h2>
        <hr>
        <ul>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
            <li><a href="asignatura.php?car=[Nombre carrera]<?php echo $uni ?>">[Nombre asignatura]</a></li>
        </ul>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
