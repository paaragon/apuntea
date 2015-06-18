<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirAdmin();

ob_start();
?>

<h2>
    <span class="fa fa-empire"></span> Añadir administrador
</h2>
<hr>
<form action="../servicios/adminHandler.php?action=anadirAdmin" method="post">
    <label>Nombre:</label>
    <input type="text" name="nombre" class="campo-formulario" required="">
    <label>Apellidos</label>
    <input type="text" name="apellidos" class="campo-formulario" required="">
    <label>Email</label>
    <input type="email" name="email" class="campo-formulario" required="">
    <label>Alias de administrador:<span id="nickStatus"></span></label>
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
    <input type="submit" value="Añadir admin" class="campo-formulario">
</form>

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
$contenido = ob_get_clean();
require "../common/admin/layout.php";
