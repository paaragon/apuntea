<?php ob_start(); ?>
<div>
<div class="col-7">
    <div class="fila">
        <p>
            <span class="col-9">
                <strong><a href="#"> EDA </a></strong>
            </span>
            <span class="col-3"><span class="fa fa-file-text"></span> 8</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-9">
                <strong><a href="#"> AW </a></strong>
            </span>
            <span class="col-3"><span class="fa fa-file-text"></span> 5</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-9">
                <strong><a href="#"> EC </a></strong>
            </span>
            <span class="col-3"><span class="fa fa-file-text"></span> 12</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-9">
                <strong><a href="#"> TP </a></strong>
            </span>
            <span class="col-3"><span class="fa fa-file-text"></span> 4</span>
        </p>
        <div class="clear"></div>
    </div>
    <div class="fila">
        <p>
            <span class="col-9">
                <strong><a href="#"> AI </a></strong>
            </span>
            <span class="col-3"><span class="fa fa-file-text"></span> 9</span>
        </p>
        <div class="clear"></div>
    </div>
</div>
<div class="col-5">
      <span class="col-11">
                <strong>  Estadisticas asignaturas</strong>
    </span>
      <div class="col-11">
          <img class="col-6" src="../img/line-graph.gif" class="img-responsive mini-logo">
          <div class="clear"></div>
      </div>
      <div class="col-11">
          <img class="col-6" src="../img/line-graph.gif" class="img-responsive mini-logo">
          <div class="clear"></div>
      </div>
      <div class="col-11">
          <img class="col-6" src="../img/line-graph.gif" class="img-responsive mini-logo">
          <div class="clear"></div>
      </div>
</div>
</div>
<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";