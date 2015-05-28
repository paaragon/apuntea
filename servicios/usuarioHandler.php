<?php

require "../servicios/ServiciosUsuario.php";

$servicio = new ServiciosUsuario();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (method_exists($controlador, $action)) {
    $return = $controlador->$action();
} else {
    $return = $controlador->notFound();
}

header("location: ../" . $return);
