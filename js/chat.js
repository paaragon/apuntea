
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

                usuario = '<div class="conectado" id="con-' + data[i]["usuario"]["id"] + '"><p class="imagen"><img src="../img/usuarios/perfil/' + data[i]["usuario"]["avatar"] + '"></p><p class="nombre"><a href="#">' + data[i]["usuario"]["nombre"] + '</a>';

                if (data[i]["sin-leer"] !== 0) {
                    usuario += ' <span class="badge"><span class="fa fa-envelope"></span> ' + data[i]["sin-leer"] + '</span>';
                }

                usuario += '</p><div class="clearfix"></div></div>';

                $("#contactos-conectados").append(usuario);
            }

            if ($("#panel-conversacion").attr("display") == "none") {
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

            data[i]["texto"] = decodeEmoji(data[i]["texto"]);

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

                datetime = data[i]["fecha"].split(" ");
                f = new Date(Date.parse(datetime[0]));
                fecha = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
                h = datetime[1].split(":");
                hora = h[0] + ":" + h[1];

                if (dia !== fecha) {
                    $("#conversacion").append('<p class="dia-chat"><span>' + fecha + '</span></p>');
                    dia = fecha;
                }

                data[i]["texto"] = decodeEmoji(data[i]["texto"]);

                if (data[i]["emisor_id"] == id) {

                    $("#conversacion").append('<p class="msg msg-amigo"><span class="fecha-chat">' + hora + '</span>' + data[i]["texto"] + '</p>');
                } else {
                    $("#conversacion").append('<p class="msg msg-propio"><span class="fecha-chat">' + hora + '</span>' + data[i]["texto"] + '</p>');
                }

                $("#conversacion").scrollTop($('#conversacion')[0].scrollHeight);
            }
        }, "json");
    }
}

function enviarMensaje() {
    texto = $("#texto").val();
    idContacto = $("#idContacto").val();

    texto = buscarEmoji(texto);

    if (texto !== "" && idContacto !== "") {
        $("#texto").val("");
        $.post('../servicios/usuarioHandler.php?action=enviarMensaje', {texto: texto, idContacto: idContacto}, function (data) {

            datetime = data["fecha"].split(" ");
            f = new Date(Date.parse(datetime[0]));
            fecha = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
            h = datetime[1].split(":");
            hora = h[0] + ":" + h[1];

            if (dia !== fecha) {
                $("#conversacion").append('<p class="dia-chat"><span>' + fecha + '</span></p>');
                dia = fecha;
            }

            data["texto"] = decodeEmoji(data["texto"]);

            $("#conversacion").append('<p class="msg msg-propio"><span class="fecha-chat">' + hora + '</span>' + data["texto"] + '</p>');

            $("#conversacion").scrollTop($('#conversacion')[0].scrollHeight);
        }, "json");
    } else {
        alert("Rellene todos los campos");
    }
}

var emoji = [
    {'char': 'XD', 'alias': 'laughing', 'class': 'twa twa-laughing'},
    {'char': ':*', 'alias': 'kissing_heart', 'class': 'twa twa-kissing-heart'},
    {'char': ':D', 'alias': 'smile', 'class': 'twa twa-smile'},
    {'char': ';)', 'alias': 'wink', 'class': 'twa twa-wink'},
    {'char': ':_(', 'alias': 'cry', 'class': 'twa twa-cry'},
    {'char': '¬¬', 'alias': 'unamused', 'class': 'twa twa-unamused'},
    {'char': 'zzz', 'alias': 'sleeping', 'class': 'twa twa-sleeping'},
    {'char': '^^', 'alias': 'blush', 'class': 'twa twa-blush'},
    {'char': '<3', 'alias': 'heart', 'class': 'twa twa-heart'}
];
function buscarEmoji(texto) {

    for (var i = 0; i < emoji.length; i++) {

        while ((index = texto.indexOf(emoji[i]["char"])) != -1) {
            em = '[' + emoji[i]["alias"] + ']';
            texto = texto.substring(0, index) + em + texto.substring(index + emoji[i]["char"].length, texto.length);
        }
    }

    return texto;
}

function decodeEmoji(texto) {

    for (var i = 0; i < emoji.length; i++) {
        while ((index = texto.indexOf('[' + emoji[i]["alias"] + ']')) != -1) {
            em = '<span class="' + emoji[i]["class"] + ' twa-lg"></span>';
            texto = texto.substring(0, index) + em + texto.substring(index + emoji[i]["alias"].length + 2, texto.length);
        }
    }

    return texto;
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