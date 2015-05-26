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
        <label>Alias de usuario:</label>
        <input type="text" name="alias" class="campo-formulario" required="">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="campo-formulario" required="">
        <label>Apellidos</label>
        <input type="text" name="apellidos" class="campo-formulario" required="">
        <label>Email</label>
        <input type="email" name="email" class="campo-formulario" required="">
        <label>Contraseña:</label>
        <input type="password" name="password" class="campo-formulario" required="">
        <label>Repita la contraseña:</label>
        <input type="password" name="password2" class="campo-formulario" required="">
        <label>Universidad:</label>
        <select name="universidad" class="campo-formulario" id="universidades">
            <?php foreach ($variables["universidades"] as $uni): ?>
                <option value="<?php echo $uni->id ?>"><?php echo $uni->nombre ?></option>
            <?php endforeach; ?>
        </select>
        <label>Carrera:<img src="img/loading.GIF" id="load-carrera"></label>
        <select name="carrera" class="campo-formulario" id="carreras" required>
        </select>
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
        <input type="submit" value="Registrarse" class="campo-formulario" id="btnSubmit">
    </form>
    <blockquote>
        <h4>O si lo prefieres regístrate con alguna de estas redes sociales:</h4>
        <h1>
            <a href="util/1353/fbconfig.php?registrarse=1"><i class="fa fa-facebook-square"></i></a>
            <a href="registrado.php"><i class="fa fa-twitter-square"></i></a>
        </h1>
    </blockquote>
</section>
<script>
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
require "common/std/layout.php";
