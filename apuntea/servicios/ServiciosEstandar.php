<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../security/security.php";

class ServiciosEstandar {

    public function __construct() {
        
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
        echo "Bien";
        apunteaSec\startUsuarioSession($usuario);

        return "usuario/inicio.php";
    }

    public function notFound() {

        return "404.php";
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
