<?php ob_start(); ?>

<h2>
    <span class="fa fa-file-text-o"></span> Asignaturas
</h2>
<hr>
<div class="fila col-9">

    <label>Nombre: <input type="search" name="nombre" placeholder="Buscador por nombre" class="campo-formulario"> </label>
    <br>
    <label><span class="fa fa-graduation-cap"></span>Carrera:</label>
    <select class="campo-formulario">
        <option value="Informatica">Informatica</option>
        <option value="Derecho">Derecho</option>
        <option value="Medicina">Medicina</option>
        <option value="Chuletas">Chuletas</option>
    </select>
    <label><span class="fa fa-university"></span> Universidad:</label>
    <select class="campo-formulario">
        <option value="UCM">UCM</option>
        <option value="UPM">UPM</option>
        <option value="URJC">URJC</option>
        <option value="UAM">UAM</option>
    </select>
    <div clas="clear"></div>
    <h3>Listado de asginaturas</h3>
    <section>
    <div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="fila">
            <div class="col-9">
                <p>[Nombre Asignatura]</p>
            </div>
            <div class="col-2">
                <p>
                    <span><span class="fa fa-files-o"></span> <span class="badge">48</span></span>
                    <span><span class="fa fa-trash"></span>
                </p>
            </div>
            <div class="col-1">
                <p>
                    <span><a href="admin-asignatura.php"><span class="fa fa-chevron-circle-right"></span></a></span>
                </p>
            </div>
            <div class="clear"></div>
        </div>
       
    </div>
</section>
</div >

  
  <div class="col-3">
    <p>
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
        <img src="../img/line-graph.gif" class="img-responsive">
    <p>
    </div>
  
  
   <!--<div class="fila col-9">
        <span class="col-7">
            <span class="fa fa-file-text-o"></span>
            <label><a href="ver-apunte-autor.php">Tema 1</a></label>
        </span>

        <span class="col-1"><span class="fa fa-thumbs-o-up"></span> 20</span>
        <span class="col-1"><span class="fa fa-thumbs-o-down"></span> 2</span>
        <span class="col-1"><span class="fa fa-eye"></span> 999</span>
        <span class="col-1"><span class="fa fa-envelope"></span></span>
        <span class="col-1"><span class="fa fa-trash-o"></span></span>
  </div>-->
  
    <div class="clear"></div>


<?php
$contenido = ob_get_clean();
require "../common/admin/layout.php";

