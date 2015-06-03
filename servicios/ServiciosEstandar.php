<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../security/security.php";

class ServiciosEstandar {

    public function __construct() {
        session_start();
    }

    public function doLogin($params) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_MAGIC_QUOTES);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();
        $usuario = R::findOne('usuario', ' nick = "' . $username . '"');

        if ($usuario == NULL || !password_verify($password, $usuario->password)) {
            echo "Mal";
            $_SESSION["login-error"] = "Usuario o contraseña incorrectos";
            return "index.php";
        }

        R::close();

        if ($usuario->tipo == 1) {
            apunteaSec\startUsuarioSession($usuario);
            return "usuario/inicio.php";
        } else if ($usuario->tipo == 2) {
            apunteaSec\startUsuarioSession($usuario);
            return "admin/inicio.php";
        } else {
            apunteaSec\logout();
        }
    }

    public function registrarse() {

        require __DIR__ . "/../util/CropAvatar.php";

        if (isset($_SESSION["fbid"])) {

            $this->setUpDatabase();

            $alias = filter_var($_SESSION["alias"], FILTER_SANITIZE_MAGIC_QUOTES);
            $nombre = filter_var($_SESSION["nombre"], FILTER_SANITIZE_MAGIC_QUOTES);
            $apellidos = filter_var($_SESSION["apellidos"], FILTER_SANITIZE_MAGIC_QUOTES);
            $fbid = filter_var($_SESSION["fbid"], FILTER_SANITIZE_NUMBER_INT);
            $fbavatar = $_SESSION["avatar"];
            $fbcover = $_SESSION["cover"];

            $usuario = R::dispense('usuario');
            $usuario->nombre = $nombre;
            $usuario->apellidos = $apellidos;
            $usuario->nick = $alias;
            $usuario->fbid = $fbid;

            $avatar = imagecreatefromjpeg($fbavatar);
            $avatarname = $alias . "_" . rand(0, 2048);
            imagejpeg($avatar, '../img/usuarios/perfil/' . $avatarname . '.jpg');
            $usuario->avatar = $avatarname . '.jpg';

            $portada = imagecreatefromjpeg($fbcover);
            $portadaname = $alias . "_" . rand(0, 2048);
            imagejpeg($portada, '../img/usuarios/portada/' . $portadaname . '.jpg');
            $usuario->imagenportada = $portadaname . '.jpg';


            R::store($usuario);
            $_SESSION["exito"] = "Registro completado. Enra en la página a través de la sección \"Acceder\" del panel lateral.";
            return "index.php";
        } else {

            $alias = filter_input(INPUT_POST, "alias", FILTER_SANITIZE_MAGIC_QUOTES);
            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
            $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_MAGIC_QUOTES);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_MAGIC_QUOTES);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_MAGIC_QUOTES);
            $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT);
            $imgPerfil = $_FILES["img-perfil"];
            $perfilData = filter_input(INPUT_POST, "img-perfil-data", FILTER_SANITIZE_MAGIC_QUOTES);
            $perfilSrc = filter_input(INPUT_POST, "img-perfil-src", FILTER_SANITIZE_MAGIC_QUOTES);
            $imgPortada = $_FILES["img-portada"];
            $portadaData = filter_input(INPUT_POST, "img-portada-data", FILTER_SANITIZE_MAGIC_QUOTES);
            $portadaSrc = filter_input(INPUT_POST, "img-portada-src", FILTER_SANITIZE_MAGIC_QUOTES);


            if ($password != $password2) {

                $_SESSION["error"] = "Error. Las contraseñas deben coincidir";
                header("location: ../registrarse.php");
                exit();
            }

            $this->setUpDatabase();

            $usuario = R::dispense('usuario');
            $usuario->carrera_id = $carrera;
            $usuario->ultimaconexion = date("Y-m-d H:i:s", time());
            $usuario->nombre = $nombre;
            $usuario->apellidos = $apellidos;
            $usuario->nick = $alias;
            $usuario->password = password_hash($password, PASSWORD_DEFAULT);
            $usuario->email = $email;
            $usuario->fbid = $fbid;


            $crop = new CropAvatar($perfilSrc, $perfilData, $imgPerfil, "usuarios/perfil");
            $response = array(
                'state' => 200,
                'message' => $crop->getMsg(),
                'result' => $crop->getResult()
            );

            $namearr = explode("/", $crop->getResult());
            $usuario->avatar = $namearr[5];

            $crop2 = new CropAvatar($portadaSrc, $portadaData, $imgPortada, "usuarios/portada");
            $response2 = array(
                'state' => 200,
                'message' => $crop2->getMsg(),
                'result' => $crop2->getResult()
            );

            $namearr2 = explode("/", $crop2->getResult());
            $usuario->imagenportada = $namearr2[4];

            R::store($usuario);


            $_SESSION["exito"] = "Registro completado. Revisa tu email para activar tu cuenta.";

            return "index.php";
        }
    }

    public function getCarreras() {

        $id = filter_input(INPUT_POST, "idUniversidad", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $carreras = R:: findAll('carrera', ' universidad_id = ?', [$id]);

        R::close();

        return json_encode(R::exportAll($carreras));
    }

    public function notFound() {

        return "404.php";
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
