<?php

class Like {

    private $apunte;

    public function __construct($apunte) {
        $this->apunte = $apunte;
    }

    public function generateLike() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $this->apunte->id]);
        $class = ($interaccion != null && $interaccion->like == 1) ? " iLike" : "";
        return '<span class="fa fa-thumbs-o-up likeBtn' . $class . '" id="l' . $this->apunte->id . '"></span> <span class="likeValue">' . $this->apunte->likes . '</span>';
    }

    public function generateAjaxScript() {

        return '$(".likeBtn").on("click", function () {'
                . 'like = $(this);'
                . 'likeValue = $(this).next(".likeValue");'
                . 'id = $(this).attr("id").substring(1);'
                . '$.post("../servicios/usuarioHandler.php?action=like", {idApunte: id}, function (data) {'
                . 'if (data != false) {'
                . 'likeValue.text(parseInt(likeValue.text()) + 1);'
                . 'like.addClass("iLike");'
                . 'dislike = like.parent("span").next("span").children(".dislikeBtn");'
                . 'dislikeValue = dislike.next(".dislikeValue");'
                . 'if (dislike.hasClass("iDislike")) {'
                . 'dislike.removeClass("iDislike");'
                . 'dislikeValue.text(parseInt(dislikeValue.text()) - 1);'
                . '}'
                . '}'
                . '}, "json");'
                . '});';
    }

}
