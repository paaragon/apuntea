<?php

function getMeme() {
    $memes = array();
    $path = __DIR__ . "/../img/404";
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir)) {
        // Tratamos los elementos . y .. que tienen todas las carpetas
        if ($elemento != "." && $elemento != "..") {
            // Si es una carpeta
            if (!is_dir($path . $elemento)) {
                $memes[] = $elemento;
            }
        }
    }

    return $memes[rand(0, count($memes) - 1)];
}
