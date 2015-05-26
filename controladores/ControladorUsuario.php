<?php

require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
require __DIR__ . "/../security/security.php";

class ControladorUsuario {

    private $variables = array();

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

    private function cargarComunes() {
        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);
    }

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function inicio() {
        return $this->variables;
    }

    public function resultadoBusqueda() {

        $busqueda = filter_var($_POST["busqueda"], FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        //apuntes por etiquetas, carreras, asignaturas, universidaddes y usuarios (grupos con visibilidad para mi o total)
        $resultadosapuntes = R::exec('SELECT * FROM apunte,etiquetaapunte,etiqueta WHERE etiqueta.titulo=' . $busqueda .
                        ' AND etiquetaapunte.id=etiqueta.id AND apunte.id=etiquetaapunte.apunte_id');

        $this->variables["apuntes"] = $resultadosapuntes;

        return $this->variables;
    }

    public function miConfiguracion() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["usuario"] = R::findOne('usuario', " id=?", [$idUsuario]);
        $this->variables["universidades"] = R::findAll('universidad');
        if ($this->variables["usuario"]->carrera_id == NULL) {
            $this->variables["usuario"]->carrera = R::dispense('carrera');
            $this->variables["usuario"]->carrera->universidad = R::dispense('universidad');
        }
        if ($this->variables["usuario"]->direccion == NULL) {
            $this->variables["usuario"]->direccion = "";
        }
        R::close();
        return $this->variables;
    }

    public function subirApuntes() {
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $this->variables["universidades"] = R::findAll('universidad');
        $misAlice = R::findAll('contacto', " bob_id=?", [$idUsuario]);
        $misBob = R::findAll('contacto', " alice_id=?", [$idUsuario]);
        $this->variables["usuario"] = R::findOne( "usuario", " id=?", [$idUsuario] );
        foreach ($misAlice as $a) {
            $this->variables["contactos"][] = $a->fetchAs('usuario')->alice;
        }
        foreach ($misBob as $b) {
            $this->variables["contactos"][] = $b->fetchAs('usuario')->bob;
        }

        if (isset($this->variables["contactos"])) {
            usort($this->variables["contactos"], "cmp");
        }
        R::close();
        return $this->variables;
    }

}

function cmp($a, $b) {
    if ($a->nombre == $b->nombre) {
        return 0;
    }
    return ($a->nombre < $b->nombre) ? -1 : 1;
}
