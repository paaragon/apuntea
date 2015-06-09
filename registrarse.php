<?php
require "controladores/ControladorEstandar.php";

$controlador = new ControladorEstandar();

$variables = $controlador->registrarse();

ob_start();
?>
<section>
    <h1>Registrarse:</h1>
</section>
<section>

    <form action="servicios/standarHandler.php?action=registrarse" method="post" id="formRegistrar" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="campo-formulario" required="">
        <label>Apellidos</label>
        <input type="text" name="apellidos" class="campo-formulario" required="">
        <label>Email</label>
        <input type="email" name="email" class="campo-formulario" required="">
        <label>Universidad:</label>
        <select name="universidad" class="campo-formulario" id="universidades">
            <?php foreach ($variables["universidades"] as $uni): ?>
                <option value="<?php echo $uni->id ?>"><?php echo $uni->nombre ?></option>
            <?php endforeach; ?>
        </select>
        <label>Carrera:<img src="img/loading.GIF" id="load-carrera"></label>
        <select name="carrera" class="campo-formulario" id="carreras" required>
        </select>
        <br><br><br>
        <label>Alias de usuario:<span id="nickStatus"></span></label>
        <input type="text" name="alias" class="campo-formulario" required="" id="nick">
        <label>Contraseña: <a id="passTooltip" tabindex="0" class="badge" role="button" data-toggle="popover" data-trigger="focus" title="Para generar una contraseña segura esta debe contener:" data-content="<ul><li>Más de 8 caracteres.</li><li>Mayúsculas y minúsculas.</li><li>Caracteres especiales.</li></ul>">?</a></label>
        <input type="password" name="password" class="campo-formulario" required="" id="password">
        <div class="progress">
            <div id="passwordStrength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
        <label>Repita la contraseña:</label>
        <input type="password" name="password2" class="campo-formulario" required="">

        <br><br><br>
        <label>Imagen de perfil:</label>
        <input type="file" name="img-perfil" class="campo-formulario" required="" id="fileImgPerfil">
        <div class="campo-formulario img-registro">
            <img src="" alt="Imagen no seleccionada" id="imgperfil">
        </div>
        <input type="hidden" name="img-perfil-data" id="img-perfil-data">
        <input type="hidden" name="img-perfil-src" id="img-perfil-src">
        <label>Imagen de portada:</label>
        <input type="file" name="img-portada" class="campo-formulario" required="" id="fileImgPortada">
        <div class="campo-formulario">
            <img src="" alt="Imagen no seleccionada" id="imgportada">
        </div>
        <input type="hidden" name="img-portada-data" id="img-portada-data">
        <input type="hidden" name="img-portada-src" id="img-portada-src">
        <br><br><br>
        <div class="g-recaptcha" data-sitekey="6LcTwgcTAAAAACpnt-OIt92HTXwTDWMGMwmHVjKk"></div>
        <br><br><br>
        <input type="submit" value="Registrarse" class="campo-formulario" id="btnSubmit">
    </form>
    <blockquote>
        <h4>O si lo prefieres regístrate con alguna de estas redes sociales:</h4>
        <h1>
            <a href="util/1353/fbconfig.php?registrarse=1"><i class="fa fa-facebook-square"></i></a>
        </h1>
    </blockquote>
</section>
<script>

    function checkPassword() {

        var pass = $("#password").val();
        var strength = 0;
        var length = 0;

        if (pass.length > 0 && pass.length < 6) {

            length = 10;
            strength += 10;
        } else if (pass.length >= 6 && pass.length <= 8) {

            length = 20;
            strength += 20;
        } else if (pass.length > 8) {

            length = 40;
            strength += 40;
        }

        var upper = false;
        var lower = false;
        var specialChar = false;
        var eChars = "~`!#$%^&*+=-_@[]\\\';,/{}|\":<>?";

        var i = 0;
        while (i < pass.length) {
            var c = pass.charAt(i);
            if (eChars.indexOf(c) !== -1) {
                specialChar = true;
            } else {
                if (c === c.toUpperCase()) {
                    upper = true;
                } else if (c === c.toLowerCase()) {
                    lower = true;
                }
            }
            i++;
        }

        if (upper && lower) {

            strength += 20;
        }

        if (specialChar) {
            if (length == 10) {
                strength += 10;
            } else if (length == 20) {
                strength += 20;
            } else if (length == 40) {
                strength += 40;
            }
        }

        $("#passwordStrength").attr("aria-valuenow", strength);
        $("#passwordStrength").css("width", strength + '%');

        if (strength < 33) {
            $("#passwordStrength").attr("class", "progress-bar progress-bar-danger");
        } else if (strength >= 33 && strength < 66) {
            $("#passwordStrength").attr("class", "progress-bar progress-bar-warning");
        } else {
            $("#passwordStrength").attr("class", "progress-bar progress-bar-success");
        }
    }

    function checkUserName() {

        var input = $("#nick");
        var nick = input.val();
        $.post("servicios/standarHandler.php?action=userNameExist", {name: nick}, function (data) {
            if (data === true) {
                $("#nickStatus").text(" Alias disponible").removeClass("text-danger").addClass("text-success");
            } else {
                $("#nickStatus").text(" Alias no disponible").removeClass("text-success").addClass("text-danger");
            }
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

    function cargarCarreras() {
        $("#load-carrera").show();
        id = $("#universidades").val();
        $.post("servicios/standarHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {

            for (i = 0; i < data.length; i++) {
                $("#carreras").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
            }
            $("#load-carrera").hide();
        }, "json");
    }

    $(document).on("ready", function () {

        $('#passTooltip').popover({html: true});

        $("#password").on("keyup", checkPassword);
        $("#nick").on("keyup", checkUserName);

        cargarCarreras();

        $("#universidades").on("change", function () {
            cargarCarreras();
        });

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

        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();

            data = JSON.stringify($('#imgperfil').cropper("getData"));
            $("#img-perfil-data").val(data);

            data2 = JSON.stringify($('#imgportada').cropper("getData"));
            $("#img-portada-data").val(data2);

            if (data == "" || data2 == "") {
                alert("Debe seleccionar las imágenes");
                return;
            }

            $("#formRegistrar").submit();
        });
    });
</script>
<?php
$scripts[] = "<script src='https://www.google.com/recaptcha/api.js'></script>";
$contenido = ob_get_clean();
require "common/std/layout.php";
