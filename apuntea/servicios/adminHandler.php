<?php

session_start();

require "../servicios/ServiciosAdmin.php";

$servicio = new ServiciosAdmin();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$params = array();

foreach ($_GET as $key => $val) {
    if ($key != "action") {
        $params[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_MAGIC_QUOTES);
    }
}

if (method_exists($servicio, $action)) {
    $return = $servicio->$action($params);
} else {
    $return = $servicio->notFound();
}

header("location: ../" . $return);
