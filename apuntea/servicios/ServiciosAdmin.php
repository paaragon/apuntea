<?php

require __DIR__ . "/../security/security.php";
require __DIR__ . "/../DB/rb.php";
require __DIR__ . "/../DB/DbConfig.php";

class ServiciosAdmin {

    public function __construct() {
        apunteaSec\checkAdmin();
    }

   
    //Añadimos la carrera
    public function anadirAsignatura(){
        
        $idCarrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_MAGIC_QUOTES);
        $curso = filter_input(INPUT_POST, "curso",  FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
       
        /*
        Necesitmoas el ide de la univiserdad para saber
         * a que carrera pertenece ?? pero la tabla
         * no tiene este id?
         * 
         * y en descripcion que se pone ?
         *          */
        //$idUniversidad = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_NUMBER_INT);
        
        
        //Conectamos a bd
        $this->setUpDatabase();
        
        //Obtenemos la asignatura
        $asignatura = R::dispense('asignatura');
        
        $asignatura->carrera_id = $idCarrera;
        $asignatura->curso = $curso;
        $asignatura->nombre = $nombre;
        
        
        try {

            $idAsignatura = R::store($asignatura);
            $_SESSION["exito"] = "Asignatura insertada con éxito";
            $return = "admin/asignatura.php?id=" . $idAsignatura;
        } catch (Exception $e) {

            $_SESSION["error"] = "Error al insertar asignatura";
            $return = "admin/asignturas-nuevas.php";
        }

        R::close();

        return $return;
        
        
    }
    
    public function borrarAsignatura($parametros) {
        
        
          /*
          usar parametros obtenemos el id por este parametro
         *          */

        try {
            $this->setUpDatabase();

            //Ceamos un bean
            $asignatura = R::load('asignatura', $parametros['idAsignatura']);
            //Borramos 
            R::trash($asignatura);

            $_SESSION["exito"] = $asignatura->nombre . " - (" . $asignatura->carrera->nombre . ") borrada con éxito";
            $return = "admin/asignaturas.php";
        } catch (Exception $ex) {

            $_SESSION["error"] = "Error al borrar asignatura";
            $return = "admin/asignaturas.php";
        }


        R::close();

        return $return;
        
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
    
     public function borrarCarrera($parametros) {

        /*
          usar parametros obtenemos el id por este parametro
         *          */

        try {
            $this->setUpDatabase();

            //CReamos un bean
            $carrera = R::load('carrera', $parametros['idCarrera']);
            //Borramos 
            R::trash($carrera);

            $_SESSION["exito"] = $carrera->nombre . " - (" . $carrera->universidad->siglas . ") borrada con éxito";
            $return = "admin/carreras.php";
        } catch (Exception $ex) {

            $_SESSION["error"] = "Error al borrar carrera";
            $return = "admin/carreras.php";
        }


        R::close();

        return $return;
    }


    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
