<?php

session_start();

require "../servicios/ServiciosAdmin.php";

$servicio = new ServiciosAdmin();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (method_exists($servicio, $action)) {
    $return = $servicio->$action();
} else {
    $return = $servicio->notFound();
}

header("location: ../" . $return);
