<?php

namespace apunteaSec;

function checkAdmin() {
    session_start();
//    header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
//    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//    header("Cache-Control: no-store, no-cache, must-revalidate");
//    header("Cache-Control: post-check=0, pre-check=0", false);
//    header("Pragma: no-cache");
//    if (!isset($_SESSION["idUsuario"]) && $_SESSION["tipoUsuario"] != "usuario") {
//        logout();
//        header("location: /index.php");
//        exit();
//    }
}

function checkUsuario() {

    session_start();
    header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if (!isset($_SESSION["idUsuario"]) && $_SESSION["tipoUsuario"] != "usuario") {
        logout();
        header("location: /index.php");
        exit();
    }
}

function startUsuarioSession($usuario) {
    session_start();

    $_SESSION["idUsuario"] = $usuario->id;

    if ($usuario->tipo == 1) {

        $_SESSION["tipoUsuario"] = "usuario";
    } else if ($usuario->tipo == 2) {

        $_SESSION["tipoUsuario"] == "admin";
    }
}

function startFbUserSession($fbId) {

    \R::setup('mysql:host=' . \DbConfig::$dbHost . ';dbname=' . \DbConfig::$dbName, \DbConfig::$dbUser, \DbConfig::$dbPassword);

    $usuario = \R::findOne('usuario', ' fbid = ?', [$fbId]);

    \R::close();
    
    if ($usuario != NULL) {
        $_SESSION["idUsuario"] = $usuario->id;

        if ($usuario->tipo == 1) {

            $_SESSION["tipoUsuario"] = "usuario";
        } else if ($usuario->tipo == 2) {

            $_SESSION["tipoUsuario"] == "admin";
        }
    } else {
        
        $_SESSION["error"] = "Usuario no registrado en apuntea. Por favor, registrese para acceder al área de usuario.";
        header("location: ../../registrarse.php");
        exit();
    }
}

function logout() {

    session_start();

    foreach ($_SESSION as $key => $val) {
        unset($_SESSION[$key]);
    }

    session_destroy();

    header("location: ../index.php");
    exit();
}
