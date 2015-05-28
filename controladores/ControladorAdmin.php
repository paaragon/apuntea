<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";
//require __DIR__ . "/../controladores/ControladorUsuario.php";

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

    public function carreras($universidad = "") {

        $this->setUpDatabase();

        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");

        return $this->variables;
    }

    public function usuarios() {
        $this->setUpDatabase();

        $this->variables["usuarios"] = R::findAll('usuario', " tipo != 2 ");

        R::close();

        return $this->variables;
    }

    public function usuario() {

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
       
        $this->setUpDatabase();

        //Usuario
        $this->variables["usuario"] = R::findOne("usuario", "id = ?", [$id]);
      
        //Carrera usuario
        $this->variables["carrera"] = R::findOne("carrera", "id = " . $this->variables["usuario"]->carrera_id);
        
        //Universidad usuario
        $this->variables["universidad"] = R::findOne("universidad", "id = " . $this->variables["carrera"]->universidad_id);

        //Apuntes usuario
        $this->variables["apuntes"] = R::findAll("apunte", "usuario_id = ?", [$id]);
        
        //Grupos usuario
        $this->variables["usuariogrupo"] = R::findAll("usuariogrupo", "usuario_id = ?", [$id]);
        
        foreach ($this->variables["usuariogrupo"] as $usuariogrupo):
            $this->variables["grupos"] = R::findAll("grupo", "id = " . $usuariogrupo->grupo_id);
        endforeach;
        
        //Amigos usuario
        $user = R::load('usuario', $id);
      
        $misBob = $user->alias('alice')->ownContactoList;
        foreach ($misBob as $b) {
            $contacto = $b->fetchAs('usuario')->bob;
            $this->variables["amigos"][$contacto->nombre] = $contacto;
        }
        
        $misAlice = $user->alias('bob')->ownContactoList;
        foreach ($misAlice as $a) {
            $contacto = $a->fetchAs('usuario')->alice;
            $this->variables["amigos"][$contacto->nombre] = $contacto;
        }

        usort($this->variables["amigos"], array("self", "cmp"));
       
        R::close();

        return $this->variables;
    }
    
     public function apuntes() {

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();
        
        $this->variables["apuntes"] = R::findAll("apunte", "usuario_id = ?", [$id]);

        R::close();

        return $this->variables;
    }

    private function cargarComunes() {}
    
    private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
