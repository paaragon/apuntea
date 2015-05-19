<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ControladorUsuario {

    private $variables = array();

    public function __construct() {
        apunteaSec\checkUsuario();
    }

    public function inicio() {

        $this->setUpDatabase();
        R::close();
        return $this->variables;
    }

    public function misApuntes(){
        //porsiaca se filtra
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        
        $misapuntes= R::findAll('apunte', 'usuario_id = ?',[$idUsuario]);
        
        $this->variables["apuntes"]=$misapuntes;
        
         R::close();

        return $this->variables;
    }
    public function resultadoBusqueda() {

        $busqueda = filter_var($_POST["busqueda"], FILTER_SANITIZE_MAGIC_QUOTES);
        $this->variables["busqueda"]=$busqueda;
        $this->setUpDatabase();
        
        //apuntes por etiquetas, carreras, asignaturas, universidades y usuarios (grupos con visibilidad para mi o total)
        $resultadosapuntesporetiquetas = R::getAll('SELECT apunte.* FROM apunte,etiquetaapunte,etiqueta WHERE LOWER(etiqueta.titulo) '
                . 'LIKE ? AND etiquetaapunte.etiqueta_id=etiqueta.id AND apunte.id=etiquetaapunte.apunte_id',['%'.strtolower($busqueda).'%'] );
                    $apuntes = R::convertToBeans( 'apunte', $resultadosapuntesporetiquetas );
        $resultadosapuntesportitulo= R::find('apunte', ' apunte.titulo LIKE ?',  ['%'.strtolower($busqueda).'%']);
        
        $resultado=$resultadosapuntesporetiquetas+$resultadosapuntesportitulo;
        $this->variables["apuntes"] = $resultado;
        
       
        $resultadocarreras=R::find('carrera', ' LOWER(carrera.nombre) LIKE :nombre OR LOWER(carrera.rama) LIKE :rama', 
                    array(':nombre'=>'%'.strtolower($busqueda).'%',':rama'=>'%'.strtolower($busqueda).'%'));
        
        foreach($resultadocarreras as $car){
            $acum=0;
            $asig=$car->ownAsignaturaList;
            foreach ($asig as $as){
              $acum+=count($as->ownApunteList);
            }
            $carapuntes[$car->id]= $acum;
        }
        
        $this->variables['carapuntes']=$carapuntes;
        
        $this->variables["carreras"] =$resultadocarreras;
         
        $resultadousuarios=R::getAll('SELECT usuario.* FROM usuario WHERE usuario.privacidadbuscador=1
                AND (LOWER(usuario.nick) LIKE :nick OR LOWER(usuario.nombre) LIKE :nombre '
                  . 'OR LOWER(usuario.apellidos) LIKE :apellido)',
                     array(  ':nick' => '%'.strtolower($busqueda).'%', ':nombre' => '%'.strtolower($busqueda).'%',  ':apellido' => '%'.strtolower($busqueda).'%' ));
                     $personas = R::convertToBeans( 'usuario', $resultadousuarios );
        $this->variables["usuarios"] =$personas;
        
        
       
        $asignaturas=R::find('asignatura','LOWER(asignatura.nombre) LIKE :nombre OR LOWER(asignatura.descripcion) LIKE :desc',
                array(':nombre'=>'%'.strtolower($busqueda).'%',':desc'=>'%'.strtolower($busqueda).'%'));
        $this->variables["asignaturas"] =$asignaturas;
        
        
        
        $resultadouniversidades=R::findAll('universidad','LOWER(universidad.nombre) LIKE :nombre OR LOWER(universidad.descripcion) LIKE :desc '
                . 'OR LOWER(universidad.siglas) LIKE :siglas',array(':nombre'=>'%'.strtolower($busqueda).'%',':desc'=>$busqueda, ':siglas'=>$busqueda));
        
        foreach($resultadouniversidades as $uni){
            $acumal=0;
            $acumapun=0;
            $carr=$uni->ownCarreraList;
            foreach ($carr as $c){
                $acumal+=count($c->ownUsuarioList);
                $asign=$c->ownAsignaturaList;
                    foreach ($asign as $a){
                        $acumapun+=count($a->ownApunteList);
                    }
                    
                }
             $unialum[$uni->id]=$acumal;
             $uniapun[$uni->id]=$acumapun;
        }
        
        $this->variables["universidades"]= $resultadouniversidades;
        $this->variables['uniapun']=$uniapun;
        $this->variables['unialum']=$unialum;
        
        R::close();
        
        return $this->variables;
    }

    private function cargarComunes() {

        $this->variables["usuario-actual"] = R::findOne('usuario', " id = ?", [$_SESSION["idUsuario"]]);
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
        $this->cargarComunes();
    }

}
