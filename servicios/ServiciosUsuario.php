<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosUsuario {

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function getUsuariosConectados() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $usuario = R::findOne('usuario', ' id = ' . $idUsuario);
        $usuario->ultimaconexion = date("Y-m-d H:i:s");
        R::store($usuario);

        $usuariosConectados = R::findAll('usuario', ' TIMESTAMPDIFF(SECOND, NOW(), ultimaconexion) >= -30 AND (id IN (SELECT alice_id FROM contacto WHERE bob_id = ' . $idUsuario . ' AND admitido = 1) OR id IN (SELECT bob_id FROM contacto WHERE alice_id = ' . $idUsuario . ' AND admitido = 1))');

        $infoConectados = array();

        foreach ($usuariosConectados as $usu) {

            $sinleer = R::count('mensaje', ' emisor_id = ' . $usu->id . ' AND receptor_id = ' . $idUsuario . ' AND visto = 0');

            $infoConectados[] = array("usuario" => array("nombre" => $usu->nombre, "apellidos" => $usu->apellidos, "id" => $usu->id, "avatar" => $usu->avatar), "sin-leer" => $sinleer);
        }
        R::close();

        echo json_encode($infoConectados);
    }

    public function getMensajesDeUsuario($params) {

        $idContacto = $params["contacto"];
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        if (!isset($params["nuevos"])) {

            $mensajes = R::findAll('mensaje', ' emisor_id = ' . $idContacto . ' AND receptor_id = ' . $idUsuario . ' OR emisor_id = ' . $idUsuario . ' AND receptor_id = ' . $idContacto . ' ORDER BY fecha');
        } else {

            $mensajes = R::findAll('mensaje', ' emisor_id = ' . $idContacto . ' AND receptor_id = ' . $idUsuario . ' AND visto = 0 ORDER BY fecha');
        }
        foreach ($mensajes as $mensaje) {

            if ($mensaje->visto == 0 && $mensaje->emisor_id == $idContacto) {
                $mensaje->visto = 1;
                R::store($mensaje);
            }
        }

        R::close();

        echo json_encode(R::exportAll($mensajes));
    }

    public function enviarMensaje() {

        $idContacto = filter_input(INPUT_POST, "idContacto", FILTER_SANITIZE_NUMBER_INT);
        $texto = filter_input(INPUT_POST, "texto", FILTER_SANITIZE_MAGIC_QUOTES);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $mensaje = R::dispense('mensaje');
        $mensaje->emisor_id = $idUsuario;
        $mensaje->receptor_id = $idContacto;
        $mensaje->texto = $texto;
        $mensaje->fecha = date("Y-m-d H:i:s", time());
        $mensaje->visto = 0;

        try {
            R::store($mensaje);
            echo json_encode($mensaje->export());
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function logout() {

        apunteaSec\logout();
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
