<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->inicio();

ob_start();
?>
<section>
    <h1>Universidades</h1>
</section>
<section>
    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/LogoUCM.jpg" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad Complutense de Madrid</h3>
                </div>
                <div class="col-3 go-icon">
                    <p>
                        <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/Logo_URJC.svg.png" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad Rey Juan Carlos</h3>
                </div>
                <div class="col-3 go-icon">
                    <p>
                        <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/logo-uah-bp.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad de Alcalá de Henares</h3>
                </div>
                <div class="col-3 go-icon">
                    <p>
                        <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/logo_uam.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad Autónoma de Madrid</h3>
                </div>
                <div class="col-3 go-icon">
                    <p>
                        <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/logo_univ_carlosiii.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad Carlos III</h3>
                </div>
                <div class="col-3 go-icon">
                    <p>
                        <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="teaser">
        <div class="panel">
            <div class="panel-cuerpo">
                <div class="col-1">
                    <p>
                        <img src="../img/universidades/upm-T.gif" class="img-responsive">
                    </p>
                </div>
                <div class="col-8">
                    <h3>Universidad Politécnica de Madrid</h3>
                </div>
                <div class="col-3 go-icon">
                    <span class="teaser-icon"><a href="universidad.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</section>
<?php

$contenido = ob_get_clean();
require "../common/usuario/layout.php";


