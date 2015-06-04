<?php

class Dislike {

    private $apunte;

    public function __construct($apunte) {
        $this->apunte = $apunte;
    }

    public function generateDislike() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $this->apunte->id]);
        $class = ($interaccion != null && $interaccion->like == -1) ? " iDislike" : "";
        return '<span class="fa fa-thumbs-o-down dislikeBtn' . $class . '" id="d' . $this->apunte->id . '"></span> <span class="dislikeValue">' . $this->apunte->dislikes . '</span>';
    }

    public function generateAjaxScript() {

        return '$(".dislikeBtn").on("click", function () {'
                . 'dislike = $(this);'
                . 'dislikeValue = $(this).next(".dislikeValue");'
                . 'id = $(this).attr("id").substring(1);'
                . '$.post("../servicios/usuarioHandler.php?action=dislike", {idApunte: id}, function (data) {'
                . 'if (data != false) {'
                . 'dislikeValue.text(parseInt(dislikeValue.text()) + 1);'
                . 'dislike.addClass("iDislike");'
                . 'like = dislike.parent("span").prev("span").children(".likeBtn");'
                . 'likeValue = like.next(".likeValue");'
                . 'if (like.hasClass("iLike")) {'
                . 'like.removeClass("iLike");'
                . 'likeValue.text(parseInt(likeValue.text()) - 1);'
                . '}'
                . '}'
                . '}, "json");'
                . '});';
    }

}
