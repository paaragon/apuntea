$(document).on("ready", function () {
    alert("asdf");
    $(".likeBtn").on("click", function () {

        like = $(this);
        id = like.attr('id').substring(1);

        $.post('../servicios/usuarioHandler.php?action=like', {idApunte: id}, function (data) {
            if (data == "") {
                like.text(intVal(like.text()) + 1);
                like.addClass('iLike');
                dislike = like.next('.dislikeBtn');
                dislikeValue = dislike.next('.dislikeValue');
                if (dislike.hasClass("iDislike")) {
                    dislike.removeClass("iDislike");
                    dislikeValue.text(parseInt(dislikeValue.text()) - 1);
                }
            }
        });
    });
});