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

	public function resultadoBusqueda(){
        
        $busqueda= filter_var($_POST["busqueda"], FILTER_SANITIZE_MAGIC_QUOTES);
        
        $this->setUpDatabase();
        
        //apuntes por etiquetas, carreras, asignaturas, universidaddes y usuarios (grupos con visibilidad para mi o total)
        $resultadosapuntes = R::exec('SELECT * FROM apunte,etiquetaapunte,etiqueta WHERE etiqueta.titulo='.$busqueda. 
                ' AND etiquetaapunte.id=etiqueta.id AND apunte.id=etiquetaapunte.apunte_id');
        
        $this->variables["apuntes"] = $resultadosapuntes;
        
        return $this->variables;
    }
	
    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::load('usuario', $_SESSION["idUsuario"]);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
