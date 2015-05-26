<?php ob_start(); ?>
<section>
    <h1>Universidades</h1>
</section>
<ul class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Universidades</li>
</ul>
<hr>
<section>
    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/LogoUCM.jpg" class="imagen-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad Complutense de Madrid</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/Logo_URJC.svg.png" class="img-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad Rey Juan Carlos</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/logo-uah-bp.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad de Alcalá de Henares</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/logo_uam.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad Autónoma de Madrid</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/logo_univ_carlosiii.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad Carlos III</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-1">
                    <p>
                        <img src="img/universidades/upm-T.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-7">
                    <h3>Universidad Politécnica de Madrid</h3>
                </div>
                <p class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </p>
            </div>
        </div>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
