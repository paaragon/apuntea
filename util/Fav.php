<?php

class Fav {

    private $apunte;

    public function __construct($apunte) {
        $this->apunte = $apunte;
    }

    public function generateFav() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $interaccion = R::findOne('usuariointeractuaapunte', ' usuario_id = ? AND apunte_id = ?', [$idUsuario, $this->apunte->id]);
        $class = ($interaccion != null && $interaccion->favorito == 1) ? " apunte-favorito" : "";
        return '<span class="fa fa-star favBtn' . $class . '" id="f' . $this->apunte->id . '"></span>';
    }

    public function generateAjaxScript() {

        return '$(".favBtn").on("click", function () {'
                . 'fav = $(this);'
                . 'id = $(this).attr("id").substring(1);'
                . '$.post("../servicios/usuarioHandler.php?action=fav", {idApunte: id}, function (data) {'
                . 'if (data == true) {'
                . 'fav.addClass("apunte-favorito");'
                . '}else if(data == false){'
                . 'fav.removeClass("apunte-favorito");'
                . '}'
                . '}, "json");'
                . '});';
    }

}
