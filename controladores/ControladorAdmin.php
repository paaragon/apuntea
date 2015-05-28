<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorAdmin {
    private $variables = array();
    public function __construct() {
        apunteaSec\checkAdmin();
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
        R::close();
        return $this->variables;
    }
   
    public function anadirUniversidad(){
        $this->setUpDatabase();
        R::close();
        return $this->variables;
    }
  
    public function carreras($universidad = "") {
        $this->setUpDatabase();
        $this->variables["carreras"] = ($universidad != "") ? R::find("carrera", " universidad_id = " . $universidad) : R::findAll("carrera");
        $this->variables["universidades"] = R::findAll("universidad");
        return $this->variables;
    }
    public function asignatura($carrera = "") {
        $idCarrera = (isset($_POST["carrera"])) ? filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_NUMBER_INT) : "";
        $nombre = (isset($_POST["nombre"])) ? filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES) : "";
        $this->setUpDatabase();
        if ($idCarrera == "") {
            $this->variables["asignaturas"] = R::findAll("asignatura");
        } else {
            $this->variables["asignaturas"] = R::findAll("asignatura", " carrera_id = ? AND LOWER(nombre) LIKE ?", [$idCarrera, "%" . strtolower($nombre) . "%"]);
        }
        $this->variables["universidades"] = R::findAll("universidad");
        R::close();
        return $this->variables;
    }
    public function universidad(){
        $idUniversidad = (isset($_GET["id"])) ? filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) : "";
        $this->setUpDatabase();
        if ($idUniversidad == "") {
            $this->variables["universidades"] = R::findAll("universidad");

      
        foreach($this->variables["universidades"] as $uni){
            $acumapun=0;
            $carr=$uni->ownCarreraList;
            foreach ($carr as $c){
                $asign=$c->ownAsignaturaList;
                    foreach ($asign as $a){
                        $acumapun+=count($a->ownApunteList);
                    }
                }
             $uniapun[$uni->id]=$acumapun;
        }
         $this->variables['uniapun']=$uniapun;
       
        } else {
            $this->variables["universidades"] = R::findOne("universidad", " id = " . $idUniversidad);
            
        }
        R::close();
        return $this->variables;
    }
    
    public function getUniversidad(){
        
        $idUniversidad = (isset($_GET["id"])) ? filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) : "";
        $this->setUpDatabase();
        $this->variables["universidades"] = R::findOne("universidad", " id=? ", [$idUniversidad]);
        $uni= $this->variables["universidades"];

        $this->variables["carreras"] = $uni->ownCarreraList;
        
        foreach ($this->variables["carreras"] as $carrera){
            foreach($carrera->ownAsignaturaList as $asig){
                $this->variables["asignaturas"][] = $asig;
            }
        }

        foreach ($this->variables["carreras"] as $carrera){
            foreach($carrera->ownUsuarioList as $user){
                $this->variables["usuarios"][] = $user;
            }
        }
        
        foreach($this->variables["usuarios"] as $usuario){
             foreach($usuario->ownApunteList as $apunte){
                 $this->variables["apuntes"][] =  $apunte;
            }      
        }
        
        
        R::close();
        return $this->variables;
    }
    
    
    
    public function miConfiguracion() {
        //Obtencion de la idUsuario
        $idAdmin = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        //Establecemos conexion con bd
        $this->setUpDatabase();
        $this->variables["admin"] = R::findOne('usuario', " id=?", [$idAdmin]);
        R::close();
        return $this->variables;
    }
    
    public function mostrarUsuarios($idUniversidad) {
        $carreras = R::find("carrera", " universidad_id=? ", [$idUniversidad]);
        $this->variables["universidades"] = $usuarios= R::find("usuario", " carrera_id=? ", [$carreras]);
        
        return $usuarios;
    }
    
    
    private function cargarComunes() {
        
    }
    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }
    
}
