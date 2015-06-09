<?php
require "../controladores/ControladorUsuario.php";
$cntr = new ControladorUsuario();

$variables = $cntr->miConfiguracion();
ob_start();
?>

<div id="principal">
    <h2>
        <span class="fa fa-cog"></span> Mi configuración
    </h2>
    <hr>
    <div>
        <form action="../servicios/usuarioHandler.php?action=guardarConfiguracionUsuario" method="post" autocomplete="off" enctype="multipart/form-data" id="formRegistrar">
            <legend>Mis datos personales:</legend>
            <span class="col-3"><label>Nick:</label></span>
            <span class="col-9"><input type="text" name="nick" class="campo-formulario" placeholder="Introduzca su nick" required="" value="<?php echo $variables["usuario"]->nick ?>"></span>
            <span class="col-3"><label>Estado:</label></span>
            <span class="col-9"><input type="text" name="estado" class="campo-formulario" placeholder="Introduzca su estado" required="" value="<?php echo $variables["usuario"]->estado ?>"></span>
            <span class="col-3"><label>Nombre:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value="<?php echo $variables["usuario"]->nombre ?>"></span>
            <span class="col-3"><label>Apellido:</label></span>
            <span class="col-9"><input type="text" name="apellidos" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value="<?php echo $variables["usuario"]->apellidos ?>"></span>
            <?php if (isset($variables["usuario"]->email)): ?>
                <span class="col-3"><label>Email:</label></span>
                <span class="col-9"><input type="email" name="mail" class="campo-formulario" placeholder="Introduzca su nuevo e-mail" required="" value="<?php echo $variables["usuario"]->email ?>"></span>
            <?php else: ?>
                <div class="has-error">
                    <span class="col-3"><label class="control-label">Email:</label></span>
                    <span class="col-9"><input type="email" name="mail" class="campo-formulario form-control" placeholder="Introduzca su nuevo e-mail" required="" value="<?php echo $variables["usuario"]->email ?>"></span>
                </div>
            <?php endif; ?>
            <span class="col-3"><label>Universidad:</label></span>
            <span class="col-9">
                <select id="selectUniversidad" name="universidad" class="campo-formulario">
                    <?php
                    foreach ($variables["universidades"] as $uni) {
                        if ($uni->id == $variables["usuario"]->carrera->universidad_id) {
                            echo "<option value='$uni->id' selected>$uni->nombre</option>";
                        } else {
                            echo "<option value='$uni->id'>$uni->nombre</option>";
                        }
                    }
                    ?>
                </select>
            </span>
            <?php if (isset($variables["usuario"]->carrera_id)): ?>
                <span class="col-3"><label>Carrera:<img src="../img/loading.GIF" id="load-carrera"></label></span>
                <span class="col-9">
                    <select id="selectCarrera" name="carrera" class="campo-formulario">
                        <option value="" selected="">Todas</option>
                    </select>
                </span>
            <?php else: ?>
                <div class="has-error">
                    <span class="col-3"><label class="control-label">Carrera:<img src="../img/loading.GIF" id="load-carrera"></label></span>
                    <span class="col-9">
                        <select id="selectCarrera" name="carrera" class="campo-formulario form-control">
                            <option value="" selected="">Todas</option>
                        </select>
                    </span>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <br><br>
            <label>Imagen de perfil:</label>
            <input type="file" name="img-perfil" class="campo-formulario" id="fileImgPerfil">
            <div class="campo-formulario img-registro">
                <img src="" alt="Imagen no seleccionada" id="imgperfil">
            </div>
            <input type="hidden" name="img-perfil-data" id="img-perfil-data">
            <input type="hidden" name="img-perfil-src" id="img-perfil-src">
            <label>Imagen de portada:</label>
            <input type="file" name="img-portada" class="campo-formulario" id="fileImgPortada">
            <div class="campo-formulario">
                <img src="" alt="Imagen no seleccionada" id="imgportada">
            </div>
            <input type="hidden" name="img-portada-data" id="img-portada-data">
            <input type="hidden" name="img-portada-src" id="img-portada-src">
            <div class="clearfix"></div>
            <br><br>
            <legend>Cambiar la contraseña:</legend>
            <span class="col-3"><label>Contraseña actual:</label></span>
            <span class="col-9"><input type="password" name="pwd1" class="campo-formulario" ></span>
            <span class="col-3"><label>Contraseña nueva:</label></span>
            <span class="col-9"><input type="password" name="pwd2" class="campo-formulario" ></span>
            <span class="col-3"><label>Repetir contraseña:</label></span>
            <span class="col-9"><input type="password" name="pwd3" class="campo-formulario" ></span>
            <div class="clearfix"></div>
            <br><br>
            <legend>Privacidad: </legend>
            ¿Quién puede ver mi perfil? <br>
            <?php
            if ($variables["usuario"]->privacidadperfil == 1) {
                $chck11 = 'checked="checked"';
                $chck21 = '';
            } else {
                $chck11 = '';
                $chck21 = 'checked="checked"';
            }
            ?>
            <label><input type="radio" name="vis-perfil" value="1" id="radioperf1" <?php echo $chck11 ?>/> Todo el mundo</label>
            <label><input type="radio" name="vis-perfil" value="0" id="radioperf2" <?php echo $chck21 ?>/> Solo mis amigos</label>
            <hr>
            ¿Quién puede ver mi actividad? <br>
            <?php
            if ($variables["usuario"]->privacidadactividad == 1) {
                $chck12 = 'checked="checked"';
                $chck22 = '';
            } else {
                $chck12 = '';
                $chck22 = 'checked="checked"';
            }
            ?>
            <label><input type="radio" name="vis-actividad" value="1" id="radioact1" <?php echo $chck12 ?>/> Todo el mundo</label>
            <label><input type="radio" name="vis-actividad" value="0" id="radioact2" <?php echo $chck22 ?> /> Solo mis amigos</label>
            <hr>
            ¿Quién puede encontrarme a través del buscador? <br>
            <?php
            if ($variables["usuario"]->privacidadbuscador == 1) {
                $chck13 = 'checked="checked"';
                $chck23 = '';
            } else {
                $chck13 = '';
                $chck23 = 'checked="checked"';
            }
            ?>
            <label><input type="radio" name="vis-buscador" value="1" id="radiobusc1" <?php echo $chck13 ?>/> Todo el mundo</label>
            <label><input type="radio" name="vis-buscador" value="0" id="radiobusc2" <?php echo $chck23 ?>/> Solo mis amigos</label><br><br>
            <input type="submit" id="btnSubmit" name="actualizar" value="Guardar configuracion" class="campo-formulario">
        </form>
    </div>
