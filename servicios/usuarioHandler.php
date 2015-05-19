<?php

require "../servicios/ServiciosUsuario.php";

$servicios = new ServiciosUsuario();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$params = array();

foreach ($_GET as $key => $val) {
    if ($key != "action") {
        $params[$key] = $val;
    }
}

if (method_exists($servicios, $action)) {
    $return = $servicios->$action($params);
} else {
    $return = $servicios->notFound();
}

if (!isJson($return)) {
    header("location: ../" . $return);
} else {
    echo $return;
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
