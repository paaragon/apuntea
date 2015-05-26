<?php

require "../servicios/ServiciosEstandar.php";

$servicios = new ServiciosEstandar();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (method_exists($servicios, $action)) {
    $return = $servicios->$action();
} else {
    $return = $servicios->notFound();
}

header("location: ../" . $return);
