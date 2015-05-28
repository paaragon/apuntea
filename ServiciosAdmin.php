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
        //Añadimos la carrera
    }  
        
    public function anadirAsignatura() {
        $idCarrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_MAGIC_QUOTES);
        $curso = filter_input(INPUT_POST, "curso", FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_SANITIZE_MAGIC_QUOTES);
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
        $asignatura->apellidos = $apellidos;
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
    
     public function anadirUniversidad() {
         
        $nombre = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_MAGIC_QUOTES);
        $siglas= filter_input(INPUT_POST, "alias", FILTER_SANITIZE_NUMBER_INT);
        $descripcion = filter_input(INPUT_POST, "descripcion", FILTER_SANITIZE_MAGIC_QUOTES);
        $logo = "upm-T.gif";
        $portada ="UPM-FI--06--Bloque_1.jpg";
        
        $this->setUpDatabase();
      
        $universidad = R::dispense('universidad');
        $universidad->nombre = $nombre;
        $universidad->siglas = $siglas;
        $universidad->descripcion = $descripcion;
        $universidad->imagenperfil= $logo;
        $universidad->imagenportada = $portada;
     
        try {
            $idUniversidad = R::store($universidad);
            $_SESSION["exito"] = "Universidad insertada con éxito";
            $return = "admin/universidad.php?id=" . $idUniversidad;
        } catch (Exception $e) {
            $_SESSION["error"] = "Error al insertar universidad";
            $return = "admin/universidad-nueva.php";
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
        
    public function borrarUniversidad($parametros) {
    
        try {
            $this->setUpDatabase();
            //Ceamos un bean
            $universidad = R::load('universidad', $parametros['idUniversidad']);
            //Borramos 
            R::trash($universidad);
            $_SESSION["exito"] = $universidad->nombre . "  borrada con éxito";
            $return = "admin/universidades.php";
        } catch (Exception $ex) {
            $_SESSION["error"] = "Error al borrar la universidad elegida";
            $return = "admin/universidades.php";
        }
        R::close();
        return $return;
    }
    
    
     public function getCarrerasFromUni($params) {
        //Obtengo el id de la universidad
        $idUniversidad = $params["id"];
        //Conexcion a bd
        $this->setUpDatabase();
        //Consulta de las carreras con el idUniveridad
        $carreras = ($idUniversidad != "") ? R::find("carrera", " universidad_id = " . $idUniversidad) : R::findAll("carrera");
        R::close();
        /*
          Tengo qu devolver un jSon para que se entienda con el cliente
         * R::exportAll= array de php(lo que va necesitar el cliente)
         * json_encode = codificamos a jSon(para que se estandar)
         * 
         *          */
        return json_encode(R::exportAll($carreras));
    }
    
      public function cambiarConfiguracion() {
          
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        $email = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_MAGIC_QUOTES);
        $newPass = filter_input(INPUT_POST, "new-password", FILTER_SANITIZE_MAGIC_QUOTES);
        $pass3 = filter_input(INPUT_POST, "pass3", FILTER_SANITIZE_MAGIC_QUOTES);
        $this->setUpDatabase();
        $usuario = R::findOne('usuario', ' id = ?', [$idUsuario]);
        $usuario->nombre = $nombre;
        $usuario->email = $email;
        if ($newPass != "" && $newPass == $pass3) {
            $usuario->password = password_hash($newPass, PASSWORD_DEFAULT);
            R::store($usuario);
            $_SESSION["exito"] = "Los datos y la contraseña han sido guardadas con exito.";
            $return = "admin/inicio.php";
        } else if ($newPass == "") {
            R::store($usuario);
            $_SESSION["exito"] = "Los datos  han sido guardadas con exito.";
            $return = "admin/inicio.php";
        } else {
            $_SESSION["error"] = "Error. Las contraseñas deben ser iguales";
            //Volvemos a la pagina 
            $return = "admin/editar-admin.php";
        }
        R::close();
        return $return;
    }
    
    public function editarAsignatura($parametros){
        
        
       $this->setUpDatabase();
       
       $asignatura = R::load('asignatura', $parametros['idAsignatura']);
       
       
       $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_MAGIC_QUOTES);
        
       $universidad = filter_input(INPUT_POST, "universidad", FILTER_SANITIZE_MAGIC_QUOTES);
       
       $carrera = filter_input(INPUT_POST, "carrera", FILTER_SANITIZE_MAGIC_QUOTES);
       
      $asignatura->nombre = $nombre;
      $asignatura->carrera_id = $carrera;
        
         try {
            R::store($asignatura);
            $_SESSION["exito"] = "Asignatura cambiada con éxito";
            $return = "admin/asignaturas.php";
        } catch (Exception $e) {
            $_SESSION["error"] = "Error al cambiar asignatura";
            $return = "admin/asignaturas.php";
        }
        R::close();
        return $return;
       
       
       
    }
    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }
}