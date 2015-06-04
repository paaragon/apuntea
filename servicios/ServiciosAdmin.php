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

    //Añadimos la carrera
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

    public function removeGrupo() {
        $idGrupo = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $grupo = R::findOne('grupo', ' id = ? ', [$idGrupo]);
        R::trash($grupo);
        R::close();
        $_SESSION['exito'] = "Grupo eliminado con éxito";
        return "admin/grupos.php";
    }

    public function removeApunte() {
        $idApunte = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $apunte = R::findOne('apunte', ' id = ? ', [$idApunte]);
        R::trash($apunte);
        R::close();
        $_SESSION['exito'] = "Apunte eliminado con éxito";
        return "admin/apuntes.php";
    }

    public function sendToAdmin() {
        $idGrupo = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->setUpDatabase();
        $usuariogrupo = R::findOne('usuariogrupo', ' grupo_id = ? AND isadmin = 1 ', [$idGrupo]);
        R::close();
        return "admin/mensajes.php?id=" . $usuariogrupo->usuario_id;
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

    public function enviarMensaje($params) {

        $idContacto = filter_input(INPUT_POST, "idContacto", FILTER_SANITIZE_NUMBER_INT);
        $texto = filter_input(INPUT_POST, "texto", FILTER_SANITIZE_MAGIC_QUOTES);
        $idUsuario = filter_var($_SESSION["idUsuario"], FILTER_SANITIZE_NUMBER_INT);

        $this->setUpDatabase();

        $mensaje = R::dispense('mensaje');
        $mensaje->emisor_id = $idUsuario;
        $mensaje->receptor_id = $idContacto;
        $mensaje->texto = $texto;
        $mensaje->fecha = date("Y-m-d H:i:s", time());
        $mensaje->visto = 0;

        try {
            R::store($mensaje);

            if (!isset($params["redirect"])) {
                echo json_encode($mensaje->export());
            } else {
                return "admin/mensajes.php?id=" . $params["redirect"];
            }
        } catch (Exception $e) {
            echo $e;
        }

        R::close();
    }

    public function borrarCarrera() {
        $this->setUpDatabase();

        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

        $carrera = R::load('carrera', $id);

        R::trash($carrera);

        R::close();
        $_SESSION["exito"] = "Carrera eliminada con éxito";
        return "admin/carreras.php";
    }

    public function editarAsignatura($parametros) {

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

    public function notFound() {

        return "404.php";
    }

    private function setUpDatabase() {
        R::setup('mysql:host=' . DbConfig::$dbHost . ';dbname=' . DbConfig::$dbName, DbConfig::$dbUser, DbConfig::$dbPassword);
    }

}
