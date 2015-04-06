<?php ob_start(); ?>
<section id="presentacion">
    <h1>[Nombre de asignatura]</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li><a href="universidad.php">[Nombre universidad]</a></li>
    <li><a href="carrera.php?uni=[Nombre carrera]">[Nombre de carrera]</a></li>
    <li>[Nombre de asignatura]</li>
</ol>
<hr>
<section>
    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5">
                    <h4>[Ejemplo de apuntes publicos]</h4>
                </div>
                <div class="col-md-4">
                    <span class="teaser-icon"><i class="fa fa-thumbs-up"></i><span class="badge">4</span></span>
                    <span class="teaser-icon"><i class="fa fa-thumbs-down"></i><span class="badge">0</span></span>
                    <span class="teaser-icon"><i class="fa fa-eye"></i><span class="badge">199</span></span>
                </div>
                <div class="col-md-3 go-icon">
                    <span class="teaser-icon"><a href="apuntes.php?vis=pub&<?php echo $uni ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5">
                    <h4>[Ejemplo de apuntes privados]</h4>
                </div>
                <div class="col-md-4">
                    <span class="teaser-icon"><i class="fa fa-thumbs-up"></i><span class="badge">4</span></span>
                    <span class="teaser-icon"><i class="fa fa-thumbs-down"></i><span class="badge">0</span></span>
                    <span class="teaser-icon"><i class="fa fa-eye"></i><span class="badge">199</span></span>
                </div>
                <div class="col-md-3 go-icon">
                    <span class="teaser-icon"><a href="apuntes.php?vis=pri&<?php echo $uni ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5">
                    <h4>[Ejemplo de apuntes publicos]</h4>
                </div>
                <div class="col-md-4">
                    <span class="teaser-icon"><i class="fa fa-thumbs-up"></i><span class="badge">4</span></span>
                    <span class="teaser-icon"><i class="fa fa-thumbs-down"></i><span class="badge">0</span></span>
                    <span class="teaser-icon"><i class="fa fa-eye"></i><span class="badge">199</span></span>
                </div>
                <div class="col-md-3 go-icon">
                    <span class="teaser-icon"><a href="apuntes.php?vis=pub&<?php echo $uni ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5">
                    <h4>[Ejemplo de apuntes privados]</h4>
                </div>
                <div class="col-md-4">
                    <span class="teaser-icon"><i class="fa fa-thumbs-up"></i><span class="badge">4</span></span>
                    <span class="teaser-icon"><i class="fa fa-thumbs-down"></i><span class="badge">0</span></span>
                    <span class="teaser-icon"><i class="fa fa-eye"></i><span class="badge">199</span></span>
                </div>
                <div class="col-md-3 go-icon">
                    <span class="teaser-icon"><a href="apuntes.php?vis=pri&<?php echo $uni ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5">
                    <h4>[Ejemplo de apuntes publicos]</h4>
                </div>
                <div class="col-md-4">
                    <span class="teaser-icon"><i class="fa fa-thumbs-up"></i><span class="badge">4</span></span>
                    <span class="teaser-icon"><i class="fa fa-thumbs-down"></i><span class="badge">0</span></span>
                    <span class="teaser-icon"><i class="fa fa-eye"></i><span class="badge">199</span></span>
                </div>
                <div class="col-md-3 go-icon">
                    <span class="teaser-icon"><a href="apuntes.php?vis=pub&<?php echo $uni ?>"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$contenido = ob_get_clean();
require "common/std/layout.php";
