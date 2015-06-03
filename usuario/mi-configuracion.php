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
        <form action="../servicios/usuarioHandler.php?action=guardarConfiguracionUsuario" method="post" autocomplete="off">
            <legend>Mis datos personales:</legend>
            <span class="col-3"><label>Nick:</label></span>
            <span class="col-9"><input type="text" name="nick" class="campo-formulario" placeholder="Introduzca su nick" required="" value="<?php echo $variables["usuario"]->nick ?>"></span>
            <span class="col-3"><label>Nombre:</label></span>
            <span class="col-9"><input type="text" name="nombre" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value="<?php echo $variables["usuario"]->nombre ?>"></span>
            <span class="col-3"><label>Apellido:</label></span>
            <span class="col-9"><input type="text" name="apellidos" class="campo-formulario" placeholder="Introduzca su nombre de usuario" required="" value="<?php echo $variables["usuario"]->apellidos ?>"></span>
            <span class="col-3"><label>Email:</label></span>
            <span class="col-9"><input type="email" name="mail" class="campo-formulario" placeholder="Introduzca su nuevo e-mail" required="" value="<?php echo $variables["usuario"]->email ?>"></span>
            <span class="col-3"><label>Dirección:</label></span>
            <span class="col-9"><input type="text" name="direccion" class="campo-formulario" placeholder="Introduzca su dirección (opcional)" value="<?php echo $variables["usuario"]->direccion ?>"></span>
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
            <span class="col-3"><label>Carrera:</label></span>
            <span class="col-9">
                <select id="selectCarrera" name="carrera" class="campo-formulario"></select>
            </span>
            <legend>Cambiar la contraseña:</legend>
            <span class="col-3"><label>Contraseña actual:</label></span>
            <span class="col-9"><input type="password" name="pwd1" class="campo-formulario" ></span>
            <span class="col-3"><label>Contraseña nueva:</label></span>
            <span class="col-9"><input type="password" name="pwd2" class="campo-formulario" ></span>
            <span class="col-3"><label>Repetir contraseña:</label></span>
            <span class="col-9"><input type="password" name="pwd3" class="campo-formulario" ></span>

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
            <input type="submit" name="actualizar" value="Guardar configuracion" class="campo-formulario">
        </form>
    </div>
</div>

<script>
    getCarreras($("#selectUniversidad").val());

    $(document).on("ready", function () {

        $("#selectUniversidad").on("change", function () {
            getCarreras($("#selectUniversidad").val());
        });
    });
    function getCarreras(id) {
        $("#selectCarrera").html("");
        $.post("../servicios/usuarioHandler.php?action=getCarreras", {idUniversidad: id}, function (data) {
            for (i = 0; i < data.length; i++) {
                if (data[i]["id"] ==<?php echo ($variables["usuario"]->carrera_id == NULL) ? -1 : $variables["usuario"]->carrera_id ?>) {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "' selected>" + data[i]["nombre"] + "</option>");
                }
                else {
                    $("#selectCarrera").append("<option value='" + data[i]["id"] + "'>" + data[i]["nombre"] + "</option>");
                }
            }
        }, "json");
    }
</script>

<?php
$contenido = ob_get_clean();
require "../common/usuario/layout.php";
