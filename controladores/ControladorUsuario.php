<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {

    private $variables = array();

    public function __construct() {
        apunteaSec\checkUsuario();
        
        $this->setUpDatabase();
        $this->cargarComunes();
        R::close();
    }
    
    public function inicio(){
        
        return $this->variables;
    }

    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