</div>

<script>
    getCarreras($("#selectUniversidad").val());

    $(document).on("ready", function () {

        $("#fileImgPerfil").change(function () {
            readURL(this, $('#imgperfil'), {
                aspectRatio: 1,
                autoCropArea: 1,
                strict: false,
                guides: false,
                highlight: true,
                dragCrop: true,
                movable: true,
                resizable: true,
                done: function (data) {
                    var json = [
                        '{"x":' + data.x,
                        '"y":' + data.y,
                        '"height":' + data.height,
                        '"width":' + data.width + "}"
                    ].join();
                }
            }, $("#img-perfil-src"));
        });

        $("#fileImgPortada").change(function () {
            readURL(this, $('#imgportada'), {
                aspectRatio: 16 / 7,
                autoCropArea: 1,
                strict: false,
                guides: false,
                highlight: true,
                dragCrop: true,
                movable: true,
                resizable: true,
                done: function (data) {
                    var json = [
                        '{"x":' + data.x,
                        '"y":' + data.y,
                        '"height":' + data.height,
                        '"width":' + data.width + "}"
                    ].join();
                }
            }, $("#img-portada-src"));
        });

        $("#selectUniversidad").on("change", function () {
            getCarreras($("#selectUniversidad").val());
        });

        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();

            data = JSON.stringify($('#imgperfil').cropper("getData"));
            $("#img-perfil-data").val(data);

            data2 = JSON.stringify($('#imgportada').cropper("getData"));
            $("#img-portada-data").val(data2);

            $("#formRegistrar").submit();
        });
    });
    function getCarreras(id) {
        $("#load-carrera").show();
        $("#selectCarrera").html("");
        $("#selectCarrera").append('<option value="" selected="">Todas</option>');
        $.post("../servicios/usuarioHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                if (data[i]["id"] ==<?php echo ($variables["usuario"]->carrera_id == NULL) ? -1 : $variables["usuario"]->carrera_id ?>) {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "' selected>" + data[i]["nombre"] + "</option>");
                }
                else {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            }
            $("#load-carrera").hide();
        }, "json");
    }

    function readURL(input, img, options, src) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                loadImgPerfil(img, e, options, src);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadImgPerfil(img, e, options, imgSrc) {
        var src = e.target.result;
        imgSrc.val(src);
        img.attr('src', src);
        img.cropper(options);
    }
</script>

<?php
$styles[] = '<link rel="stylesheet" type="text/css" href="../css/cropper.css" />';
$scripts[] = '<script type="text/javascript" src="../js/cropper.js"></script>';
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
