<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorEstandar {

    private $variables = array();

    public function __construct() {
        session_start();
    }

    public function inicio() {

        $this->setUpDatabase();
        $this->variables["universidades"] = R::getAssoc("SELECT universidad.id as id, universidad.nombre as nombre, universidad.imagenperfil as img FROM universidad, carrera, usuario WHERE universidad.id = carrera.universidad_id AND carrera.id = usuario.carrera_id GROUP BY universidad.id ORDER BY COUNT(*) DESC");
        $this->variables["carreras"] = R::getAssoc("SELECT carrera.id as id, carrera.nombre as nombre, universidad.siglas as siglasuniversidad, universidad.id as iduniversidad FROM universidad, carrera, usuario WHERE universidad.id = carrera.universidad_id AND carrera.id = usuario.carrera_id GROUP BY carrera.id ORDER BY COUNT(*) DESC");
        $asignaturas = R::getAll('SELECT asignatura.* FROM asignatura, apunte WHERE asignatura_id=asignatura.id GROUP BY asignatura_id ORDER BY COUNT(asignatura_id) DESC');
        $this->variables["asignaturas"] = R::convertToBeans('asignatura', $asignaturas);
        $this->variables["apuntes"] = R::findAll('apunte', ' ORDER BY likes - dislikes');
        $this->variables["numero-de-apuntes"] = R::count('apunte');
        R::close();

        return $this->variables;
    }

    public function universidad() {

        $this->setUpDatabase();

        if (!isset($_GET["id"])) {

            $this->variables["universidad"] = R::dispense('universidad');
            $this->variables["carreras"] = $this->variables["universidad"]->ownCarreraList;
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->variables["universidad"] = R::findOne('universidad', ' id = ?', [$id]);
            $this->variables["carreras"] = R::findAll('carrera', ' universidad_id = ? ORDER BY rama, nombre ASC', [$id]);
        }

        $this->variables["ramas"] = array(array("Artes y humanidades", "fa-paint-brush"), array("Ciencias", "fa-rocket"), array("Ciencias de la salud", "fa-user-md"), array("Ingeniería y arquitectura", "fa-cogs"), array("Ciencias sociales y jurídicas", "fa-gavel"));
        R::close();
        return $this->variables;
    }

    public function universidades() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        R::close();

        return $this->variables;
    }

    public function carrera() {

        $this->setUpDatabase();

        if (!isset($_GET["id"])) {

            $this->variables["carrera"] = R::dispense('carrera');
            $this->variables["asignaturas"] = $this->variables["carrera"]->ownAsignaturaList;
        } else {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            $this->variables["carrera"] = R::findOne('carrera', ' id = ?', [$id]);
            $this->variables["asignaturas"] = R::findAll('asignatura', ' carrera_id = ? ORDER BY curso, nombre ASC', [$id]);
        }

        R::close();
        return $this->variables;
    }

    public function carreras() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');
        $this->variables["carreras"] = R::findAll('carrera', ' ORDER BY rama, nombre ASC');

        $this->variables["ramas"] = array(array("Artes y humanidades", "fa-paint-brush"), array("Ciencias", "fa-rocket"), array("Ciencias de la salud", "fa-user-md"), array("Ingeniería y arquitectura", "fa-cogs"), array("Ciencias sociales y jurídicas", "fa-gavel"));
        R::close();
        return $this->variables;
    }

    public function registrarse() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        R::close();

        return $this->variables;
    }

    private function cargarComunes() {
        $this->variables["url"] = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_MAGIC_QUOTES);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

}
