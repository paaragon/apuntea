<?php ob_start(); ?>
<div role="tabpanel" class="col-md-9">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#aportaciones" aria-controls="presentaciones" role="tab" data-toggle="tab">Mis aportaciones</a></li>     
        <li role="presentation"><a href="#novedades" aria-controls="novedades" role="tab" data-toggle="tab">Novedades</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="aportaciones">
            <?php require "inicio/novedades.php"; ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="novedades">
            <?php require "inicio/novedades.php"; ?>
        </div>
    </div>
</div>
<div class="col-md-3">
    <?php require "inicio/busqueda.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
