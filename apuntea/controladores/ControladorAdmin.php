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

    public function anadirCarrera() {

        $this->setUpDatabase();

        $this->variables["universidades"] = R::findAll('universidad');

        return $this->variables;
    }
    
    
    public function anadirAsignatura() {

        //Establecemos conexion con bd
        $this->setUpDatabase();

       
        //Para obtener las universidades disponibles
         $this->variables["universidades"] = R::findAll('universidad');
         
         //Para obtener las carreras disponibles
          $this->variables["carrera"] = R::findAll('carrera');
        

        return $this->variables;
    }
    
    
    
    
    

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        return $this->variables;
    }

    public function asignatura($carrera = "") {

        $this->setUpDatabase();

        $this->variables["asignaturas"] = ($carrera != "") ? R::find("asignatura", " carrera_id = " . $carrera) : R::findAll("asignatura");
        $this->variables["carreras"] = R::findAll("carrera");

        return $this->variables;
    }
    
    private function cargarComunes() {
        
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
