<?php
require __DIR__ . "/../controladores/ControladorAdmin.php";
$controlador = new ControladorAdmin();
$variables = $controlador->anadirCarrera();

ob_start();
?>
<div id="principal">
    <h2>
        <span class="fa fa-university"></span> Añadir universidad
    </h2>
    <hr>
    <section>
        <form action="../servicios/adminHandler.php?action=anadirUniversidad" method="post" id="formEditar" enctype="multipart/form-data">
            <label>Universidad:</label>
            <input type="text" name="universidad" class="campo-formulario" required="">
            <label>Siglas:</label>
            <input type="text" name="siglas" class="campo-formulario" required="">

            <label>Logo de la universidad:</label>
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

            <input type="hidden" value="<?php echo $variables["universidad"]->id ?>" name="idUniversidad">
            <input type="submit" value="Guardar universidad" class="campo-formulario " id="btnSubmit">
        </form>
    </section>
</div>
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

        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();

            data = JSON.stringify($('#imgperfil').cropper("getData"));
            $("#img-perfil-data").val(data);

            data2 = JSON.stringify($('#imgportada').cropper("getData"));
            $("#img-portada-data").val(data2);

            $("#formEditar").submit();
        });
    });
</script>
<?php
$contenido = ob_get_clean();
$styles[] = '<link rel="stylesheet" type="text/css" href="../css/cropper.css" />';
$scripts[] = '<script type="text/javascript" src="../js/cropper.js"></script>';
require "../common/admin/layout.php";
