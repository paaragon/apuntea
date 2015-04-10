<?php ob_start(); ?>
<section id="presentacion">
    <h1>Universidades</h1>
</section>
<ol class="breadcrumb">
    <li><a href="index.php">Apuntea</a></li>
    <li>Universidades</li>
</ol>
<hr>
<section>
    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/LogoUCM.jpg" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad Complutense de Madrid</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/Logo_URJC.svg.png" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad Rey Juan Carlos</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/logo-uah-bp.gif" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad de Alcalá de Henares</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/logo_uam.gif" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad Autónoma de Madrid</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/logo_univ_carlosiii.gif" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad Carlos III</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-1">
                    <img src="img/universidades/upm-T.gif" class="img-responsive">
                </div>
                <div class="col-xs-7">
                    <h3>Universidad Politécnica de Madrid</h3>
                </div>
                <div class="col-xs-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><i class="fa fa-chevron-circle-right"></i></a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "common/std/layout.php";
