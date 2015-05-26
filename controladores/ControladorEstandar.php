<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorEstandar {

    private $variables = array();

    public function __construct() {
        $this->cargarComunes();
    }

    public function inicio() {

        $this->setUpDatabase();
        $this->variables["universidades"] = R::getAssoc("SELECT universidad.id as id, universidad.nombre as nombre, universidad.imagenperfil as img FROM universidad, carrera, usuario WHERE universidad.id = carrera.universidad_id AND carrera.id = usuario.carrera_id GROUP BY universidad.id ORDER BY COUNT(*) DESC");
        $this->variables["carreras"] = R::getAssoc("SELECT carrera.id as id, carrera.nombre as nombre, universidad.siglas as siglasuniversidad, universidad.id as iduniversidad FROM universidad, carrera, usuario WHERE universidad.id = carrera.universidad_id AND carrera.id = usuario.carrera_id GROUP BY carrera.id ORDER BY COUNT(*) DESC");
        $this->variables["numero-de-apuntes"] = R::count('apunte');
        R::close();

        return $this->variables;
    }

    private function cargarComunes() {
        $this->variables["url"] = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_MAGIC_QUOTES);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
