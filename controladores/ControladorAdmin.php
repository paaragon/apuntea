<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorAdmin {

    private $variables = array();

    
    public function __construct() {
        apunteaSec\checkAdmin();
        $this->cargarComunes();
        }

    public function inicioAdmin(){
          $this->setUpDatabase();
          $this->variables["numcarreras"]= R::count('carrera');
          $this->variables["numuniversidades"]= R::count('usuario');
          $this->variables["numapuntes"]= R::count('apunte');
          $this->variables["numasignaturas"]= R::count('asignatura');
          
          
          return $this->variables;
    }
    
    public function anadirCarrera() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        return $this->variables;
    }

    private function cargarComunes() {
        
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
