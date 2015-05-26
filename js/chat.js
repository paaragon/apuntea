
var timer;
var dia;

getConectados();

setInterval(function () {
    getConectados();
}, 2000);

function getConectados() {

    $("#loading").show();

    $.post('../servicios/usuarioHandler.php?action=getUsuariosConectados', function (data) {

        $("#loading").hide();
        $("#contactos-conectados").html("").attr("class", "");

        if (data.length > 0) {
            for (var i = 0, length = data.length; i < length; i++) {

                usuario = '<span class="conectado" id="con-' + data[i]["usuario"]["id"] + '"><img src="../img/usuarios/perfil/' + data[i]["usuario"]["avatar"] + '"><a href="#">' + data[i]["usuario"]["nombre"] + '</a>';

                if (data[i]["sin-leer"] !== 0) {
                    usuario += ' <span class="badge"><span class="fa fa-envelope"></span> ' + data[i]["sin-leer"] + '</span>';
                }

                usuario += '</span><br>';

                $("#contactos-conectados").append(usuario);
            }
            
            if($("#panel-conversacion").attr("display") == "none"){
                $('.conectado:first').click();
            }
        } else {

            $("#contactos-conectados").addClass('alert alert-warning').html("No hay usuarios conectados");
        }

    }, "json");

}

function cargarMensajes(id) {

    $("#loading-msg img").show();
    dia = "";
    $.post('../servicios/usuarioHandler.php?action=getMensajesDeUsuario&contacto=' + id, function (data) {

        $("#loading-msg img").hide();

        $("#conversacion").html("");
        for (var i = 0, length = data.length; i < length; i++) {

            datetime = data[i]["fecha"].split(" ");
            f = new Date(Date.parse(datetime[0]));
            fecha = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
            h = datetime[1].split(":");
            hora = h[0] + ":" + h[1];

            if (dia !== fecha) {
                $("#conversacion").append('<p class="dia-chat"><span>' + fecha + '</span></p>');
                dia = fecha;
            }

            if (data[i]["emisor_id"] == id) {

                $("#conversacion").append('<p class="msg msg-amigo"><span class="fecha-chat">' + hora + '</span>' + data[i]["texto"] + '</p>');
            } else {
                $("#conversacion").append('<p class="msg msg-propio"><span class="fecha-chat">' + hora + '</span>' + data[i]["texto"] + '</p>');
            }
        }
    }, "json");
}

function cargarMensajesNuevos(id) {

    if (id != "") {
        $("#loading-msg img").show();

        $.post('../servicios/usuarioHandler.php?action=getMensajesDeUsuario&contacto=' + id + '&nuevos=1', function (data) {

            $("#loading-msg img").hide();

            for (var i = 0; i < data.length; i++) {

                if (data[i]["emisor_id"] == id) {
                    $("#conversacion").append('<p class="msg msg-amigo">' + data[i]["texto"] + '</p>');
                } else {
                    $("#conversacion").append('<p class="msg msg-propio">' + data[i]["texto"] + '</p>');
                }

                $("#conversacion").scrollTop($('#conversacion')[0].scrollHeight);
            }
        }, "json");
    }
}

function enviarMensaje() {
    texto = $("#texto").val();
    idContacto = $("#idContacto").val();


    if (texto !== "" && idContacto !== "") {

        $.post('../servicios/usuarioHandler.php?action=enviarMensaje', {texto: texto, idContacto: idContacto}, function (data) {

            $("#conversacion").append('<p class="msg msg-propio">' + data + '</p>');
            $("#texto").val("");
            $("#conversacion").animate({scrollTop: $('#conversacion')[0].scrollHeight}, 1000);
        });
    } else {
        alert("Rellene todos los campos");
    }
}

$(document).on("ready", function () {

    $("#loading-msg img").hide();

    //Evento al hacer click en "Enviar mensaje"
    $("#enviarMensaje").on("click", function () {

        enviarMensaje();
    });

    //Evento al pulsar enter en el textarea
    $("#texto").on("keyup", function (e) {

        var code = (e.keyCode ? e.keyCode : e.which);

        if (code == 13) {

            enviarMensaje();
        }
    });


    //Evento al hacer click sobre un usuario conectado
    $("#chat").on("click", ".conectado", function () {

        $("#panel-conversacion").show();

        id = $(this).attr("id").split("-")[1];
        nombre = $(this).children("a").text();

        $("#idContacto").val(id);
        $("#nombre-conversacion").text(nombre);

        cargarMensajes(id);

        clearInterval(timer);

        timer = setInterval(function () {
            cargarMensajesNuevos(id);
        }, 2000);
    });
});