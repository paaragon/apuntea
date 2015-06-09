<?php
require "../controladores/ControladorUsuario.php";
$controlador = new ControladorUsuario();

$variables = $controlador->editarApunte();
ob_start();

if ($variables["apunte"] != null):
    ?>
    <form action="../servicios/usuarioHandler.php?action=guardarApunte" method="post" id="formulario">
        <div id="head-apunte">
            <span class="col-8">
                <a href="universidad.php?id=<?php echo $variables["apunte"]->asignatura->carrera->universidad->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->universidad->siglas ?></a> / 
                <a href="carrera.php?id=<?php echo $variables["apunte"]->asignatura->carrera->id ?>"><?php echo $variables["apunte"]->asignatura->carrera->nombre ?></a> /
                <a href="asignatura.php?id=<?php echo $variables["apunte"]->asignatura->id ?>"><?php echo $variables["apunte"]->asignatura->nombre ?></a>
            </span>
            <span class="col-2"><a href="javascript:submit();"><span class="fa fa-floppy-o"></span> Guardar</a></span>
            <span class="col-2"><a href="ver-apunte.php?id=<?php echo $variables["apunte"]->id ?>"><span class="fa fa-times"></span> Cancelar</a></span>
            <div class="clear"></div>
        </div>
        <div id="contenido-apunte" class="editar-apunte">
            <h2 class="text-center"><?php echo $variables["apunte"]->titulo ?></h2>
            <textarea id="area-apunte" name="contenido"><?php echo $variables["apunte"]->contenido ?></textarea>
            <input type="hidden" value="<?php echo $variables["apunte"]->id ?>" name="apunte">
        </div>
        <?php if ($variables["apunte"]->usuario_id == $variables["usuario"]->id || $variables["interaccion"]->permiso == 3): ?>
            <h3><span class="fa fa-key"></span>Permisos:</h3>
            <span class="col-4">
                <label><span class="fa fa-eye"></span> Visualización:</label>
                <label class="campo-formulario"><input type="radio" name="visualizacion" <?php if ($variables["apunte"]->permisovisualizacion == 0) echo 'checked=""' ?> value="0"> Solo yo</label>
                <label class="campo-formulario"><input type="radio" name="visualizacion" <?php if ($variables["apunte"]->permisovisualizacion == 1) echo 'checked=""' ?> value="1" id="visAlgunos"> Algunos usuarios</label>
                <label class="campo-formulario"><input type="radio" name="visualizacion" <?php if ($variables["apunte"]->permisovisualizacion == 2) echo 'checked=""' ?> value="2"> Público</label>
                <span id="lectores">
                    <hr>
                    <label>Lectores:</label>
                    <select id="selectPermiso1" class="campo-formulario">
                        <?php
                        foreach ($variables["contactos"] as $con) {
                            if (!$controlador->idInArray($con, $variables["lectores"])) {
                                echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                            }
                        }
                        ?>
                    </select>
                    <?php foreach ($variables["lectores"] as $lector): ?>
                        <input type="text" class="campo-formulario" disabled value="<?php echo $lector->nombre ?>">
                        <input name="lector[]" type="hidden" value="<?php echo $lector->id ?>">
                    <?php endforeach; ?>
                </span>
            </span>
            <span class="col-4">
                <label><span class="fa fa-edit"></span> Modificación:</label>
                <label class="campo-formulario"><input type="radio" name="modificacion" <?php if ($variables["apunte"]->permisoedicion == 0) echo 'checked=""' ?> value="0"> Solo yo</label>
                <label class="campo-formulario"><input type="radio" name="modificacion" <?php if ($variables["apunte"]->permisoedicion == 1) echo 'checked=""' ?> value="1" id="modAlgunos"> Alguno usuarios</label>
                <span id="modificadores">
                    <hr>
                    <label>Usuarios que modifiquen:</label>
                    <select id="selectPermiso2" class="campo-formulario">
                        <?php
                        foreach ($variables["contactos"] as $con) {
                            if (!$controlador->idInArray($con, $variables["modificadores"])) {
                                echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                            }
                        }
                        ?>
                    </select>
                    <?php foreach ($variables["modificadores"] as $lector): ?>
                        <input type="text" class="campo-formulario" disabled value="<?php echo $lector->nombre ?>">
                        <input name="modificador[]" type="hidden" value="<?php echo $lector->id ?>">
                    <?php endforeach; ?>
                </span>
            </span>
            <span class="col-4">
                <label><span class="fa fa-key"></span> Edición de permisos:</label>
                <label class="campo-formulario"><input type="radio" name="edicion-permisos" <?php if ($variables["apunte"]->permisoedicionpermiso == 0) echo 'checked=""' ?> value="0"> Solo yo</label>
                <label class="campo-formulario"><input type="radio" name="edicion-permisos" <?php if ($variables["apunte"]->permisoedicionpermiso == 1) echo 'checked=""' ?> value="1" id="perAlgunos"> Alguno usuarios</label>
                <span id="permisores">
                    <hr>
                    <label>Usuarios que editen permisos:</label>
                    <select id="selectPermiso3" class="campo-formulario">
                        <?php
                        foreach ($variables["contactos"] as $con) {
                            if (!$controlador->idInArray($con, $variables["permisores"])) {
                                echo "<option value='$con->id'>$con->nombre $con->apellido</option>";
                            }
                        }
                        ?>
                    </select>
                    <?php foreach ($variables["permisores"] as $lector): ?>
                        <input type="text" class="campo-formulario" disabled value="<?php echo $lector->nombre ?>">
                        <input name="permisor[]" type="hidden" value="<?php echo $lector->id ?>">
                    <?php endforeach; ?>
                </span>
            </span>
        <?php endif; ?>
    </form>
    <script>

        function editando() {
            $.post("../servicios/usuarioHandler.php?action=editando", {idApunte: <?php echo $variables["apunte"]->id ?>}, function (data) {

            });
        }

        $(document).on("ready", function () {

            timer = setInterval(function () {
                editando();
            }, 2000);

            CKEDITOR.replace('area-apunte');

            if ($("#visAlgunos").is(':checked')) {
                $("#lectores").show();
            } else {
                $("#lectores").hide();
            }

            if ($("#modAlgunos").is(':checked')) {
                $("#modificadores").show();
            } else {
                $("#modificadores").hide();
            }

            if ($("#perAlgunos").is(':checked')) {
                $("#permisores").show();
            } else {
                $("#permisores").hide();
            }

            $('input[type=radio][name=visualizacion]').change(function () {
                if (this.value == '1') {
                    $("#lectores").show();
                }
                else {
                    $("#lectores").hide();
                }
            });

            $('input[type=radio][name=edicion-permisos]').change(function () {
                if (this.value == '1') {
                    $("#permisores").show();
                }
                else {
                    $("#permisores").hide();
                }
            });

            $('input[type=radio][name=modificacion]').change(function () {
                if (this.value == '1') {
                    $("#modificadores").show();
                }
                else {
                    $("#modificadores").hide();
                }
            });
            $("#selectPermiso1 option").on("click", function () {
                id = $(this).val();
                nombre = $(this).text();
                $("#lectores").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
                $("#lectores").append('<input name="lector[]" type="hidden" value="' + id + '">');
                $(this).remove();
            });

            $("#selectPermiso2 option").on("click", function () {
                id = $(this).val();
                nombre = $(this).text();
                $("#modificadores").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
                $("#modificadores").append('<input name="modificador[]" type="hidden" value="' + id + '">');
                $(this).remove();
            });

            $("#selectPermiso3 option").on("click", function () {
                id = $(this).val();
                nombre = $(this).text();
                $("#permisores").append('<input type="text" class="campo-formulario" disabled value="' + nombre + '">');
                $("#permisores").append('<input name="permisor[]" type="hidden" value="' + id + '">');
                $(this).remove();
            });
        });

        function submit() {
            $("#formulario").submit();
        }
    </script>
    <?php
else:
    echo '<div class="alert alert-warning">Este apunte no existe o está siendo editado en este momento por otro usuario.</div>';
endif;
$contenido = ob_get_clean();
$scripts[] = '<script type="text/javascript" src="../util/ckeditor/ckeditor.js"></script>';
require "../common/usuario/layout.php";
