<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosAdmin {

    public function __construct() {
        apunteaSec\checkAdmin();
    }

    public function anadirCarrera() {

        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $idUniversidad = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_NUMBER_INT);
        $rama = filter_input(INPUT_POST, "rama", FILTER_SANITIZE_MAGIC_QUOTES);

        $this->setUpDatabase();

        $carrera = R::dispense('carrera');
        $carrera->nombre = $nombre;
        $carrera->universidad_id = $idUniversidad;
        $carrera->rama = $rama;


        try {

            $idCarrera = R::store($carrera);
            $_SESSION["exito"] = "Carrera insertada con éxito";
            $return = "admin/perfil-carrera.php?id=" . $idCarrera;
        } catch (Exception $e) {

            $_SESSION["error"] = "Error al insertar carrera";
            $return = "admin/anadir-carrera.php";
        }

        R::close();

        return $return;
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

    public function borrarCarrera(){
        
        
        $this->setUpDatabase();
        $id= filter_input(INPUT_POST,"id", FILTER_SANITIZE_NUMBER_INT) ;
        //borramos etiquetas de apuntes
        
        $etiquetas=R::find('etiquetaapunte', 'apunte_id= :idapunte', array(':idapunte'=> $id));
        R::trashAll($etiquetas);
        //borrar interactuacion
        $interactuacion=R::find('usuariointeractuaapunte', 'apunte_id= :idapunte' ,  array(':idapunte'=> $id));
        R::trashAll( $interactuacion ); 
        //comprobar cascadas en bd 
        
        //borramos apuntes
        //borrar apunte
        $apunte=R::load('apunte', $id);
        
        R::trash( $apunte ); 
        
        R::close();
        
        
    }
}
