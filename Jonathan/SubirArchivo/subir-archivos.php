<?php ob_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Hoja de estilos-->

</head>
<body>

    <div class="col-9" id="principal">
        <h2>
            <i class="fa fa-cloud-download"></i> Subir Archivos
        </h2>
        <hr>


        <!--Creacion principal para subir archivo -->
        <div class="fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                <strong> Selecciona un archivo a subir </strong></a
            </p>
            <hr>

            <form class="form" role="form">
                <input type="file" class="form-control" id="file" name="file" required>


            </form>

        </div>


        <div class="col-6 fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                Tema:<strong> selecciona </strong></a>
            </p>
            <select class = "col-12">
                <option value="Informatica">Informatica</option>
                <option value="Derecho">Derecho</option>
                <option value="Medicina">Medicina</option>
                <option value="Chuletas">Chuletas</option>
            </select>
        </div>
        <div class="col-6 fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                Universidad:<strong> selecciona </strong></a>
            </p>
            <select class = "col-12">
                <option value="UCM">UCM</option>
                <option value="UPM">UPM</option>
                <option value="URJC">URJC</option>
                <option value="UAM">UAM</option>
            </select>
        </div>

        <div class="col-6 fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                Carrera:<strong> selecciona </strong></a>
            </p>
            <select class = "col-12">
                <option value="Informatica">Informatica</option>
                <option value="Derecho">Derecho</option>
                <option value="Medicina">Medicina</option>
                <option value="Chuletas">Chuletas</option>
            </select>
        </div>
        <div class="col-6 fila">
            <p> 
                <span class="fa fa-file-text-o"></span>
                Permisos:<strong> selecciona </strong></a>
            </p>
            <select class = "col-12">
                <option value="Privado">Privado</option>
                <option value="Publico">Publico</option>
            </select>
        </div>

        <div class=" fila">
            <a href="#" class="boton boton-activo">Go!</a>
        </div>
    </div>
</body>





<div class="col-3">
    <?php require "inicio/actividad.php"; ?>
</div>
<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
